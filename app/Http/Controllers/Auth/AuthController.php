<?php

namespace Vanguard\Http\Controllers\Auth;

use Vanguard\Events\User\LoggedIn;
use Vanguard\Events\User\LoggedOut;
use Vanguard\Events\User\Registered;
use Vanguard\Http\Requests\Auth\LoginRequest;
use Vanguard\Http\Requests\Auth\RegisterRequest;
use Vanguard\Http\Requests\User\ConfirmRegisterRequest;
use Vanguard\Mailers\UserMailer;
use Vanguard\Repositories\Address\AddressRepository;
use Vanguard\Repositories\Country\CountryRepository;
use Vanguard\Repositories\Company\CompanyRepository;
use Vanguard\Repositories\Experience\ExperienceRepository;
use Vanguard\Repositories\Profile\ProfileRepository;
use Vanguard\Repositories\Role\RoleRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Repositories\QuantityEmployees\QuantityEmployeesRepository;
use Vanguard\Repositories\ExperienceYear\ExperienceYearRepository;
use Vanguard\Repositories\EducationLevel\EducationLevelRepository;
use Vanguard\Repositories\SecurityQuestion\SecurityQuestionRepository;
use Vanguard\Repositories\SourcingNetwork\SourcingNetworkRepository;
use Vanguard\Repositories\Contact\ContactRepository;
use Vanguard\Services\Auth\TwoFactor\Contracts\Authenticatable;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\Company;
use Vanguard\CompanyUser;
use Vanguard\Experience;
use Vanguard\LegalInformation;
use Vanguard\Profile;
use Vanguard\Point;
use Vanguard\Preference;
use Auth;
use Authy;
use Carbon\Carbon;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Lang;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Validator;

class AuthController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var CountryRepository
     */
    private $countries;
    /**
     * @var AddressRepository
     */
    private $address;

    /**
     * Create a new authentication controller instance.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users,
                                CountryRepository $countries,
                                AddressRepository $address)
    {
        $this->middleware('guest', ['except' => ['getLogout']]);
        $this->middleware('auth', ['only' => ['getLogout']]);
        $this->middleware('registration', ['only' => ['getRegister', 'postRegister']]);
        $this->users = $users;
        $this->countries = $countries;
        $this->address = $address;
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        $socialProviders = config('auth.social.providers');

        return view('auth.login', compact('socialProviders'));
    }

    /**
     * Handle a login request to the application.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(LoginRequest $request)
    {
        // In case that request throttling is enabled, we have to check if user can perform this request.
        // We'll key this by the username and the IP address of the client making these requests into this application.
        $throttles = settings('throttle_enabled');

        //Redirect URL that can be passed as hidden field.
        $to = $request->has('to') ? "?to=" . $request->get('to') : 'admin';

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request, true);
        }

        $credentials = $this->getCredentials($request);

        if (! Auth::validate($credentials)) {

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            if ($throttles) {
                $this->incrementLoginAttempts($request);
            }

            return redirect()->to('private/login')
                ->withErrors(trans('auth.failed'));
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        
        if( !($user->hasRole('Admin')) ){
            return redirect()->to('private/login')
                ->withErrors(trans('auth.failed'));
        }

        if ($user->isUnconfirmed()) {
            return redirect()->to($to)
                ->withErrors(trans('app.please_confirm_your_email_first'));
        }

        if ($user->isBanned()) {
            return redirect()->to($to)
                ->withErrors(trans('app.your_account_is_banned'));
        }

        Auth::login($user, settings('remember_me') && $request->get('remember'));

        return $this->handleUserWasAuthenticated($request, $throttles, $user);
    }

    /**
     * Show the application login form Front End.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLoginFrontend()
    {
        $socialProviders = config('auth.social.providers');

        return view('frontend.login', compact('socialProviders'));
    }

    /**
     * Handle a login request to the application Front End.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postLoginFrontend(LoginRequest $request)
    {
        // In case that request throttling is enabled, we have to check if user can perform this request.
        // We'll key this by the username and the IP address of the client making these requests into this application.
        $throttles = settings('throttle_enabled');

        //Redirect URL that can be passed as hidden field.
        $to = $request->has('to') ? "?to=" . $request->get('to') : 'dashboard';

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request, false);
        }

        $credentials = $this->getCredentials($request);

        if (! Auth::validate($credentials)) {

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            if ($throttles) {
                $this->incrementLoginAttempts($request);
            }

            return redirect()->to('loginuser')
                ->withErrors(trans('auth.failed'));
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        
        if( $user->hasRole('Admin') ){
            return redirect()->back()
                ->withErrors(trans('auth.failed'));
        }

        if ($user->isUnconfirmed()) {
            return redirect()->back()
                ->withErrors(trans('app.please_confirm_your_email_first'));
        }

        if ($user->isBanned()) {
            return redirect()->back()
                ->withErrors(trans('app.your_account_is_banned'));
        }

        Auth::login($user, settings('remember_me') && $request->get('remember'));

        return $this->handleUserWasAuthenticated($request, $throttles, $user);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  Request $request
     * @param  bool $throttles
     * @param $user
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles, $user)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (settings('2fa.enabled') && Authy::isEnabled($user)) {
            return $this->logoutAndRedirectToTokenPage($request, $user);
        }

        $this->users->update($user->id, ['last_login' => Carbon::now()]);

        event(new LoggedIn($user));

        if ($request->has('to')) {
            return redirect()->to($request->get('to'));
        }

        return redirect()->intended();
    }

    protected function logoutAndRedirectToTokenPage(Request $request, Authenticatable $user)
    {
        Auth::logout();

        $request->session()->put('auth.2fa.id', $user->id);

        return redirect()->route('auth.token');
    }

    public function getToken()
    {
        return session('auth.2fa.id') ? view('auth.token') : redirect('loginuser');
    }

    public function postToken(Request $request)
    {
        $this->validate($request, ['token' => 'required']);

        if (! session('auth.2fa.id')) {
            return redirect('loginuser');
        }

        $user = $this->users->find(
            $request->session()->pull('auth.2fa.id')
        );

        if ( ! $user) {
            throw new NotFoundHttpException;
        }

        if (! Authy::tokenIsValid($user, $request->token)) {
            return redirect()->to('loginuser')->withErrors(trans('app.2fa_token_invalid'));
        }

        Auth::login($user);

        event(new LoggedIn($user));

        return redirect()->intended('/');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        // The form field for providing username or password
        // have name of "username", however, in order to support
        // logging users in with both (username and email)
        // we have to check if user has entered one or another
        $usernameOrEmail = $request->get($this->loginUsername());

        if ($this->isEmail($usernameOrEmail)) {
            return [
                'email' => $usernameOrEmail,
                'password' => $request->get('password')
            ];
        }

        return $request->only($this->loginUsername(), 'password');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        if( Auth::user()->hasRole('Admin') )
            $route = 'private/login';
        else
            $route = 'loginuser';

        event(new LoggedOut(Auth::user()));

        Auth::logout();

        return redirect($route);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return 'username';
    }

    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return app(RateLimiter::class)->tooManyAttempts(
            $request->input($this->loginUsername()).$request->ip(),
            $this->maxLoginAttempts(), $this->lockoutTime() / 60
        );
    }

    /**
     * Increment the login attempts for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return int
     */
    protected function incrementLoginAttempts(Request $request)
    {
        app(RateLimiter::class)->hit(
            $request->input($this->loginUsername()).$request->ip()
        );
    }

    /**
     * Determine how many retries are left for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return int
     */
    protected function retriesLeft(Request $request)
    {
        $attempts = app(RateLimiter::class)->attempts(
            $request->input($this->loginUsername()).$request->ip()
        );

        return $this->maxLoginAttempts() - $attempts + 1;
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLockoutResponse(Request $request, $type = false)
    {
        $seconds = app(RateLimiter::class)->availableIn(
            $request->input($this->loginUsername()).$request->ip()
        );

        if($type)
            $route = 'private/login';
        else $route = 'loginuser';

        return redirect($route)
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getLockoutErrorMessage($seconds),
            ]);
    }

    /**
     * Get the login lockout error message.
     *
     * @param  int  $seconds
     * @return string
     */
    protected function getLockoutErrorMessage($seconds)
    {
        return trans('auth.throttle', ['seconds' => $seconds]);
    }

    /**
     * Clear the login locks for the given user credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function clearLoginAttempts(Request $request)
    {
        app(RateLimiter::class)->clear(
            $request->input($this->loginUsername()).$request->ip()
        );
    }

    /**
     * Get the maximum number of login attempts for delaying further attempts.
     *
     * @return int
     */
    protected function maxLoginAttempts()
    {
        return settings('throttle_attempts', 5);
    }

    /**
     * The number of seconds to delay further login attempts.
     *
     * @return int
     */
    protected function lockoutTime()
    {
        $lockout = (int) settings('throttle_lockout_time');

        if ($lockout <= 1) {
            $lockout = 1;
        }

        return 60 * $lockout;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        $countries = $this->countries->lists()->toArray();

        $socialProviders = config('auth.social.providers');

        return view('frontend.register', compact('socialProviders', 'countries'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param RegisterRequest $request
     * @param UserMailer $mailer
     * @return \Illuminate\Http\Response
     */
    public function postRegister(RegisterRequest $request, UserMailer $mailer, RoleRepository $roles)
    {
        // Determine user status. User's status will be set to UNCONFIRMED
        // if he has to confirm his email or to ACTIVE if email confirmation is not required
        $status = settings('reg_email_confirmation')
            ? UserStatus::UNCONFIRMED
            : UserStatus::ACTIVE;

        // Add the user to database
        $user = $this->users->create(array_merge(
            $request->only('email', 'username', 'password', 'country_id'),
            ['status' => $status]
        ));

        $this->users->updateSocialNetworks($user->id, []);

        //change register user with consultant unverified role
        $role = $roles->findByName('ConsultantUnverified');
        $this->users->setRole($user->id, $role->id);

        // Check if email confirmation is required,
        // and if it does, send confirmation email to the user.
        if (settings('reg_email_confirmation')) {
            $this->sendConfirmationEmail($mailer, $user);
            $message = trans('app.account_create_confirm_email');
        } else {
            $message = trans('app.account_created_login');
        }

        event(new Registered($user));

        return redirect('loginuser')->with('success', $message);
    }

    /**
     * Confirm user's email.
     *
     * @param $token
     * @return $this
     */
    public function confirmEmail($token)
    {
        if ($user = $this->users->findByConfirmationToken($token)) {
            $this->users->update($user->id, [
                'status' => UserStatus::ACTIVE,
                'confirmation_token' => null
            ]);

            return redirect()->to('loginuser')
                ->withSuccess(trans('app.email_confirmed_can_login'));
        }

        return redirect()->to('loginuser')
            ->withErrors(trans('app.wrong_confirmation_token'));
    }

    /**
     * Confirm user's email.
     *
     * @param $token
     * @return $this
     */
    public function confirmData($token, QuantityEmployeesRepository $quantityEmployees,
                                        ExperienceYearRepository $experienceYears,
                                        EducationLevelRepository $educationLevels,
                                        SecurityQuestionRepository $securityQuestions,
                                        SourcingNetworkRepository $sourcingNetworks,
                                        ContactRepository $contacts)
    {
        if ($user = $this->users->findByConfirmationToken($token)) {
            if (session('lang') =='en')
                $language = 2;
            else
               $language = 1; 
            

            $countries = $this->countries->lists()->toArray();
            $quantityEmployees = $quantityEmployees->lists($language);
            $experienceYears = $experienceYears->lists($language);
            $educationLevels = $educationLevels->lists($language);
            $securityQuestions = $securityQuestions->lists($language);
            $currencies = $this->countries->lists('currency_code', 'id')->toArray();
            $sourcingNetworks = $sourcingNetworks->lists($language);
            $contacts = $contacts->lists($language);

            return view('frontend.confirm', compact('user',
                                                    'token',
                                                    'countries', 
                                                    'quantityEmployees',
                                                    'experienceYears',
                                                    'educationLevels',
                                                    'securityQuestions',
                                                    'currencies',
                                                    'sourcingNetworks',
                                                    'contacts'));
        }

        return redirect()->to('loginuser')
            ->withErrors(trans('app.wrong_confirmation_token'));
    }

    /**
     * Store newly created vacancy to database.
     *
     * @param CreateVacancyRequest $request
     * @return mixed
     */
    public function confirmRegister ($token, ConfirmRegisterRequest $request)
    {
        $user = $this->users->findByConfirmationToken($token);

        $dataAddress1 = ['state_id'  => $request->state,
                        'city'       => $request->city,
                        'address'    => $request->address,
                        'complement' => $request->complement,
                        'zip_code'   => $request->zip_code,
                        'is_active'  => 1];

        $address1 = $this->address->create($dataAddress1);

        $dataUser = ['prefix'              => $request->prefix,                        
                    'first_name'           => $request->first_name,
                    'last_name'            => $request->last_name,
                    'email'                => $request->email,
                    'phone'                => $request->phone,
                    'secundary_phone'      => $request->secundary_phone,
                    'address_id'           => $address1->id,
                    'years_recruitment_id' => $request->years_recruitment_id,
                    'education_level_id'   => $request->education_level_id,
                    'school_assisted'      => $request->school_assisted,
                    'memberships'          => $request->memberships,
                    'status'               => UserStatus::UNVERIFIED,
                    'confirmation_token'   => null
                    ];

        $this->users->update($user->id, $dataUser);

        $dataCompany = ['name'                  => $request->company_name,
                        'comercial_name'        => $request->company_name,
                        'website'               => $request->website,
                        'address_id'            => $address1->id,
                        'quantity_employees_id' => $request->quantity_employees_id,
                        'description'           => $request->description,
                        'is_active'             => 1,
                        'created_at'            => \Carbon\Carbon::now(),
                        'updated_at'            => \Carbon\Carbon::now()
                        ];

        $company = Company::create($dataCompany);

        $experience = Experience::create(['company_id' => $company->id]);
        $profile    = Profile::create(['company_id' => $company->id]);

        $data = [ 'company_id' => $company->id,
                  'user_id'    => $user->id,
                  'is_active'  => true,
                  'created_at' => \Carbon\Carbon::now(),
                  'updated_at' => \Carbon\Carbon::now() ];

        CompanyUser::create($data);
        Point::create(['user_id' => $user->id, 'sum' => 25 ]);

        $dataPreference = [ 'user_id'              => $user->id,
                            'security_question1'   => $request->security_question1,
                            'answer1'              => $request->answer1,
                            'security_question2'   => $request->security_question1,
                            'answer2'              => $request->answer1,
                            'receive_messages'     => $request->receive_messages,
                            'promotional_code'     => $request->promotional_code,
                            'contact_id'           => $request->contact_id,
                            'organization_role_id' => $request->organization_role_id,
                            'sourcing_network_id'  => $request->sourcing_network_id, 
                            'created_at'           => \Carbon\Carbon::now(),
                            'updated_at'           => \Carbon\Carbon::now()
                            ];

        Preference::create($dataPreference);

        $dataAddress2 = ['state_id'  => $request->state2,
                        'city'       => $request->city2,
                        'address'    => $request->address2,
                        'complement' => $request->complement2,
                        'zip_code'   => $request->zip_code2,
                        'is_active'  => 1
                        ];

        $address2 = $this->address->create($dataAddress2);

        $dataLegal = [ 'user_id'             => $user->id,
                        'legal_first_name'   => $request->legal_first_name,
                        'legal_last_name'    => $request->legal_last_name,
                        'legal_company_name' => $request->legal_company_name,
                        'company_type'       => $request->company_type,
                        'principal_coin'     => $request->principal_coin,
                        'accept_terms_cond'  => $request->accept_terms_cond,
                        'address_id'         => $address2->id,
                        'created_at'         => \Carbon\Carbon::now(),
                        'updated_at'         => \Carbon\Carbon::now()
                        ];

        LegalInformation::create($dataLegal);

        return redirect()->to('loginuser')
            ->withSuccess(trans('app.registration_completed_wait_data_validation'));
    }

    /**
     * Validate if provided parameter is valid email.
     *
     * @param $param
     * @return bool
     */
    private function isEmail($param)
    {
        return ! Validator::make(
            ['username' => $param],
            ['username' => 'email']
        )->fails();
    }

    /**
     * @param UserMailer $mailer
     * @param $user
     */
    private function sendConfirmationEmail(UserMailer $mailer, $user)
    {
        $token = str_random(60);
        $this->users->update($user->id, ['confirmation_token' => $token]);
        $mailer->sendConfirmationEmail($user, $token);
    }
}

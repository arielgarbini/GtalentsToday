<?php

namespace Vanguard\Http\Controllers\Auth;

use Vanguard\ActualPosition;
use Vanguard\Address;
use Vanguard\CasesNumber;
use Vanguard\Events\User\LoggedIn;
use Vanguard\Events\User\LoggedOut;
use Vanguard\Events\User\Registered;
use Vanguard\ExperienceFunctionalArea;
use Vanguard\ExperienceIndustry;
use Vanguard\ExperienceRegion;
use Vanguard\Http\Requests\Auth\LoginRequest;
use Vanguard\Http\Requests\Auth\RegisterRequest;
use Vanguard\Http\Requests\User\ConfirmRegisterRequest;
use Vanguard\Jobtitle;
use Vanguard\LevelPosition;
use Vanguard\Mailers\CollaboratorMailer;
use Vanguard\Mailers\UserMailer;
use Vanguard\Region;
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
use Vanguard\Repositories\FunctionalArea\FunctionalAreaRepository;
use Vanguard\Repositories\Industry\IndustryRepository;
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
use Valida;
use Vanguard\TypeInvolvedOpportunity;
use Vanguard\TypeInvolvedOpportunityProfile;
use Vanguard\TypeInvolvedSearch;
use Vanguard\TypeInvolvedSearchProfile;
use Vanguard\TypeSharedOpportunity;
use Vanguard\TypeSharedOpportunityProfile;
use Vanguard\TypeSharedSearch;
use Vanguard\TypeSharedSearchProfile;
use Vanguard\User;
use Vanguard\UserInvited;

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
        if (Auth::check()){
            return redirect()->route('dashboard');
        }
        $linkedIn = new \Happyr\LinkedIn\LinkedIn('78smzb4w4fzq6v', '534YjIafBBG95qIy');
        $url = $linkedIn->getLoginUrl(['redirect_uri' => route('login.linkedin')]);

        $socialProviders = config('auth.social.providers');

        return view('frontend.login', compact('socialProviders', 'url'));
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

        if ($user->isUnverified()) {
            return redirect()->back()
                ->withErrors(trans('app.your_account_has_not_yet_been_verified'));
        }

        if ($user->isBanned()) {
            return redirect()->back()
                ->withErrors(trans('app.your_account_is_banned'));
        }
        Auth::login($user, settings('remember_me') && $request->get('remember'));
        if($user->language!=''){
            session(['lang' => $user->language]);
        } else {
            session(['lang' => \App::getLocale()]);
        }
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
    /*
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
    }*/

    protected function getCredentials(Request $request)
    {
        return [
            'email' => $request->username,
            'password' => $request->get('password')
        ];
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
        $linkedIn = new \Happyr\LinkedIn\LinkedIn('78smzb4w4fzq6v', '534YjIafBBG95qIy');
        $url = $linkedIn->getLoginUrl(['redirect_uri' => route('register.linkedin')]);

        $countries = $this->countries->lists()->toArray();

        $socialProviders = config('auth.social.providers');

        return view('frontend.register', compact('socialProviders', 'countries', 'url'));
    }

    public function getLinkedinUrl(Request $request)
    {
        $linkedIn = new \Happyr\LinkedIn\LinkedIn('78smzb4w4fzq6v', '534YjIafBBG95qIy');
        $url = $linkedIn->getLoginUrl(['redirect_uri' => route('register.linkedin')]);
        return response()->json(['url' => $url]);
    }

    public function getLoginLinkedin(Request $request){
        if(isset($request->error)){
            return view('frontend.linkedin.cancel');
        } else {
            $linkedIn = new \Happyr\LinkedIn\LinkedIn('78smzb4w4fzq6v', '534YjIafBBG95qIy');
/*            $client = new \GuzzleHttp\Client(['base_uri' => 'https://www.linkedin.com/']);
            $response = $client->post('oauth/v2/accessToken?format=json', [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => route('register.linkedin'),
                    'client_id' => '78smzb4w4fzq6v',
                    'client_secret' => '534YjIafBBG95qIy',
                    'code' => $request->code
                ]]);
            $data = $response->getBody();
            $data = $data->getContents();
            $data = json_decode($data);
            $linkedIn->setAccessToken($data->access_token);*/
            $dataUser = $linkedIn->get('v1/people/~:(id)');
            if($user = User::where('id_linkedin', $dataUser['id'])->get()->first()){
                if($user->status=='Active'){
                    //Logealo menol
                    Auth::login($user, true);
                    session(['lang' => \App::getLocale()]);
                    $dataFinal = ['error' => false, 'message' => '', 'url' => route('dashboard')];
                } else {
                    //no estas verificado menol
                    $dataFinal = ['error' => true, 'message' => Lang::get('app.not_user_register_verify')];
                }
            } else {
                $dataFinal = ['error' => true, 'message' => Lang::get('app.not_user_register'), 'url' => route('register.inf')];
            }
            return view('frontend.linkedin.success', compact('dataFinal'));
        }
    }

    public function getRegisterLinkedin(Request $request, RoleRepository $roles, UserMailer $mailer)
    {
        if(isset($request->error)){
            return view('frontend.linkedin.cancel');
        } else {
            $linkedIn = new \Happyr\LinkedIn\LinkedIn('78smzb4w4fzq6v', '534YjIafBBG95qIy');
            $client = new \GuzzleHttp\Client(['base_uri' => 'https://www.linkedin.com/']);
            $response = $client->post('oauth/v2/accessToken?format=json', [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => route('register.linkedin'),
                    'client_id' => '78smzb4w4fzq6v',
                    'client_secret' => '534YjIafBBG95qIy',
                    'code' => $request->code
                ]]);
            $data = $response->getBody();
            $data = $data->getContents();
            $data = json_decode($data);
            $linkedIn->setAccessToken($data->access_token);
            $dataUser = $linkedIn->get('v1/people/~:(firstName,lastName,id,email-address)');

            if($user = User::where('id_linkedin', $dataUser['id'])->get()->first()){
                if($user->status=='Active'){
                    //Logealo menol
                    Auth::login($user, true);
                    session(['lang' => \App::getLocale()]);
                    $dataFinal = ['register' => false, 'error' => false, 'message' => '', 'url' => route('dashboard')];
                } else {
                    //no estas verificado menol
                    $dataFinal = ['error' => true, 'message' => Lang::get('app.not_user_register_verify')];
                }
            } else {
                if($user = User::where('email', $dataUser['emailAddress'])->get()->first()){
                    $dataFinal = ['error' => true, 'message' => Lang::get('app.user_register_email')];
                    return view('frontend.linkedin.success', compact('dataFinal'));
                }

                $status = settings('reg_email_confirmation')
                    ? UserStatus::UNCONFIRMED
                    : UserStatus::ACTIVE;

                $code = $this->generateCode();

                // Add the user to database
                $user = $this->users->create(['status' => $status,
                    'code'=>$code, 'first_name' => $dataUser['firstName'], 'last_name' => $dataUser['lastName'],
                    'email' => $dataUser['emailAddress'], 'id_linkedin' => $dataUser['id'], 'code_linkedin' => $data->access_token]);

                $this->users->updateSocialNetworks($user->id, []);

                //change register user with consultant unverified role
                $role = $roles->findByName('Consultant');
                $this->users->setRole($user->id, $role->id);

                // Check if email confirmation is required,
                // and if it does, send confirmation email to the user.
                $token = str_random(60);
                $this->users->update($user->id, ['confirmation_token' => $token]);
                if (settings('reg_email_confirmation')) {
                    $mailer->sendConfirmationEmail($user, $token);
                }
                event(new Registered($user));
                $dataFinal = ['register' => true, 'error' => false, 'message' => Lang::get('app.user_register_linkedin_ok'), 'url' => route('register.confirm-data', $token)];
            }
            return view('frontend.linkedin.success', compact('dataFinal'));
        }
    }

    /*public function getRegisterLinkedin(Request $request, RoleRepository $roles, UserMailer $mailer)
    {
        if(isset($request->error)){
            return view('frontend.linkedin.cancel');
        } else {
            $linkedIn = new \Happyr\LinkedIn\LinkedIn('78smzb4w4fzq6v', '534YjIafBBG95qIy');
            $client = new \GuzzleHttp\Client(['base_uri' => 'https://www.linkedin.com/']);
            $response = $client->post('oauth/v2/accessToken?format=json', [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => route('register.linkedin'),
                    'client_id' => '78smzb4w4fzq6v',
                    'client_secret' => '534YjIafBBG95qIy',
                    'code' => $request->code
                ]]);
            $data = $response->getBody();
            $data = $data->getContents();
            $data = json_decode($data);
            $linkedIn->setAccessToken($data->access_token);
            $dataUser = $linkedIn->get('v1/people/~:(firstName,lastName,id,email-address)');
            if($user = User::where('email', $dataUser['emailAddress'])->get()->first()){
                $dataFinal = ['error' => true, 'message' => Lang::get('app.user_register_email')];
            } else if($user = User::where('id_linkedin', $dataUser['id'])->get()->first()){
                $dataFinal = ['error' => true, 'message' => Lang::get('app.user_register_linkedin')];
            } else {
                $status = settings('reg_email_confirmation')
                    ? UserStatus::UNCONFIRMED
                    : UserStatus::ACTIVE;

                $code = $this->generateCode();

                // Add the user to database
                $user = $this->users->create(['status' => $status,
                    'code'=>$code, 'first_name' => $dataUser['firstName'], 'last_name' => $dataUser['lastName'],
                    'email' => $dataUser['emailAddress'], 'id_linkedin' => $dataUser['id'], 'code_linkedin' => $data->access_token]);

                $this->users->updateSocialNetworks($user->id, []);

                //change register user with consultant unverified role
                $role = $roles->findByName('Consultant');
                $this->users->setRole($user->id, $role->id);

                // Check if email confirmation is required,
                // and if it does, send confirmation email to the user.
                $token = str_random(60);
                $this->users->update($user->id, ['confirmation_token' => $token]);
                if (settings('reg_email_confirmation')) {
                    $mailer->sendConfirmationEmail($user, $token);
                }
                event(new Registered($user));
                $dataFinal = ['error' => false, 'message' => Lang::get('app.user_register_linkedin_ok'), 'url' => route('register.confirm-data', $token)];
            }
            return view('frontend.linkedin.success', compact('dataFinal'));
        }
    }*/

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

        $code = $this->generateCode();

        // Add the user to database
        $user = $this->users->create(array_merge(
            $request->only('email', 'password', 'country_id'),
            ['status' => $status, 'code'=>$code]
        ));

        $this->users->updateSocialNetworks($user->id, []);

        //change register user with consultant unverified role
        $role = $roles->findByName('Consultant');
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

    public function generateCode()
    {
        $letras = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'W', 'X', 'Y', 'Z'];

        $rand = '';
        for($i = 0; $i<4; $i++){
            $rand .= $letras[rand(0, count($letras)-1)];
        }
        while(User::where('code', $rand)->get()->first()){
            $rand = '';
            for($i = 0; $i<4; $i++){
                $rand .= $letras[rand(0, count($letras)-1)];
            }
        }
        return $rand;
    }

    /**
     * Confirm user's email.
     *
     * @param $token
     * @return $this
     */
    public function confirmEmail($token, RoleRepository $roles)
    {
        if ($user = $this->users->findByConfirmationToken($token)) {
            $this->users->update($user->id, [
                'status' => UserStatus::ACTIVE,
                'confirmation_token' => null
            ]);
            $role = $roles->findByName('Consultant');
            $this->users->setRole($user->id, $role->id);

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
                                        ContactRepository $contacts,
                                        FunctionalAreaRepository $functionalArea,
                                        IndustryRepository $industries)
    {
        if ($user = $this->users->findByConfirmationToken($token)) {
            session(['lang' => \App::getLocale()]);
            if (session('lang') =='en'){
                $language = 2;
            }else{
                $language = 1;
            }
            $searchTypeShared = TypeSharedSearch::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
            $opportunityShared = TypeInvolvedSearch::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
            $searchTypeInvolved = TypeSharedOpportunity::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
            $opportunityInvolved = TypeInvolvedOpportunity::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
            $countries = $this->countries->lists()->toArray();
            $quantityEmployees = $quantityEmployees->lists($language);
            $experienceYears = $experienceYears->lists($language);
            $educationLevels = $educationLevels->lists($language);
            $securityQuestions = $securityQuestions->lists($language);
            //$currencies = $this->countries->lists('currency_code', 'id')->toArray();
            $sourcingNetworks = $sourcingNetworks->lists($language);
            $contacts = $contacts->lists($language);
            $functionalArea = $functionalArea->lists($language);
            $industries = $industries->lists($language);
            $positions = ActualPosition::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
            $regions = Region::where('language_id', $language)->orderBy('name', 'asc')->lists('name', 'value_id')->all();
            $cases_numbers = CasesNumber::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
            $level_positions = LevelPosition::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();
            $jobTitle = Jobtitle::where('language_id', $language)->orderBy('id', 'asc')->lists('name', 'value_id')->all();

            try{
                $company = Company::find($user->company_user->company_id);
            } catch(\Exception $e){
                $company = '';
            }
            try{
                $legal = LegalInformation::where('user_id', $user->id)->get()->first();
            } catch(\Exception $e){
                $legal = '';
            }
            if($company!=''){
                $address = Address::find($company->address_id);
            } else {
                $address = '';
            }
            $industries_id = [];
            $industries_name = [];
            $region_id = [];
            $region_name = [];
            $type1_id = [];
            $type1_name = [];
            $type2_id = [];
            $type2_name = [];
            $type3_id = [];
            $type3_name = [];
            $type4_id = [];
            $type4_name = [];

            if($company!=''){
                $expe = Experience::where('company_id', $user->company_user->company_id)->get()->first();
                if($expe){
                    $indus = ExperienceIndustry::where('experience_id', $expe->id)->get();
                    foreach($indus as $na){
                        $industries_id[] = $na->industry_id;
                        $industries_name[] = $na->industry($language)->name;
                    }
                    $funca = ExperienceRegion::where('experience_id', $expe->id)->get();
                    foreach($funca as $na){
                        $region_id[] = $na->region_id;
                        $region_name[] = $na->region($language)->name;
                    }
                }
                $profile = Profile::where('company_id', $company->id)->get()->first();
                $funca = TypeSharedSearchProfile::where('profile_id', $profile->id)->get();
                foreach($funca as $na){
                    $type1_id[] = $na->type_of_shared_search_id;
                    $type1_name[] = $na->name($language)->name;
                }
                $funca = TypeSharedOpportunityProfile::where('profile_id', $profile->id)->get();
                foreach($funca as $na){
                    $type2_id[] = $na->type_of_shared_opportunities_id;
                    $type2_name[] = $na->name($language)->name;
                }

                $funca = TypeInvolvedSearchProfile::where('profile_id', $profile->id)->get();
                foreach($funca as $na){
                    $type3_id[] = $na->type_of_involved_search_id;
                    $type3_name[] = $na->name($language)->name;
                }
                $funca = TypeInvolvedOpportunityProfile::where('profile_id', $profile->id)->get();
                foreach($funca as $na){
                    $type4_id[] = $na->type_of_involved_opportunities_id;
                    $type4_name[] = $na->name($language)->name;
                }
            } else{
                $profile = '';
            }
            try{
                $preferences = Preference::where('user_id', $user->id)->get()->first();
            } catch (\Exception $e){
                $preferences = '';
            }
            return view('frontend.confirm', compact('user',
                                                    'jobTitle',
                                                    'type1_id',
                                                    'type1_name',
                                                    'type2_id',
                                                    'type2_name',
                                                    'type3_id',
                                                    'type3_name',
                                                    'type4_id',
                                                    'type4_name',
                                                    'address',
                                                    'profile',
                                                    'legal',
                                                    'preferences',
                                                    'industries_name',
                                                    'industries_id',
                                                    'region_name',
                                                    'region_id',
                                                    'company',
                                                    'regions',
                                                    'token',
                                                    'cases_numbers',
                                                    'level_positions',
                                                    'positions',
                                                    'countries', 
                                                    'quantityEmployees',
                                                    'experienceYears',
                                                    'searchTypeShared',
                                                    'searchTypeInvolved',
                                                    'opportunityInvolved',
                                                    'opportunityShared',
                                                    'educationLevels',
                                                    'securityQuestions',
                                                    'sourcingNetworks',
                                                    'contacts',
                                                    'functionalArea',
                                                    'industries'));
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

        $dataUser = ['first_name'          => $request->first_name,
                    'last_name'            => $request->last_name,
                    'email'                => $request->email,
                    'phone'                => $request->phone,
                    'secundary_phone'      => $request->secundary_phone,
                    'status'               => UserStatus::UNVERIFIED,
                    'language'             => \App::getLocale()
                    ];

        if(isset($request->password) && $request->password!=''){
            $dataUser['password'] = $request->password;
        }

        if($request->autoSave == 0){
            $dataUser['confirmation_token'] = null;
        }
        if(isset($address1)){
            $dataUser['address_id'] = $address1->id;
        }

        $this->users->update($user->id, $dataUser);

        if((isset($request->state_id2) && $request->state_id2!='') && (isset($request->country_id2) && $request->country_id2!='')){
            $dataAddress2 = [
                'state_id'       => $request->state_id2,
                'country_id'    => $request->country_id2,
                'city_id'    => $request->city_id2,
                'is_active'  => 1];

            $address2 = $this->address->create($dataAddress2);
        }

        if(isset($request->company_name) && $request->company_name!=''){
            $dataCompany = ['name'                  => $request->company_name,
                'comercial_name'        => $request->company_name,
                'website'               => $request->website,
                'quantity_employees_id' => $request->quantity_employees_id,
                'is_active'             => 1,
                'created_at'            => \Carbon\Carbon::now(),
                'updated_at'            => \Carbon\Carbon::now(),
                'category_id'           => 1
            ];

            if(isset($address2)){
                $dataCompany['address_id'] = $address2->id;
            }

            if($company = CompanyUser::where('user_id', $user->id)->get()->first()){
                $company = Company::find($company->company_id);
                $company->update($dataCompany);
            } else {
                $company = Company::create($dataCompany);
            }

            if(!$expe = Experience::where('company_id', $company->id)->get()->first()){
                $expe = new Experience();
                $expe->company_id = $company->id;
                $expe->save();
            }

            if(!$profile = Profile::where('company_id', $company->id)->get()->first()){
                $profile = new Profile();
                $profile->company_id = $company->id;
                $profile->actual_position_id = $request->actual_position_id;
                $profile->linkedin_url = $request->linkedin;
                $profile->years_experience_id = $request->years_experience_id;
                $profile->jobtitle_id = $request->job_title_id;
                $profile->current_company = $request->current_company;
                $profile->user_id = $user->id;
                if($request->reference_job==8){
                    $profile->reference_job = $request->reference_job;
                } else {
                    $profile->reference_job = '';
                }
                $profile->save();
            } else {
                $dt = ['linkedin_url' => $request->linkedin,
                    'current_company' => $request->current_company, 'user_id' => $user->id];
                if(isset($request->years_experience_id) && $request->years_experience_id!=''){
                    $dt['years_experience_id'] = $request->years_experience_id;
                }

                if(isset($request->actual_position_id) && $request->actual_position_id!=''){
                    $dt['actual_position_id'] = $request->actual_position_id;
                }

                if(isset($request->job_title_id) && $request->job_title_id!=''){
                    $dt['jobtitle_id'] = $request->job_title_id;
                }

                if($request->job_title_id==8){
                    $dt['reference_job'] = $request->reference_job;
                } else {
                    $dt['reference_job'] = '';
                }
                $profile->update($dt);
            }

            TypeSharedSearchProfile::where('profile_id', $profile->id)->delete();
            if(isset($request->searchType) && $request->searchType!=''){
                $searchType = explode(',', $request->searchType);
                foreach($searchType as $in){
                    TypeSharedSearchProfile::create(['profile_id' => $profile->id, 'type_of_shared_search_id' => $in]);
                }
            }

            TypeSharedOpportunityProfile::where('profile_id', $profile->id)->delete();
            if(isset($request->searchTypeWork) && $request->searchTypeWork!=''){
                $searchTypeWork = explode(',', $request->searchTypeWork);
                foreach($searchTypeWork as $in){
                    TypeSharedOpportunityProfile::create(['profile_id' => $profile->id, 'type_of_shared_opportunities_id' => $in]);
                }
            }

            TypeInvolvedSearchProfile::where('profile_id', $profile->id)->delete();
            if(isset($request->opportunityShare) && $request->opportunityShare!=''){
                $opportunityShare = explode(',', $request->opportunityShare);
                foreach($opportunityShare as $in){
                    TypeInvolvedSearchProfile::create(['profile_id' => $profile->id, 'type_of_involved_search_id' => $in]);
                }
            }

            TypeInvolvedOpportunityProfile::where('profile_id', $profile->id)->delete();
            if(isset($request->opportunityInvolved) && $request->opportunityInvolved!=''){
                $opportunityInvolved = explode(',', $request->opportunityInvolved);
                foreach($opportunityInvolved as $in){
                    TypeInvolvedOpportunityProfile::create(['profile_id' => $profile->id, 'type_of_involved_opportunities_id' => $in]);
                }
            }

            ExperienceIndustry::where('experience_id', $expe->id)->delete();
            if(isset($request->industries) && $request->industries!=''){
                $industries = explode(',', $request->industries);
                foreach($industries as $in){
                    ExperienceIndustry::create(['experience_id' => $expe->id, 'industry_id' => $in]);
                }
            }

            ExperienceRegion::where('experience_id', $expe->id)->delete();
            if(isset($request->location) && $request->location!=''){
                $location = explode(',', $request->location);
                foreach($location as $in){
                    ExperienceRegion::create(['experience_id' => $expe->id, 'region_id' => $in]);
                }
            }
            if(!CompanyUser::where('user_id', $user->id)->get()->first()){
                $data = [ 'company_id' => $company->id,
                    'user_id'    => $user->id,
                    'is_active'  => true,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'position' => 1];

                CompanyUser::create($data);
                Point::create(['user_id' => $user->id, 'sum' => 25, 'company_id'=>$company->id]);
            }

            $dataLegal = [ 'user_id' => $user->id,
                'legal_first_name'   => $request->first_name,
                'legal_last_name'    => $request->last_name,
                'legal_company_name' => $request->company_name,
                'accept_terms_cond'  => $request->accept_terms_cond,
                'created_at'         => \Carbon\Carbon::now(),
                'updated_at'         => \Carbon\Carbon::now()
            ];

            if($le = LegalInformation::where('user_id', $user->id)->get()->first()){
                $le->update($dataLegal);
            } else {
                LegalInformation::create($dataLegal);
            }
        }

        $dataPreference = [ 'user_id'              => $user->id,
                            'receive_messages'     => $request->receive_messages,
                            'promotional_code'     => $request->promotional_code,
                            'created_at'           => \Carbon\Carbon::now(),
                            'updated_at'           => \Carbon\Carbon::now()
                            ];


        if(isset($request->contact_id) && $request->contact_id!=''){
            $dataPreference['contact_id'] = $request->contact_id;
            if($request->contact_id==1 || $request->contact_id==4 || $request->contact_id==5){
                $dataPreference['reference'] = $request->reference;
            } else {
                $dataPreference['reference'] = '';
            }
        }

        if(isset($request->sourcing_networks_candidates_id) && $request->sourcing_networks_candidates_id!=''){
            $dataPreference['sourcing_network_id'] = $request->sourcing_networks_candidates_id;
        }

        if($preference = Preference::where('user_id', $user->id)->get()->first()){
            $preference->update($dataPreference);
        } else {
            Preference::create($dataPreference);
        }

        if($request->autoSave==1){
            return response()->json(['success' => true], 200);
        } else {
            if(isset($request->promotional_code)){
                $invitation = UserInvited::where('code', $request->promotional_code)->where('status', 1)->get()->first();
                if($invitation){
                    $invitation->status = 0;
                    $invitation->save();
                }
            }
            return redirect()->to('loginuser')
                ->withSuccess(trans('app.registration_completed_wait_data_validation'));
        }
    }

    public function confirmDataCollaborator($token, QuantityEmployeesRepository $quantityEmployees,
                                ExperienceYearRepository $experienceYears,
                                EducationLevelRepository $educationLevels,
                                SecurityQuestionRepository $securityQuestions,
                                SourcingNetworkRepository $sourcingNetworks,
                                ContactRepository $contacts)
    {
        if ($user = $this->users->findByConfirmationToken($token)) {
            session(['lang' => \App::getLocale()]);
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

            return view('frontend.confirmcollaborator', compact('user',
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
    public function confirmRegisterCollaborator ($token, ConfirmRegisterRequest $request, CollaboratorMailer $mailer)
    {
        $user = $this->users->findByConfirmationToken($token);
        if(isset($request->state) && $request->state!=''){
            $dataAddress1 = ['state_id'  => $request->state,
                'city'       => $request->city,
                'address'    => $request->address,
                'complement' => $request->complement,
                'zip_code'   => $request->zip_code,
                'is_active'  => 1];

            $address1 = $this->address->create($dataAddress1);
        }

        $dataUser = ['prefix'              => $request->prefix,
            'first_name'           => $request->first_name,
            'last_name'            => $request->last_name,
            'email'                => $request->email,
            'phone'                => $request->phone,
            'secundary_phone'      => $request->secundary_phone,
            'school_assisted'      => $request->school_assisted,
            'memberships'          => $request->memberships,
            'country_id'           => $request->country_id,
            'status'               => UserStatus::UNVERIFIED,
            'confirmation_token'   => null,
            'password'              => $request->password
        ];

        if(isset($address1)){
            $dataUser['address_id'] = $address1->id;
        }

        if(isset($request->years_recruitment_id)){
            $dataUser['years_recruitment_id'] = $request->years_recruitment_id;
        }

        if(isset($request->education_level_id)){
            $dataUser['education_level_id'] = $request->education_level_id;
        }

        $this->users->update($user->id, $dataUser);

        $dataPreference = [ 'user_id'              => $user->id,
            'security_question1_id'   => $request->security_question1,
            'answer1'              => $request->answer1,
            'security_question2_id'   => $request->security_question2,
            'answer2'              => $request->answer1,
            'receive_messages'     => $request->receive_messages,
            'promotional_code'     => $request->promotional_code,
            'created_at'           => \Carbon\Carbon::now(),
            'updated_at'           => \Carbon\Carbon::now()
        ];

        if(isset($request->contact_id) && $request->contact_id!=''){
            $dataPreference['contact_id'] = $request->contact_id;
        }

        if(isset($request->contact_id) && $request->organization_role_id!=''){
            $dataPreference['organization_role_id'] = $request->organization_role_id;
        }

        if(isset($request->contact_id) && $request->sourcing_network_id!=''){
            $dataPreference['sourcing_network_id'] = $request->sourcing_network_id;
        }

        Preference::create($dataPreference);

        if(isset($request->state2) && $request->state2!=''){
            $dataAddress2 = ['state_id'  => $request->state2,
                'city'       => $request->city2,
                'address'    => $request->address2,
                'complement' => $request->complement2,
                'zip_code'   => $request->zip_code2,
                'is_active'  => 1
            ];

            $address2 = $this->address->create($dataAddress2);
        }

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

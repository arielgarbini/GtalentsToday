<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vanguard\Http\Requests;

use Vanguard\Mailers\CollaboratorMailer;
use Vanguard\User;
use Vanguard\CompanyUser;
use Vanguard\Support\Enum\UserStatus;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Repositories\Role\RoleRepository;

class TeamController extends Controller
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        $company_id = CompanyUser::where(['user_id' => Auth::user()->id])->get()->first()->company_id;
        $team = CompanyUser::where(['company_id' => $company_id])->where('user_id', '!=', Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('dashboard_user.team.index', compact('team'));
    }

    public function store(Request $request, CollaboratorMailer $mailer, RoleRepository $roles)
    {
        $this->validate($request,
            ['first_name'       => 'required|min:3',
                'last_name'     => 'required|min:3',
                'email'         => 'required|email|unique:users',
                'level_of_access' => 'required',
            ]);

        $team = new User();
        $team->first_name = $request->input('first_name');
        $team->last_name = $request->input('last_name');
        $team->email = $request->input('email');
        $team->status = UserStatus::UNCONFIRMED;
        $team->password = rand(0000, 9999);
        $team->is_active = 0;
        $team->code = $this->generateCode();
        $team->save();

        $this->users->updateSocialNetworks($team->id, []);
        $role = $roles->findByName('ConsultantUnverified');
        $this->users->setRole($team->id, $role->id);

        if (isset($team->id)) {
            $company_id = CompanyUser::where(['user_id' => Auth::user()->id])->get()->first()->company_id;
            CompanyUser::create(['company_id' => $company_id, 'user_id' => $team->id, 'is_active' => 0, 'position' => $request->level_of_access]);
            $this->sendEmailCollaborator($mailer, $team);
            return redirect()->back()->withSuccess(trans('app.collaborator_created'));
        }
        else{
            return redirect()->back()->withErrors(trans('no_create'));
        }
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

    public function update(Request $request, $team)
    {
        $this->validate($request,
            ['first_name'       => 'required|min:3',
                'last_name'     => 'required|min:3',
                //'email'         => 'required|email|unique:users',
                'level_of_access' => 'required',
            ]);

        $newCompany = CompanyUser::find($team);
        if($user = User::where('email',$request->input('email'))->where('id','!=',$newCompany->user_id)->get()->first()){
            return redirect()->back()->withErrors(trans('app.email_taken'));
        }
        $newCompany->position = $request->level_of_access;
        $newCompany->save();

        $team = User::find($newCompany->user_id);
        $team->first_name = $request->input('first_name');
        $team->last_name = $request->input('last_name');
        $team->email = $request->input('email');
        $team->save();

        if(isset($team->id))
        {
            return redirect()->back()->withSuccess(trans('app.collaborator_updated'));
        }
    }

    public function delete($team)
    {
        $newCompany = CompanyUser::find($team);
        User::destroy($newCompany->user_id);
        CompanyUser::destroy($team);
        return redirect()->back()->withSuccess(trans('app.collaborator_deleted'));
    }

    public function sendEmailCollaborator(CollaboratorMailer $mailer, $user)
    {
        $token = str_random(60);
        $this->users->update($user->id, ['confirmation_token' => $token]);
        $mailer->sendEmailCollaborator($user, $token);
    }
}

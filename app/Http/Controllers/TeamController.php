<?php

namespace Vanguard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vanguard\Http\Requests;

use Vanguard\User;
use Vanguard\CompanyUser;
use Vanguard\Support\Enum\UserStatus;

class TeamController extends Controller
{
    public function index()
    {
        $company_id = CompanyUser::where(['user_id' => Auth::user()->id])->get()->first()->company_id;
        $team = CompanyUser::where(['company_id' => $company_id])->where('user_id', '!=', Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('dashboard_user.team.index', compact('team'));
    }

    public function store(Request $request)
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

        if (isset($team->id)) {
            $company_id = CompanyUser::where(['user_id' => Auth::user()->id])->get()->first()->company_id;
            CompanyUser::create(['company_id' => $company_id, 'user_id' => $team->id, 'is_active' => 0, 'position' => $request->level_of_access]);
            return redirect()->back()->withSuccess(trans('app.collaborator_created'));
        }
        else{
            return redirect()->back()->withErrors(trans('no_create'));
        }
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

    public function generateCode()
    {
        $rand = rand(0000,9999);
        while(User::where(['code' => $rand])->get()->first()){
            $rand = rand(0000,9999);
        }
        return $rand;
    }
}

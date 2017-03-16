<?php

namespace Vanguard\Http\Controllers;

use Auth;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Vanguard\Http\Requests\Candidate\CreateCandidateRequest;
use Vanguard\Http\Requests\Candidate\UpdateCandidateRequest;
use Vanguard\Repositories\Candidate\CandidateRepository;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Services\Upload\FileManager;
use Vanguard\Http\Requests;
use Vanguard\User;
use Vanguard\Candidate;
use Vanguard\ActualPosition;
use Vanguard\Company;
use Vanguard\Country;
use Vanguard\Compensation;

class CandidateController extends Controller
{
    /**
     * @var User
     */
    protected $theUser;
    /**
     * @var CandidateRepository
     */
    private $candidates;

    /**
     * CandidateController constructor.
     * @param CandidateRepository $candidates)
     */
    public function __construct(CandidateRepository $candidates, UserRepository $users)
    {
        $this->middleware('permission:candidates.manage');
        $this->candidates = $candidates;
        $this->users = $users;
        $this->theUser = Auth::user();
    }

    /**
     * Display page with all available candidates.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index () 
    {
        $perPage = 20;
        $candidates = Candidate::all();
        //dd($candidates);
        //dd($perPage);
        /*if(Auth::user()->hasRole('Consultant') Or Auth::user()->hasRole('Consultant Unverified'))

            $candidates = $this->candidates->paginate($perPage, Input::get('search'), Input::get('status'), $this->theUser->id);
        else
       	    $candidates = $this->candidates->paginate($perPage, Input::get('search'), Input::get('status'));*/

        $users = $this->users->lists();
        $positions = ActualPosition::orderBy('name')->lists('name', 'id')->all();
        $companies = Company::orderBy('name')->lists('name', 'id')->all();
        $countries = Country::orderBy('citizenship')->lists('name', 'id')->all();
        $compensations = Compensation::orderBy('id')->lists('salary', 'id')->all();
        //dd($positions);
    	//return view('candidate.index', compact('candidates','users'));
        return view('dashboard_user.candidate.index', compact('candidates','users', 'positions', 'companies', 'countries','compensations'));		
    }

    /**
     * Display form for creating new candidate.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create () 
    {
       	$edit = false;

        return view('candidate.add_edit', compact('edit'));	
    }

    /**
     * Store newly created candidate to database.
     *
     * @param CreateCandidateRequest $request
     * @return mixed
     */
    public function store (Request $request, FileManager $filemanager)
    {
        /*dd($request);
    	$request->merge(array('supplier_user_id' => $this->theUser->id, 'code' => substr (microtime(), 11, 20)));

        $data =  $request->all() ;
        $candidate = $this->candidates->save($data);

        if($request->file('file')){
            $name = $filemanager->uploadFile('candidate', $candidate->id);
            $this->candidates->update($candidate->id, ['file' => $name]);
        }

        return redirect()->route('candidates.index')
            ->withSuccess(trans('app.candidate_created'));*/ 

        $mycandidate = new Candidate();
        $mycandidate->supplier_user_id = $this->theUser->id;
        $mycandidate->first_name =  $request->input('first_name');
        $mycandidate->last_name =   $request->input('last_name');
        $mycandidate->email =       $request->input('email');
        $mycandidate->telf =        $request->input('telf');
        $mycandidate->actual_position_id = $request->input('actual_position_id');
        $mycandidate->company_id =  $request->input('company_id');
        $mycandidate->country_id =  $request->input('country_id');
        $mycandidate->compensation_id = $request->input('compensation_id');


        if ($mycandidate->save()) {
            return redirect()->route('candidates.index')
            ->withSuccess(trans('app.candidate_created')); 
        }
        else{
            return redirect()->route('candidates.index')
            ->withFlashDanger(trans('No creado'));
        }   
    }

    /**
     * Display specified candidate.
     *
     * @param CandidateRepository $candidate
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view ($id)
    {
        $candidate = $this->candidates->find($id);

        if(!isset($candidate))
                return redirect()->route('candidates.index')
                    ->withErrors(trans('app.register_not_found'));

        if(Auth::user()->hasRole('Consultant') Or Auth::user()->hasRole('Consultant Unverified'))
        {
            if($candidate->supplier_user_id != $this->theUser->id)
                return redirect()->route('candidates.index')
                    ->withErrors(trans('app.no_entry_permission')); 
        }
        return view('candidate.view', compact('candidate'));
    }

    /**
     * Display for editing specified candidate.
     *
     * @param CandidateRepository $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit ($id)
    {
        $edit = true;
        $candidate = $this->candidates->find($id);

        if(!isset($candidate))
                return redirect()->route('candidates.index')
                    ->withErrors(trans('app.register_not_found'));

        if(Auth::user()->hasRole('Consultant') Or Auth::user()->hasRole('Consultant Unverified'))
        {
            if($candidate->supplier_user_id != $this->theUser->id)
                return redirect()->route('candidates.index')
                    ->withErrors(trans('app.no_entry_permission')); 
        }

        return view('candidate.add_edit', compact('edit', 'candidate')); 
    }

    /**
     * Update specified candidate with provided data.
     *
     * @param CandidateRepository $id
     * @param UpdateCandidateRequest $request
     * @return mixed
     */
    public function update (Request $request, FileManager $filemanager, $id)
    {
        /*if($request->file('file')){
            $name = $filemanager->uploadFile('candidate', $id);
            $this->candidates->update($id, ['file' => $name]);
        }

        $candidate = $this->candidates->update($id, $request->except('code', 'file'));

        return redirect()->back()
            ->withSuccess(trans('app.candidate_updated_successfully'));*/

        $mycandidate = Candidate::find($id);
        //$mycandidate->fill($request->all());
        $mycandidate->first_name =  $request->input('first_name');
        $mycandidate->last_name =   $request->input('last_name');
        $mycandidate->email =       $request->input('email');
        $mycandidate->telf =        $request->input('telf');
        $mycandidate->actual_position_id = $request->input('actual_position_id');
        $mycandidate->company_id =  $request->input('company_id');
        $mycandidate->country_id =  $request->input('country_id');
        $mycandidate->compensation_id = $request->input('compensation_id');
         if($mycandidate->save())
         {   
             return redirect()->route('candidates.index')->withFlashSuccess('Actualizado con éxito');
         }
    }

    /**
     * Remove specified candidate from system.
     *
     * @param CandidateRepository $candidate
     * @return mixed
     */
    public function delete ($id) 
    {
        $mycandidate = $this->candidates->find($id);

        /*if(!isset($candidate))
                return redirect()->route('candidates.index')
                    ->withErrors(trans('app.register_not_found'));

        if(Auth::user()->hasRole('Consultant') Or Auth::user()->hasRole('Consultant Unverified'))
        {
            if($candidate->supplier_user_id != $this->theUser->id)
                return redirect()->route('candidates.index')
                    ->withErrors(trans('app.no_entry_permission')); 
        }
        
        $this->candidates->delete($id);

        return redirect()->route('candidates.index')
            ->withSuccess(trans('app.candidate_deleted'));*/


        if($this->candidates->delete($id)){
            return redirect()->route('candidates.index')
             ->withSuccess(trans('app.candidate_deleted'));
        }
    }
}

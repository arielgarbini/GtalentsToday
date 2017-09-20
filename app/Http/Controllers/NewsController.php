<?php

namespace Vanguard\Http\Controllers;

use Auth;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Vanguard\Http\Requests\News\CreateNewsRequest;
use Vanguard\Http\Requests\News\UpdateNewsRequest;
use Vanguard\Repositories\News\NewsRepository;
use Vanguard\Http\Requests;
use Vanguard\User;
use Vanguard\News;

class NewsController extends Controller
{
    /**
     * @var User
     */
    protected $theUser;
    /**
     * @var NewRepository
     */
    private $news;

    /**
     * NewsController constructor.
     * @param NewRepository $news)
     */
    public function __construct(NewsRepository $news)
    {
        $this->middleware('permission:news.manage');
        $this->news = $news;

        $this->theUser = Auth::user();
    }

    /**
     * Display page with all available news.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index () 
    {
        $perPage = 20;
        $news = $this->news->paginate($perPage, Input::get('search'), Input::get('status'));

    	return view('new.index', compact('news'));		
    }

    /**
     * Display form for creating new News.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create () 
    {
       	$edit = false;

        return view('new.add_edit', compact('edit'));	
    }

    /**
     * Store newly created New to database.
     *
     * @param CreateNewRequest $request
     * @return mixed
     */
    public function store (CreateNewsRequest $request)
    {
    	//temporal value
    	$request->merge(array('user_id' => $this->theUser->id));

        $data =  $request->all() ;
        $new = $this->news->create($data);

        return redirect()->route('news.index')
            ->withSuccess(trans('app.new_created'));    
    }

    /**
     * Display specified New.
     *
     * @param NewRepository $new
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view ($id)
    {
        $new = $this->news->find($id);

        return view('new.view', compact('new'));
    }

    /**
     * Display for editing specified New.
     *
     * @param NewRepository $new
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit ($id)
    {
        $edit = true;
        $new = $this->news->find($id);

        return view('new.add_edit', compact('edit', 'new')); 
    }

    /**
     * Update specified New with provided data.
     *
     * @param NewRepository $new
     * @param UpdateNewRequest $request
     * @return mixed
     */
    public function update (UpdateNewsRequest $request, $id)
    {
        $new = $this->news->update($id, $request->all());

        return redirect()->back()
            ->withSuccess(trans('app.new_updated_successfully'));
    }

    /**
     * Remove specified New from system.
     *
     * @param NewRepository $new
     * @return mixed
     */
    public function delete ($id) 
    {   
        $this->news->delete($id);

        return redirect()->route('news.index')
            ->withSuccess(trans('app.new_deleted'));
    }
}

<?php

namespace Vanguard\Http\Controllers;

use Auth;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Vanguard\Http\Requests\Category\CreateCategoryRequest;
use Vanguard\Http\Requests\Category\UpdateCategoryRequest;
use Vanguard\Repositories\Category\CategoryRepository;
use Vanguard\Http\Requests;
use Vanguard\User;
use Vanguard\Category;
use Vanguard\Events\User\ChangedAvatar;
use Vanguard\Services\Upload\CategoryAvatarManager;

class CategoryController extends Controller
{
    /**
     * @var User
     */
    protected $theUser;
    /**
     * @var CategoryRepository
     */
    private $categories;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $categories)
     */
    public function __construct(CategoryRepository $categories)
    {
        $this->middleware('permission:categories.manage');
        $this->categories = $categories;

        $this->theUser = Auth::user();
    }

    /**
     * Display page with all available categories.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index () 
    {
        $perPage = 20;
        $categories = $this->categories->paginate($perPage, Input::get('search'), Input::get('status'));

    	return view('category.index', compact('categories'));		
    }

    /**
     * Display form for creating new category.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create () 
    {
       	$edit = false;

        return view('category.add_edit', compact('edit'));	
    }

    /**
     * Store newly created category to database.
     *
     * @param CreateCategoryRequest $request
     * @return mixed
     */
    public function store (CreateCategoryRequest $request, CategoryAvatarManager $avatarManager)
    {
    	//Temporal value language
    	$request->merge(array('language_id' => 2));

        $data =  $request->all() ;
        $category = $this->categories->create($data);
        if($request->file('avatar')){
            $name = $avatarManager->uploadAndCropAvatar($category);
            $this->categories->update($category->id, ['avatar' => $name]);
        }

        return redirect()->route('categories.index')
            ->withSuccess(trans('app.category_created'));    
    }

    /**
     * Display specified category.
     *
     * @param CategoryRepository $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view ($id)
    {
        $category = $this->categories->find($id);

        return view('category.view', compact('category'));
    }

    /**
     * Display for editing specified category.
     *
     * @param CategoryRepository $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit ($id)
    {
        $edit = true;
        $category = $this->categories->find($id);

        return view('category.add_edit', compact('edit', 'category')); 
    }

    /**
     * Update specified category with provided data.
     *
     * @param CategoryRepository $category
     * @param UpdateCategoryRequest $request
     * @return mixed
     */
    public function update (UpdateCategoryRequest $request, $id)
    {
        $category = $this->categories->update($id, $request->all());

        return redirect()->back()
            ->withSuccess(trans('app.category_updated_successfully'));
    }

    /**
     * Remove specified category from system.
     *
     * @param CategoryRepository $category
     * @return mixed
     */
    public function delete ($id) 
    {   
        $this->categories->delete($id);

        return redirect()->route('categories.index')
            ->withSuccess(trans('app.category_deleted'));
    }

    /**
     * Upload and update category's avatar.
     *
     * @param Request $request
     * @param CategoryAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatar(Category $category, CategoryAvatarManager $avatarManager)
    {
        $name = $avatarManager->uploadAndCropAvatar($category);

        return $this->handleAvatarUpdate($name, $category);
    }

    /**
     * Update avatar for currently logged in category
     * and fire appropriate event.
     *
     * @param $avatar
     * @return mixed
     */
    private function handleAvatarUpdate($avatar, $category)
    {
        $this->categories->update($category->id, ['avatar' => $avatar]);

        //event(new ChangedAvatar);

        return redirect()->back()
            ->withSuccess(trans('app.avatar_changed'));
    }

    /**
     * Update user's avatar from external location/url.
     *
     * @param Request $request
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateAvatarExternal(Category $category, CategoryAvatarManager $avatarManager)
    {
        $avatarManager->deleteAvatarIfUploaded($category);

        return $this->handleAvatarUpdate('', $category);
    }
}

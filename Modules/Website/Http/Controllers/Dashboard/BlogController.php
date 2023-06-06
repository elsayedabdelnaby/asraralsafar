<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Website\Entities\Blog;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\Blogs\StoreBlogAction;
use Modules\Website\Actions\Blogs\DeleteBlogAction;
use Modules\Website\Actions\Blogs\ToggleBlogAction;
use Modules\Website\Actions\Blogs\UpdateBlogAction;
use Modules\Website\Actions\Blogs\GetAllBlogsAction;
use Modules\Website\Http\Requests\Blogs\EditBlogRequest;
use Modules\Website\Http\Requests\Blogs\StoreBlogRequest;
use Modules\Website\Http\Requests\Blogs\DeleteBlogRequest;
use Modules\Website\Http\Requests\Blogs\ToggleBlogRequest;
use Modules\Website\Http\Requests\Blogs\UpdateBlogRequest;
use Modules\Settings\Actions\Categories\FilterCategoriesAction;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $blogs = (new GetAllBlogsAction)->handle();
            $blogs = $blogs->select([
                'blogs.id',
                'title',
                'short_description',
                'likes_number',
                'sharings_number',
                'views_number',
                'is_active',
                'blogs.image',
                DB::raw('category_translations.name AS category_name'),
                DB::raw('NULL AS actions')
            ])->get();
            $total = count($blogs);
            return [
                'data' => $blogs,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('website::blogs.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $request->request->add(['category_type_id' => 2, 'all' => true]);
        $categories = (new FilterCategoriesAction)->handle($request)->select(['categories.id', 'category_translations.name'])->get();
        return view('website::blogs.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.website.blogs.store'),
                'categories' => $categories
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreBlogRequest $request
     * @param StoreBlogAction $action
     * @return Renderable
     */
    public function store(StoreBlogRequest $request, StoreBlogAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/website/blogs')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/blogs')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified privacy policy.
     * @param ToggleBlogRequest $request
     * @param ToggleBlogAction $action
     * @param int $id
     * @return Renderable
     */
    public function toggle(ToggleBlogRequest $toggle_request, ToggleBlogAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status' => 'success',
                    'message' => __('website::dashboard.the_blog_toggle_was_successfully'),
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ]
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditBlogRequest $request
     * @return Renderable
     */
    public function edit(EditBlogRequest $request)
    {
        $request->request->add(['category_type_id' => 2, 'all' => true]);
        $categories = (new FilterCategoriesAction)->handle($request)->select(['categories.id', 'category_translations.name'])->get();
        return view('website::blogs.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.website.blogs.update', ['id' => $request->id]),
                'blog' => Blog::find($request->id),
                'categories' => $categories
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateBlogRequest $request
     * @param UpdateBlogAction $action
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateBlogRequest $request, UpdateBlogAction $action)
    {
        try {
            $action->handle($request, Blog::findOrFail($request->id));
            return redirect('dashboard/website/blogs')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/website/blogs')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteBlogRequest $request
     * @param DeleteBlogAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteBlogRequest $request, DeleteBlogAction $action)
    {
        return $action->handle($request);
    }
}

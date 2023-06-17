<?php

namespace Modules\Website\Http\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Website\Entities\Blog;
use Modules\Website\Entities\MetaPage;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\Blogs\GetBlogRowAction;
use Modules\Website\Actions\Blogs\GetAllBlogsAction;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $blogs = Blog::with('translations')->paginate(3);

        $languageId = getCurrentLanguage()->id;
        $metaPage = MetaPage::whereHas('translations', function ($query) use ($languageId) {
            $query->where('language_id', $languageId);
        })->where('page', 'blogs')->get();

        return view('website::website.blog.index', compact('blogs', 'metaPage'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('website::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($slug)
    {
        $blog = Blog::whereHas('translations', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->first();

        return view('website::website.blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('website::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

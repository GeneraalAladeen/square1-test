<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Posts\CreatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View;
     */
    public function index(Request $request)
    {

        return view('posts.index',[
            'posts' => Post::query()
                ->select(['title', 'description', 'slug', 'publication_date'])
                ->where('user_id', auth()->id())
                ->orderBy($request->sort_by ?? 'id', $request->direction ?? 'desc')
                ->simplePaginate(10)->appends($request->all()),

            'sort_params' => POST_SORT_PARAMS,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View;
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePostRequest  $request
     * @return \Illuminate\Http\RedirectResponse;
     */
    public function store(CreatePostRequest $request)
    {
        $data = $request->validated();

        Post::query()->create(array_merge([
            'user_id' => auth()->id(),
            'slug' => makeSlug($data['title'])
        ],$data));

        return redirect()
            ->route('posts.index')
            ->with('status', 'Post Created Successfuly!');
    }

}

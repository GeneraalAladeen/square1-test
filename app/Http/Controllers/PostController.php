<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Interfaces\PostRepositoryInterface;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\QueryPostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;


class PostController extends Controller
{

    /**
     * @var PostRepositoryInterface
     */
    private $postRespository;


    public function __construct(PostRepositoryInterface $postRespository)
    {
        $this->postRespository = $postRespository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return View;
     */
    public function index(QueryPostRequest $request): View
    {
        $data = $request->validated();

        return view('posts.index',[
            'posts' => $this->postRespository->getUserPosts($data['sort_by'] ?? 'id', $data['sort_direction'] ?? 'desc', $data['per_page'] ?? 10),
            'sort_fields' => POST_SORT_FIELDS,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View;
     */
    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePostRequest  $request
     * @return RedirectResponse;
     */
    public function store(CreatePostRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $body = array_merge([
            'user_id' => auth()->id(),
            'slug' => makeSlug($data['title'])
        ],$data);

        $this->postRespository->create($body);

        return redirect()->route('posts.index')->with('status', 'Post Created Successfuly!');
    }

}

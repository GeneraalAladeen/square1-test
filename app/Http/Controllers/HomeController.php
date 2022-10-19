<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\Posts\QueryPostRequest;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRespository;


    public function __construct(PostRepositoryInterface $respository)
    {
        $this->postRespository = $respository;
    }


     /**
     * @param QueryPostRequest $request
     *
     * @return View
     */
    public function index(QueryPostRequest $request): View
    {
        $data = $request->validated();

        return view('welcome',[
            'posts' => $this->postRespository->getPaginate($data['sort_by'] ?? 'id', $data['sort_direction'] ?? 'desc', $data['per_page'] ?? 10),
            'sort_fields' => POST_SORT_FIELDS,
        ]);
    }

    /**
     * @param Post $post
     * 
     * @return View
     */
    public function show(Post $post): View
    {
        $post->load('user');

        return view('posts.show', [
            'post' => $post,
        ]);
    }
}

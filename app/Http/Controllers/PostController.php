<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View;
     */
    public function index(Request $request)
    {
         $SORT_PARAMS = [
            'publication_date' => 'Date Published',
        ];
    
         $SORT_DIRECTIONS = [
            'asc' => 'Ascending',
            'desc' => 'Descending',
        ];

       


        return view('posts.index',[
            'posts' => Post::query()
                ->select(['title', 'description', 'slug', 'publication_date'])
                ->where('user_id', auth()->id())
                ->orderBy($request->sort_by ?? 'id', $request->direction ?? 'desc')
                ->simplePaginate(10)->appends($request->all()),

            'sort_params' => $SORT_PARAMS,
            'directions' => $SORT_DIRECTIONS,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View;
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View;
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View;
     */
    public function show($id)
    {
        $post->load('user');

        return view('posts.show', [
            'post' => $post,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View;
     */
    public function destroy($id)
    {
        //
    }
}

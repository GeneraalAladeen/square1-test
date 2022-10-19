<?php

namespace App\Repositories;

use App\Models\Post;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;


class PostRepository implements PostRepositoryInterface 
{
    /**
     * Get posts that belongs to authenticated user
     * 
     * @param string $sortBy
     * @param string $sortDirection
     * @param int $perPage
     * 
     * @return Paginator
     */
    public function getUserPosts(string $sortBy = 'id', string $sortDirection = 'desc', int $perPage = 10): Paginator
    {
        return Post::query()
            ->select(['title', 'description', 'slug', 'publication_date'])
            ->where('user_id', auth()->id())
            ->orderBy($sortBy, $sortDirection)
            ->simplePaginate($perPage);
    }

     /**
     * Get all posts 
     * 
     * @param string $sortBy
     * @param string $sortDirection
     * @param int $perPage
     * 
     * @return Paginator
     */
    public function getPaginate(string $sortBy = 'id', string $sortDirection = 'desc', int $perPage = 10): Paginator
    {
        return Post::query()
        ->with(['user'])
            ->orderBy($sortBy, $sortDirection)
            ->simplePaginate($perPage);
    }


    /**
     * Create new post
     * 
     * @param array $data
     * 
     * @return Post
     */
    public function create(array $data): Post
    {
        return Post::create($data);
    }

}
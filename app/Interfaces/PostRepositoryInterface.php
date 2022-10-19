<?php

namespace App\Interfaces;

use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;


interface PostRepositoryInterface 
{
    /**
     * @param array $data
     * 
     * @return Post
     */
    public function create(array $data): Post;

    /**
     * 
     * @param string $sortBy
     * @param string $sortDirection
     * @param int $perPage
     * 
     * @return Paginator
     */
    public function getUserPosts(string $sortBy, string $sortDirection, int $perPage): Paginator;

      /**
     * 
     * @param string $sortBy
     * @param string $sortDirection
     * @param int $perPage
     * 
     * @return Paginator
     */
    public function getPaginate(string $sortBy, string $sortDirection, int $perPage): Paginator;
}
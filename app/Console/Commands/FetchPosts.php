<?php

namespace App\Console\Commands;

use App\Models\{User, Post};
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch new posts from external api and add to database';

    /**
     * 
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PostRepositoryInterface $repository)
    {
        parent::__construct();
        $this->postRepository = $repository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $response = Http::get(config('services.post.endpoint'));
            
            if( $response->failed() ){
                return Log::error('An error was encountered while fetching posts', $response->json());
            }

            $articles = $response->json('articles');

            $admin = User::query()->select(['id'])->where('username', 'admin')->firstOrFail();
            
            DB::transaction(function () use ($admin , $articles) {
                foreach( $articles as $article ) {
                    $this->postRepository->create(array_merge([
                        'user_id' => $admin->id,
                        'publication_date' => now(),
                        'slug' => makeSlug($article['title'])
                    ] , $article));
                }
            });


        $this->info($response->json('count'). ' posts fetched successfully!');
        
        }  catch (\Throwable $exception) {
            Log::error($exception->getMessage());
        }
        
    }
}

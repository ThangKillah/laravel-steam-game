<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use App\Traits\GameApi;
use App\Traits\GameSpotApi;

class GamingController extends Controller
{
    use GameApi, GameSpotApi;

    private $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function test()
    {
        $review = $this->getBlog(1);
        //$game = $this->getGame(1);
        dd($review);
    }

    public function home()
    {
        $blogs = $this->blogRepository->getBlogSearch();

        $topBlog = $this->blogRepository->getTopBlog();
        return view('home')->with([
            'topBlog' => $topBlog,
            'blogs' => $blogs
        ]);
    }
}

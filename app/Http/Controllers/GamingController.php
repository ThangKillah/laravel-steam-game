<?php

namespace App\Http\Controllers;

use App\Repositories\AssociationRepository;
use App\Repositories\BlogRepository;
use App\Repositories\GameRepository;
use App\Repositories\ReviewRepository;
use App\Traits\GameApi;
use App\Traits\GameSpotApi;

class GamingController extends Controller
{
    use GameApi, GameSpotApi;

    private $blogRepository;
    private $gameRepository;
    private $reviewRepository;
    private $associationRepository;

    public function __construct(BlogRepository $blogRepository, GameRepository $gameRepository, ReviewRepository $reviewRepository, AssociationRepository $associationRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->gameRepository = $gameRepository;
        $this->reviewRepository = $reviewRepository;
        $this->associationRepository = $associationRepository;
    }

    public function test()
    {
        $review = $this->getBlog(1);
        //$game = $this->getGame(1);
        dd($review);
    }

    public function home()
    {
        $upComingGames = $this->gameRepository->getTopUpComingGame(config('constant.limit_upcoming_game'));

        $topReviews = $this->reviewRepository->getTopReview(config('constant.limit_top_review'));

        $blogs = $this->blogRepository->getBlogSearch();

        $platforms = $this->associationRepository->getAllPlatform();

        $topBlog = $this->blogRepository->getTopBlog();

        return view('home')->with([
            'topBlog' => $topBlog,
            'blogs' => $blogs,
            'upcomingGames' => $upComingGames,
            'topReviews' => $topReviews,
            'platforms' => $platforms
        ]);
    }
}

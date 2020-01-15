<?php

namespace App\View\Composers;

use App\Repositories\PlatformRepository;
use Illuminate\View\View;

class PlatformComposer
{
    /**
     * The user repository implementation.
     *
     * @var PlatformRepository
     */
    protected $platformRepo;

    /**
     * Create a new profile composer.
     *
     * @param PlatformRepository $platformRepository
     * @return void
     */
    public function __construct(PlatformRepository $platformRepository)
    {
        // Dependencies automatically resolved by service container...
        $this->platformRepo = $platformRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('platforms_all', $this->platformRepo->all());
    }
}
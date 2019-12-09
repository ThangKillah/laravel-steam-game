<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ReviewRepository.
 *
 * @package namespace App\Repositories;
 */
interface ReviewRepository extends RepositoryInterface
{
    public function getTopReview(int $number);
}

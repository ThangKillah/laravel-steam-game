<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BlogRepository.
 *
 * @package namespace App\Repositories;
 */
interface BlogRepository extends RepositoryInterface
{
    public function getTopBlog();

    public function getBlogSearch($condition = []);

    public function getBlogDetail($slug, $id);

    public function getRelatedBlog($category);

    public function getRecentBlog();
}

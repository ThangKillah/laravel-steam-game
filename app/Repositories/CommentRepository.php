<?php

namespace App\Repositories;

use App\Model\Comment;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CommentRepository.
 *
 * @package namespace App\Repositories;
 */
interface CommentRepository extends RepositoryInterface
{
    public function getCommentByBlog($blogId, $sortBy = Comment::LATEST);

    public function postCommentAjax($data = []);

    public function editComment($id, $content, $oldContent);

    public function getCommentById($id);

    public function deleteCommentById($id);
}

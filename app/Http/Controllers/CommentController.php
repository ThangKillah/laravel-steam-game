<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditComment;
use App\Http\Requests\PostComment;
use App\Repositories\CommentRepository;
use App\Traits\Helper;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    use Helper;
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function ajaxGetComment(Request $request)
    {
        $comments = $this->commentRepository->getCommentByBlog($request->get('core_id'), $request->input('sortBy'));

        return view('ajax.comment')->with([
            'comments' => $comments
        ]);
    }

    public function postComment(PostComment $request)
    {
        if (Sentinel::check()) {
            return $this->commentRepository->postCommentAjax($request->all());
        } else {
            return $this->returnNotLogin();
        }
    }

    public function returnNotLogin()
    {
        return json_encode([
            'status' => Response::HTTP_UNAUTHORIZED,
            'message' => 'Need to login'
        ]);
    }

    public function ajaxEditComment(EditComment $request)
    {
        if (Sentinel::check()) {
            $idComment = $request->input('comment_id');
            $comment = $this->commentRepository->getCommentById($idComment);
            if (Sentinel::getUser()->id == $comment->user_id) {
                return $this->commentRepository->editComment($request->input('comment_id'), $request->input('content'), $comment->content);
            } else {
                return $this->returnNotLogin();
            }
        } else {
            return $this->returnNotLogin();
        }
    }

    public function ajaxDeleteComment(Request $request)
    {
        if (Sentinel::check()) {
            $idComment = $request->input('comment_id');
            $comment = $this->commentRepository->getCommentById($idComment);
            if (Sentinel::getUser()->id == $comment->user_id) {
                $this->deleteImageByContent($comment->content);
                $this->commentRepository->deleteCommentById($idComment);
                return json_encode([
                    'status' => Response::HTTP_OK,
                    'message' => 'Delete success comment'
                ]);
            } else {
                return $this->returnNotLogin();
            }
        } else {
            return $this->returnNotLogin();
        }
    }
}

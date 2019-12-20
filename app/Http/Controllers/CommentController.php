<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostComment;
use App\Repositories\CommentRepository;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
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
            return json_encode([
                'status' => Response::HTTP_UNAUTHORIZED,
                'message' => 'Need to login'
            ]);
        }
    }
}

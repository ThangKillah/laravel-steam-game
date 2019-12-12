<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function ajaxGetComment(Request $request)
    {
        $comments = $this->commentRepository->getCommentByBlog($request->get('core_id'));

        return view('ajax.comment')->with([
            'comments' => $comments
        ]);
    }
}

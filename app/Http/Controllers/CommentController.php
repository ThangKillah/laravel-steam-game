<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostComment;
use App\Repositories\CommentRepository;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\ImageManagerStatic as Image;

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

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time() . $image->getClientOriginalName();

            $image_resize = Image::make($image->getRealPath())->encode('jpg');

            $path = public_path(config('constant.image_comment_path'));
            if (!file_exists($path)) {
                mkdir($path, 666, true);
            }

            if ($image_resize->height() > config('constant.height_image_resize')) {
                $image_resize->resize(null, config('constant.height_image_resize'), function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image_resize->save($path . $filename);
            return config('services.homepage_url') . config('constant.image_comment_path') . $filename;
        }
        return json_encode([
            'message' => 'Not found image'
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

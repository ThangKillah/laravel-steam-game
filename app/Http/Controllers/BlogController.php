<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use App\Repositories\CommentRepository;
use App\Traits\Helper;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use Helper;

    private $blogRepository;
    private $commentRepository;

    public function __construct(BlogRepository $blogRepository, CommentRepository $commentRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->commentRepository = $commentRepository;
    }

    public function detail($id, $slug)
    {
        $blog = $this->blogRepository->getBlogDetail($slug, $id);

        if (empty($blog)) {
            return abort(404);
        }
        $blog->count_view = $blog->count_view + 1;
        $blog->save();


        $associations = [];
        if (!empty($blog->category)) {
            foreach ($blog->category as $cate) {
                $associations[] = [
                    'id' => $cate->association->id,
                    'name' => $cate->association->name
                ];
            }
        }

        if ($blog->author_id == 0) {
            $blog->body = $this->editContentGameSpot($blog->body);
            $blog->body = str_replace("/videos/embed", "https://www.gamespot.com/videos/embed", $blog->body);
            //           $blog->body = str_replace('href="/articles/', 'href="https://www.gamespot.com/articles/', $blog->body);
            //         $blog->body = str_replace("/gallery/", "https://www.gamespot.com/gallery/", $blog->body);
        }
        $relatedBlog = $this->blogRepository->getRelatedBlog($blog->category);


        $comments = $this->commentRepository->getCommentByBlog($blog->id);
        //dd($comments);

        return view('blog.detail')->with([
            'blog' => $blog,
            'relatedBlog' => $relatedBlog,
            'associations' => $associations,
            'comments' => $comments,
            'commentsCount' => $blog->comments_count
        ]);
    }

    public function ajaxGetListBlog(Request $request)
    {
        $blogs = $this->blogRepository->getBlogSearch($request->all());
        return view('ajax.blogs')->with(['blogs' => $blogs]);
    }
}

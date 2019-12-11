<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;

class BlogController extends Controller
{
    private $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function detail($id, $slug)
    {

        $blog = $this->blogRepository->getBlogDetail($slug, $id);
        $blog->count_view = $blog->count_view + 1;
        $blog->save();
        if (empty($blog)) {
            return abort(404);
        }
        if (!empty($blog->gamespot_id)) {
            $blog->body = str_replace("/videos/embed", "https://www.gamespot.com/videos/embed", $blog->body);
            $blog->body = str_replace('href="/articles/', 'href="https://www.gamespot.com/articles/', $blog->body);
            $blog->body = str_replace("/gallery/", "https://www.gamespot.com/gallery/", $blog->body);
        }

        $associationId = 0;
        $category = $blog->category;
        if (!empty($category)) {
            foreach ($category as $cate) {
                if ($cate->association->type == 'games') {
                    $associationId = $cate->association->id;
                    break;
                }
            }
        }

        return view('blog.detail')->with([
            'blog' => $blog
        ]);
    }
}

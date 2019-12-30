<?php

function urlBlogImage($jsonImage)
{
    $image = json_decode($jsonImage, true);
    $urlOrigin = $image['original'];
    if (strpos($urlOrigin, 'gamespot1') !== false) {
//        if(\Request::route()->getName() == 'blog-detail'){
//            return $urlOrigin;
//        }
        return str_replace("/original/", "/screen_kubrick/", $urlOrigin);
    }
    return $urlOrigin;
}

function urlReviewImage($jsonImage)
{
    $image = json_decode($jsonImage, true);
    $urlOrigin = $image['original'];
    if (strpos($urlOrigin, 'gamespot1') !== false) {
        return str_replace("/original/", "/screen_tiny/", $urlOrigin);
    }
    return $urlOrigin;
}


function badgesBlog($cates)
{
    if (empty($cates)) {
        return 'N/A';
    }
    $arr = [];
    foreach ($cates as $cate) {
        if (!empty($cate->association) && $cate->association->type === 'platform') {
            $arr[] = $cate->association->name;
        }
    }
    return implode(", ", $arr);
}

function showImageGameUrl($coverId)
{
    return 'https://images.igdb.com/igdb/image/upload/t_screenshot_big/' . $coverId . '.jpg';
}

function showUrlSocial($social, $nextUrl)
{
    if (empty($nextUrl)) {
        return route('social-redirect', ['social' => $social]);
    }
    $scrollTo = '';
    if (\Illuminate\Support\Facades\Route::currentRouteName() === "blog-detail") {
        $scrollTo = '#comments';
    }
    return route('social-redirect', ['social' => $social]) . '?nextUrl=' . $nextUrl . $scrollTo;
}

function redirectSignIn($type)
{
    return route($type) . '?nextUrl=' . \Illuminate\Support\Facades\Request::url();
}

function hashId($id)
{
    return \Vinkla\Hashids\Facades\Hashids::encode($id);
}

function getUserId()
{
    if (\Cartalyst\Sentinel\Laravel\Facades\Sentinel::check()) {
        return hashId(\Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser()->id);
    }
    return 0;
}

function getRouteBlogDetail($blog)
{
    return route('blog-detail', ['slug' => $blog->slug, 'id' => hashId($blog->id)]);
}

function getUser()
{
    return \Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser();
}

function checkLoginUser()
{
    return \Cartalyst\Sentinel\Laravel\Facades\Sentinel::check();
}

function showRating($rating)
{
    return empty($rating) ? 0 : round($rating);
}

function showImage
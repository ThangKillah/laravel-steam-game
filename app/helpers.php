<?php

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Vinkla\Hashids\Facades\Hashids;

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
    if (Route::currentRouteName() === "blog-detail") {
        $scrollTo = '#comments';
    }
    return route('social-redirect', ['social' => $social]) . '?nextUrl=' . $nextUrl . $scrollTo;
}

function redirectSignIn($type)
{
    return route($type) . '?nextUrl=' . Request::url();
}

function hashId($id)
{
    return Hashids::encode($id);
}

function getUserId()
{
    if (Sentinel::check()) {
        return hashId(Sentinel::getUser()->id);
    }
    return 0;
}

function getRouteBlogDetail($blog)
{
    return route('blog-detail', ['slug' => $blog->slug, 'id' => hashId($blog->id)]);
}

function getUser()
{
    return Sentinel::getUser();
}

function checkLoginUser()
{
    return Sentinel::check();
}

function showRating($rating)
{
    return empty($rating) ? 0 : round($rating);
}

function gameBackgroundImg($game)
{
    $imgs = json_decode($game->screenshots, true);
    return config('services.igdb_api_image') . '/t_screenshot_big/' . $imgs[0] . '.jpg';
}

function gameBigCover($game)
{
    return config('services.igdb_api_image') . '/t_cover_big/' . $game->cover . '.jpg';
}

function gameScreenshotFull($idImg)
{
    return config('services.igdb_api_image') . '/t_original/' . $idImg . '.jpg';
}

function gameScreenshot($idImg)
{
    return config('services.igdb_api_image') . '/t_screenshot_big/' . $idImg . '.jpg';
}

function getUrlTrailerGame($game)
{
    $videos = json_decode($game->videos, true);
    return 'https://www.youtube.com/watch?v=' . $videos[0]['video_id'];
}

function showCheckMark($check)
{
    if ($check) {
        return '<i class="fa fa-check" style="color: #0E9A49;" aria-hidden="true"></i>';
    }
    return '<i class="fa fa-times"  style="color: #e74c3c;" aria-hidden="true"></i>';
}
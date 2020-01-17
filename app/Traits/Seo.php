<?php

namespace App\Traits;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Carbon\Carbon;


trait Seo
{
    public function homeSeo()
    {
        $des = __('Discover something new to play, no matter the platform!');

        SEOMeta::setTitle(__('Home'));
        SEOMeta::setDescription($des);
        SEOMeta::setCanonical(route('home'));

        OpenGraph::setDescription($des);
        OpenGraph::setTitle(__('Home'));
        OpenGraph::setUrl(route('home'));
        OpenGraph::addProperty('type', 'website');

        JsonLd::setTitle(__('Home'));
        JsonLd::setDescription($des);
        JsonLd::addImage(asset('img/game.png'));
    }

    public function blogSEO($post, $associations)
    {
        SEOMeta::setTitle($post->title);
        SEOMeta::setDescription($post->deck);
        SEOMeta::addMeta('article:published_time', Carbon::parse($post->publish_date)->toW3CString(), 'property');
        //SEOMeta::addMeta('article:section', $post->category, 'property');

        if (count($associations) >= 1) {
            SEOMeta::addKeyword((string)array_column($associations, 'name'));
        }

        OpenGraph::setDescription($post->deck);
        OpenGraph::setTitle($post->title);
        OpenGraph::setUrl(route('blog-detail', ['slug' => $post->slug, 'id' => hashId($post->id)]));
        OpenGraph::addProperty('type', 'article');

        if (config('app.locale') == 'en') {
            OpenGraph::addProperty('locale', 'en-us');
        }
        if (config('app.locale') == 'vi') {
            OpenGraph::addProperty('locale', 'vi-vn');
        }

        OpenGraph::addProperty('locale:alternate', ['vi-vn', 'en-us']);

        OpenGraph::addImage(urlBlogImage($post->image));

        JsonLd::setTitle($post->title);
        JsonLd::setDescription($post->deck);
        JsonLd::setType('Article');
        JsonLd::addImage(urlBlogImage($post->image));
    }

    public function gameSEO($game)
    {
        $des = $game->summary;
        if (!empty($des)) {
            SEOMeta::setDescription($des);
            OpenGraph::setDescription($des);
            JsonLd::setDescription($des);
        }

        SEOMeta::setTitle($game->name);
        SEOMeta::setCanonical(route('game-detail', ['slug' => $game->slug]));

        OpenGraph::setTitle($game->name);
        OpenGraph::setUrl(route('game-detail', ['slug' => $game->slug]));
        OpenGraph::addProperty('type', 'website');

        JsonLd::setTitle($game->name);
        JsonLd::addImage(gameScreenshot($game->cover));
    }
}
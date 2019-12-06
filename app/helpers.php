<?php

function urlBlogImage($jsonImage)
{
    $image = json_decode($jsonImage, true);
    $urlOrigin = $image['original'];
    if (strpos($urlOrigin, 'gamespot1') !== false) {
        return str_replace("/original/", "/screen_kubrick/", $urlOrigin);
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


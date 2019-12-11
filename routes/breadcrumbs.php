<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push(__('Home'), route('home-demo'));
});

Breadcrumbs::for('blog-detail', function ($trail, $blog) {
    $trail->parent('home');
    $trail->push($blog->title);
});
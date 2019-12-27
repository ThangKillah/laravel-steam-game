@extends('layout.blank')

@section('title', 'Discover something new to play, no matter the platform!')

@push('styles')
    <link href="{{ asset('plugins/owl-carousel/css/owl.carousel.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- main -->
    <section class="p-y-5">
        <div class="owl-carousel owl-posts">
            @foreach($topBlog as $top)
                <div class="post-carousel">
                    <a href="{{ getRouteBlogDetail($top) }}"><img class="lazyload"
                                                                  data-src="{{ urlBlogImage($top->image) }}" alt=""></a>
                    <span class="badge badge-ps4">{{ badgesBlog($top->category) }}</span>
                    <div class="post-block">
                        <div class="post-caption">
                            <h2 class="post-title">
                                <a href="{{ route('blog-detail', ['slug' => $top->slug, 'id' => \Vinkla\Hashids\Facades\Hashids::encode($top->id) ]) }}">{{ $top->title }}</a>
                            </h2>
                            <div class="post-meta">
                            <span><i class="fa fa-clock-o"></i> {{ $top->blog_date }} by <a
                                        href="javascript:void(0)">{{ $top->authors }}</a></span>
                                <span>
                                    <a href="{{ route('blog-detail', ['slug' => $top->slug, 'id' => \Vinkla\Hashids\Facades\Hashids::encode($top->id) ]) . '#comments'}}">
                                        <i class="fa fa-eye"></i>
                                        @if($top->count_view == 0)
                                            {{ rand(50,100) }}
                                        @else
                                            {{ $top->count_view }}
                                        @endif
                                        views
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="p-t-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="toolbar-custom">
                        <div class="float-left cold-12 col-sm-6 p-l-0 p-r-10">
                            <div class="form-group input-icon-right">
                                <i class="fa fa-search"></i>
                                <input type="text" id="title-blog-search" class="form-control search-game"
                                       placeholder="Search Blog...">
                            </div>
                        </div>
                        <div class="dropdown float-left">
                            <button class="btn btn-default" type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true"><span id="span-platform">All Category</span></span><i
                                        class="fa fa-caret-down"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item drop-platform active" data-id="0" href="javascript:void(0)">All
                                    Category</a>
                                @foreach($platforms as $plat)
                                    <a class="dropdown-item drop-platform" data-id="{{ $plat->id }}"
                                       href="javascript:void(0)">{{ $plat->name }}</a>
                                @endforeach
                            </div>
                        </div>

                        <div class="btn-group float-right m-l-5 hidden-sm-down" role="group">
                            <a onclick="gridView()" class="btn btn-default btn-icon" href="javascript:void(0)"
                               role="button"><i
                                        class="fa fa-th-large"></i></a>
                            <a onclick="listView()" class="btn btn-default btn-icon" href="javascript:void(0)"
                               role="button"><i class="fa fa-bars"></i></a>
                        </div>

                        <div class="dropdown float-right">
                            <button class="btn btn-default" type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true"><span id="span-sort">Popular</span><i
                                        class="fa fa-caret-down"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item drop-sort active" data-id="{{ \App\Model\Blog::BEST }}"
                                   href="javascript:void(0)">Popular</a>
                                <a class="dropdown-item drop-sort" data-id="{{ \App\Model\Blog::NEWEST }}"
                                   href="javascript:void(0)">Newest</a>
                                <a class="dropdown-item drop-sort" data-id="{{ \App\Model\Blog::OLDEST }}"
                                   href="javascript:void(0)">Oldest</a>
                            </div>
                        </div>
                    </div>

                    <!-- post -->
                    <div id="blog-list">
                        @include('ajax.blogs', ['blogs' => $blogs])
                    </div>
                    <!-- /.post -->
                </div>

                <!-- sidebar -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <!-- widget-games -->
                        <div class="widget widget-games">
                            <h5 class="widget-title">Upcoming Games</h5>
                            @foreach($upcomingGames as $key => $game)
                                <a href="#"
                                   style="background-image: url('{{ showImageGameUrl($game->cover) }}')">
                                    <span class="overlay"></span>
                                    <div class="widget-block">
                                        <div class="count">{{ $key + 1 }}</div>
                                        <div class="description">
                                            <h5 class="title">{{ $game->name }}</h5>
                                            <span class="date">November 14, 2017</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- widget post -->
                        <div class="widget widget-post">
                            <h5 class="widget-title">Reviews</h5>
                            <ul class="widget-list">
                                @foreach($topReviews as $review)
                                    <li>
                                        <div class="widget-img">
                                            <a href="blog-post.html" style="position: relative">
                                                <img class="lazyload blur-up"
                                                     data-src="{{ urlReviewImage($review->image) }}" alt="">
                                                <div class="score-review">
                                                    @if($review->score >= 8)
                                                        <span class="badge badge-primary">{{ $review->score }}</span>
                                                    @elseif($review->score <8 && $review->score >= 7)
                                                        <span class="badge badge-success">{{ $review->score }}</span>
                                                    @elseif($review->score < 7 && $review->score >= 4)
                                                        <span class="badge badge-warning">{{ $review->score }}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ $review->score }}</span>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                        <div>
                                            <h4><a href="blog-post.html">{{ $review->title }}</a></h4>
                                            <span>{{ $review->date_by_format }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- widget tabs -->
                        <div class="widget widget-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link active" href="#comments"
                                                        aria-controls="comments" role="tab" data-toggle="tab"><i
                                                class="fa fa-comment-o"></i> Comments</a></li>
                                <li class="nav-item"><a class="nav-link" href="#popular" aria-controls="popular"
                                                        role="tab" data-toggle="tab">Popular</a></li>
                                <li class="nav-item"><a class="nav-link" href="#recent" aria-controls="recent"
                                                        role="tab" data-toggle="tab">Recent</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="comments">
                                    <ul class="widget-comments">
                                        @foreach($topComment as $comment)
                                            <li>
                                                <div><a href="javascript:void(0)"><img class="lazyload blur-up"
                                                                                       data-src="{{ asset('img/avatar.png') }}"
                                                                                       alt="{{ $comment->user->name }}"></a>
                                                </div>
                                                <div>
                                                    <a href="{{ route('blog-detail', ['slug' => $comment->blog->slug, 'id' => hashId($comment->core_id)]) }}#comments"><b>{{ $comment->user->name }}
                                                            :</b> {!! $comment->content !!}</a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="popular">
                                    <div class="widget-post">
                                        <ul class="widget-list">
                                            @foreach($topBlog as $key => $blog)
                                                <li>
                                                    @if($key == 0)<img class="lazyload blur-up"
                                                                       data-src="{{ urlBlogImage($blog->image) }}"
                                                                       alt="{{ $blog->image }}">
                                                    @endif
                                                    <h4>
                                                        <a href="{{ getRouteBlogDetail($blog) }}">{{ $blog->title }}</a>
                                                    </h4>
                                                    <span><i class="fa fa-clock-o"></i> {{ $blog->blog_date }}</span>
                                                    <span>{{ $blog->count_view }} views</span>
                                                    <p>{{ $blog->deck }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="recent">
                                    <div class="widget-post">
                                        <ul class="widget-list">
                                            @foreach($recentBlog as $key => $blog)
                                                <li>
                                                    @if($key == 0)<img class="lazyload blur-up"
                                                                       data-src="{{ urlBlogImage($blog->image) }}"
                                                                       alt="{{ $blog->title }}">@endif
                                                    <h4><a href="{{ getRouteBlogDetail($blog) }}">{{ $blog->title }}</a>
                                                    </h4>
                                                    <span><i class="fa fa-clock-o"></i> {{ $blog->blog_date }}</span>
                                                    <span>{{ $blog->count_view }} views</span>
                                                    <p>{{ $blog->deck }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- /main -->
@endsection

@push('js')
    <script type="text/javascript">
        var elements = document.getElementsByClassName("column");
        // Declare a loop variable
        var i;
        var current_layout = 'grid';

        // List View
        function listView() {
            current_layout = 'list';
            for (i = 0; i < elements.length; i++) {
                elements[i].style.width = "100%";
            }
        }

        // Grid View
        function gridView() {
            current_layout = 'grid';
            for (i = 0; i < elements.length; i++) {
                elements[i].style.width = "50%";
            }
        }

        var page = 1;
        var title = '';
        var platform = '';
        var sortBy = '{{ \App\Model\Blog::BEST }}';
        var load_by_hash_change = 1;

        $('#title-blog-search').on('change', function () {
            page = 1;
            title = $('#title-blog-search').val();
            getData(page);
        });

        $('.drop-platform').on('click', function () {
            if (!$(this).hasClass('active')) {
                page = 1;
                $('.drop-platform').removeClass('active');
                $(this).addClass('active');
                platform = $(this).data('id');
                $('#span-platform').html($(this).html());
                getData(page);
            }
        });

        $('.drop-sort').on('click', function () {
            if (!$(this).hasClass('active')) {
                page = 1;
                $('.drop-sort').removeClass('active');
                $(this).addClass('active');
                sortBy = $(this).data('id');
                $('#span-sort').html($(this).html());
                getData(page);
            }
        });

        $(window).on('hashchange', function () {
            if (window.location.hash) {
                page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    if (load_by_hash_change) {
                        getData(page);
                    }
                }
            }
        });

        $(document).ready(function () {
            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();

                $('li').removeClass('active');
                $(this).parent('li').addClass('active');

                page = $(this).attr('href').split('page=')[1];

                getData(page);
            });

        });

        function getData(page) {
            $.ajax({
                url: '{{ route('ajax-get-list-blog') }}' + '?page=' + page + '&title=' + title + '&platform=' + platform + '&sortBy=' + sortBy,
                type: "get",
                datatype: "html",
                beforeSend: function () {
                    showAjaxGif();
                },
                success: function (data) {
                    load_by_hash_change = 0;
                    hideAjaxGif();
                    $("#blog-list").empty().html(data);
                    $('html, body').animate({scrollTop: $('#blog-list').position().top}, 'slow');
                    if (current_layout === 'grid') {
                        gridView();
                    } else {
                        listView();
                    }
                    $('[data-toggle="tooltip"]').tooltip();
                    location.hash = page;
                    setTimeout(function () {
                        load_by_hash_change = 1
                    }, 500);
                },
                error: function (request, status, error) {
                    hideAjaxGif();
                }
            });
        }
    </script>
    <script src="{{ asset('plugins/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script>
        (function ($) {
            "use strict";
            // owl carousel
            $('.owl-posts').owlCarousel({
                lazyLoad: true,
                margin: 5,
                loop: true,
                dots: false,
                autoplay: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    1024: {
                        items: 1,
                        center: false
                    },
                    1200: {
                        items: 2,
                        center: true
                    }
                }
            });
        })(jQuery);
    </script>
@endpush
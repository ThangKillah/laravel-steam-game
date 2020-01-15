@extends('layout.blank')

@section('title', 'Discover something new to play, no matter the platform!')

@push('styles')
    <link href="{{ asset('plugins/owl-carousel/css/owl.carousel.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- main -->
    <section class="bg-secondary p-y-5">
        <div class="owl-carousel owl-posts home-top">
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
                    @include('game.sub.search_condition', ['game_id'=> 0])

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
                                <a href="{{ route('game-detail', ['slug'=> $game->slug]) }}"
                                   style="background-image: url('{{ showImageGameUrl($game->cover) }}')">
                                    <span class="overlay"></span>
                                    <div class="widget-block">
                                        <div class="count">{{ $key + 1 }}</div>
                                        <div class="description">
                                            <h5 class="title">{{ $game->name }}</h5>
                                            <span class="date">{{ $game->release_date }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="widget widget-games review-homepage">
                            <h5 class="widget-title">Reviews</h5>
                            @foreach($topReviews as $key => $review)
                                <a href="{{ route('game-detail', ['slug'=> $game->slug]) }}"
                                   style="background-image: url('{{ urlReviewImage($review->image) }}')">
                                    <span class="overlay"></span>
                                    <div class="widget-block">
                                        <div class="description">
                                            <h5 class="title text-capitalize text-over-two-line">{{ $review->game['name'] }}</h5>
                                            <span class="date">{{ $review->date_by_format }}</span>
                                        </div>
                                        <div class="description">
                                            <div class="chart" data-percent="{{ $review->score / 10 * 100 }}"
                                                 data-scale-color="#ffb400">
                                                <span class="percent">{{ $review->score / 10 * 100 }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
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
    <script src="{{ asset('plugins/easypiechart/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('plugins/easypiechart/jquery.easypiechart.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(function () {
                $('.chart').easyPieChart({
                    barColor: '#e45454',
                    trackColor: '#e3e3e3',
                    easing: 'easeOutBounce',
                    size: 80,
                    lineCap: 'square',
                    scaleLength: 2
                });
            });
        });
    </script>
    <script src="{{ asset('js/blog.search.js') }}"></script>
    <script src="{{ asset('plugins/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script>
        //load img default if 404 img
        $(document).ready(function () {
            $("img").each(function () {
                $(this).attr("onerror", "this.src='{{ asset('img/bg-empty.jpeg') }}'");
            });
        });

        (function ($) {
            "use strict";
            // owl carousel
            $('.owl-posts').owlCarousel({
                lazyLoad: true,
                margin: 5,
                loop: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 5000,
                nav: true,
                navText: [
                    '<a class="carousel-control-prev" href="javascript:void(0)" role="button" data-slide="prev">\n' +
                    '        <span class="carousel-control-prev-icon" aria-hidden="true"></span>\n' +
                    '        <span class="sr-only">Previous</span>\n' +
                    '      </a>',

                    '<a class="carousel-control-next" href="javascript:void(0)" role="button" data-slide="next">\n' +
                    '        <span class="carousel-control-next-icon" aria-hidden="true"></span>\n' +
                    '        <span class="sr-only">Next</span>\n' +
                    '      </a>'
                ],
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
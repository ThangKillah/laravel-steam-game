@extends('layout.blank')

@section('title', 'Blank Page')

@push('styles')
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/slick/css/slick.css') }}"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/slick/css/slick-theme.css') }}"/>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.6/plyr.css"/>
    <link rel="stylesheet" href="{{ asset('plugins/jquery-bar-rating-master/dist/themes/bars-square.css') }}">
@endpush

@section('breadcrumb')
    <section class="breadcrumbs">
        <div class="container">
            {{ Breadcrumbs::render('home') }}
        </div>
    </section>
@endsection

@section('content')
    @if(Sentinel::check())
        {{ Sentinel::getUser() }}
    @endif

    <div class="container">
        <div class="row" style="margin-bottom: 50px;">
            <div class="col">
                <div class="box box-blue box-example-square">
                    <div class="box-header">Square Rating</div>
                    <div class="box-body">
                        <select id="example-square" name="rating" autocomplete="off" hidden>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-slider" id="main-slider">
            <div id="player1" data-plyr-provider="youtube" data-plyr-embed-id="xfJPCenjZzY"></div>
            <div id="player2" data-plyr-provider="youtube" data-plyr-embed-id="bTqVqk7FSmY"></div>
        </div>

        <div class="slicker-show-up slider d-flex mb-5 p-2">
            <div class="game-list-inline-item">
                <a class="img-box" href="https://images.igdb.com/igdb/image/upload/t_original/co1rh5.jpg"
                   data-lightbox='{"disqus": true, "gallery": "uncharted"}'>
                    <img class="img-responsive" src="https://images.igdb.com/igdb/image/upload/t_original/co1rh5.jpg"
                         alt="">
                    <div class="overlay-img">
                        <div class="text"><i class="fa fa-search-plus" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="game-list-inline-item">
                <a class="img-box" href="https://images.igdb.com/igdb/image/upload/t_original/co1re8.jpg"
                   data-lightbox='{"disqus": true, "gallery": "uncharted"}'>
                    <img class="img-responsive" src="https://images.igdb.com/igdb/image/upload/t_original/co1re8.jpg"
                         alt="">
                    <div class="overlay-img">
                        <div class="text"><i class="fa fa-search-plus" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="slicker-show-up slider d-flex mb-5 p-2">
            {{--        <div class="media-thumbs-scroll media-thumbs-scroll-left">--}}
            {{--            <i style="line-height: 60px; font-size: 60px;" class="fa fa-angle-left" aria-hidden="true"></i>--}}
            {{--        </div>--}}
            <div class="game-list-inline-item">
                <a href="/games/immortal-unchained"><span>Overwatch</span>
                    <img
                            alt="adasd"
                            class="img-responsive"
                            src="https://images.igdb.com/igdb/image/upload/t_original/co1rh5.jpg">
                </a>
            </div>
            <div class="game-list-inline-item">
                <a href="/games/immortal-unchained"><span>Overwatch</span>
                    <img
                            alt="adasd"
                            class="img-responsive"
                            src="https://images.igdb.com/igdb/image/upload/t_original/co1re8.jpg">
                </a>
            </div>
            <div class="game-list-inline-item">
                <a href="/games/immortal-unchained"><span>Overwatch</span>
                    <img
                            alt="adasd"
                            class="img-responsive"
                            src="https://images.igdb.com/igdb/image/upload/t_original/co1rh5.jpg">
                </a>
            </div>
            <div class="game-list-inline-item">
                <a href="/games/immortal-unchained"><span>Overwatch</span>
                    <img
                            alt="adasd"
                            class="img-responsive"
                            src="https://images.igdb.com/igdb/image/upload/t_original/co1re8.jpg">
                </a>
            </div>
            <div class="game-list-inline-item">
                <a href="/games/immortal-unchained"><span>Overwatch</span>
                    <img
                            alt="adasd"
                            class="img-responsive"
                            src="https://images.igdb.com/igdb/image/upload/t_original/co1rh5.jpg">
                </a>
            </div>
            <div class="game-list-inline-item">
                <a href="/games/immortal-unchained"><span>Overwatch</span>
                    <img
                            alt="adasd"
                            class="img-responsive"
                            src="https://images.igdb.com/igdb/image/upload/t_original/co1re8.jpg">
                </a>
            </div>
        </div>
        <!-- /main -->
    </div>
@endsection

@push('js')
    <script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
    <script type="text/javascript" src="{{ asset('plugins/slick/js/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/lightbox/lightbox.js') }}"></script>
    <script src="{{ asset('plugins/jquery-bar-rating-master/dist/jquery.barrating.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#example-square').barrating({
                theme: 'bars-square',
                // Specify a theme
                showValues: true,
                showSelectedRating: true
            });


            var slideWrapper = $("#main-slider");

            function postMessageToPlayer(player, command) {
                if (player == null || command == null) return;
                player.contentWindow.postMessage(JSON.stringify(command), "*");
            }

            function playPauseVideo(slick, control) {
                var currentSlide, slideType, startTime, player, video;

                currentSlide = slick.find(".slick-current");
                player = currentSlide.find("iframe").get(0);
                console.log(player);
                switch (control) {
                    case "play":
                        postMessageToPlayer(player, {
                            "event": "command",
                            "func": "playVideo"
                        });
                        break;
                    case "pause":
                        postMessageToPlayer(player, {
                            "event": "command",
                            "func": "pauseVideo"
                        });
                        break;
                }
            }

            slideWrapper.on("beforeChange", function (event, slick) {
                slick = $(slick.$slider);
                playPauseVideo(slick, "pause");
            });

            slideWrapper.on("afterChange", function (event, slick) {
                slick = $(slick.$slider);
                playPauseVideo(slick, "play");
            });

            const player1 = new Plyr('#player1', {
                //youtube: { controls: 10 }
            });

            const player2 = new Plyr('#player2', {
                /* options */
            });

            $('#main-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                //autoplay: true,
                infinite: true,
                adaptiveHeight: true,
                //autoplaySpeed: 4000,
                lazyLoad: "progressive",
                speed: 600,
                arrows: true,
                dots: true,
                draggable: false
            });

            $(".slicker-show-up").slick({
                // centerMode: true,
                // centerPadding: '60px',
                //infinite: true,
                autoplay: true,
                autoplaySpeed: 4000,
                variableWidth: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            //dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ],
            });
        });
    </script>
    <script>
        (function ($) {
            "use strict";
            // lightbox
            $('[data-lightbox]').lightbox({
                disqus: 'https-blog-game-com'
            });
        })(jQuery);
    </script>
@endpush


@extends('layout.blank')

@section('title', 'Blank Page')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/slick/css/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/slick/css/slick-theme.css') }}"/>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.6/plyr.css"/>
    <link rel="stylesheet" href="{{ asset('plugins/jquery-bar-rating-master/dist/themes/bars-square.css') }}">
@endpush

@section('content')
    <section class="hero hero-game" style="background-image: url('{{ empty(json_decode($game->screenshots)) ? asset('img/bg-empty.jpeg') : gameBackgroundImg($game) }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="hero-block row">
                <div class="hero-left col-lg-8">
                    <h2 class="hero-title">{{ $game->name }}</h2>
                    @if(!empty($game->summary))
                        <p class="text-over-summary-game">{{ $game->summary }}</p>
                    @endif
                    @if(!empty(json_decode($game->videos)))
                        <a class="btn btn-primary btn-shadow btn-rounded btn-lg"
                            href="{{ getUrlTrailerGame($game) }}" data-lightbox role="button">
                            Watch Trailer<i class="fa fa-play"></i>
                        </a>
                    @endif
                    <a class="btn btn-outline-default btn-shadow btn-rounded btn-lg m-l-10"
                       href="https://themeforest.net/item/gameforest-responsive-gaming-html-theme/5007730"
                       target="_blank" role="button">Follow Now<i class="fa fa-heart"></i></a>
                </div>
                <div class="hero-right col-lg-4">
                    <div class="hero-review">
                        <span>MetaCritic</span>
                        <a href="javascript:void(0)" class="chart easypiechart"
                           data-percent="{{ showRating($game->total_rating)  }}"
                           data-scale-color="#e3e3e3">
                            <span>{{ showRating($game->total_rating) }}</span>%
                        </a>
                    </div>
                    <div class="hero-review">
                        <span>User</span>
                        <a href="javascript:void(0)">{{ showRating($game->rating)  }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="p-t-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="tabs-color">
                        <ul class="nav nav-tabs nav-icon-left" role="tablist">
                            <li class="nav-item"><a class="nav-link active" href="#color-profile"
                                                    aria-controls="profile" role="tab" data-toggle="tab"><i
                                            class="fa fa-video-camera"></i> Highlight</a></li>
                            <li class="nav-item"><a class="nav-link" href="#color-settings" aria-controls="settings"
                                                    role="tab" data-toggle="tab"><i class="fa fa-user-plus"></i> Blog</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#color-inbox" aria-controls="inbox"
                                                    role="tab" data-toggle="tab"><i class="fa fa-bar-chart"></i>
                                    Review</a></li>
                            <li class="nav-item"><a class="nav-link" href="#color-games" aria-controls="games"
                                                    role="tab" data-toggle="tab"><i class="fa fa-heart-o"></i> Games</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="color-profile" role="tabpanel">
                                <p class="m-b-0">Mauris ultrices semper sapien, nec mollis orci aliquam a. Praesent nec
                                    urna quis enim venenatis faucibus. Aliquam hendrerit commodo diam, eu bibendum magna
                                    sodales et. In vestibulum ornare dapibus. Ut posuere urna eget turpis eleifend, a
                                    facilisis
                                    justo aliquet.</p>
                            </div>
                            <div class="tab-pane" id="color-settings" role="tabpanel">
                                <p class="m-b-0">Mauris ultrices semper sapien, nec mollis orci aliquam a. Praesent nec
                                    urna quis enim venenatis faucibus. Aliquam hendrerit commodo diam, eu bibendum magna
                                    sodales et. In vestibulum ornare dapibus. Ut posuere urna eget turpis eleifend, a
                                    facilisis
                                    justo aliquet.</p>
                            </div>
                            <div class="tab-pane" id="color-inbox" role="tabpanel">
                                <p class="m-b-0">Quisque et tincidunt dolor. Praesent nec lacinia dolor. Pellentesque
                                    ligula ante, dignissim a suscipit in, rutrum ac nulla. Fusce sagittis dolor massa,
                                    in pellentesque erat ultricies vitae.</p>
                            </div>
                            <div class="tab-pane" id="color-games" role="tabpanel">
                                <p class="m-b-0">Suspendisse massa nisi, maximus eu ligula posuere, blandit scelerisque
                                    neque. Praesent consequat leo malesuada, eleifend augue nec, porta quam.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget widget-game">
                        <div class="widget-block"
                             style="background-image: url('{{  empty($game->cover) ? asset('img/bg-empty.jpeg') : gameBigCover($game) }}')">
                            <div class="overlay"></div>
                            <div class="widget-item">
                                <h4>{{ $game->name }}</h4>
                                <span class="meta">Released: {{ $game->release_date }}</span>

                                <h5>Platforms</h5>

                                @if(!empty($game->platform))
                                    @foreach($game->platform as $plat_cate)
                                        <a href="javascript:void(0)"><span class="badge badge-ps4 mt-2">{{ $plat_cate->platform['name'] }}</span></a>
                                    @endforeach
                                @endif


                                @if(!empty($game->developed))
                                <h5>Developed</h5>
                                <ul>
                                    @foreach($game->developed as $cate)
                                        <li><a href="#">{{ $cate->company['name'] }}</a></li>
                                    @endforeach
                                </ul>
                                @endif

                                @if(!empty($game->publisher_game))
                                <h5>Published</h5>
                                <ul>
                                    @foreach($game->publisher_game as $cate)
                                        <li><a href="#">{{ $cate->company['name'] }}</a></li>
                                    @endforeach
                                </ul>
                                @endif
                                <p>The Witcher 3: Wild Hunt is a story-driven, next-generation open world
                                    role-playing game, set in a visually stunning fantasy universe, full of
                                    meaningful choices and impactful consequences.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
    <script type="text/javascript" src="{{ asset('plugins/slick/js/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/lightbox/lightbox.js') }}"></script>
    <script src="{{ asset('plugins/jquery-bar-rating-master/dist/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('plugins/sticky/jquery.sticky.js') }}"></script>
    <script src="{{ asset('plugins/easypiechart/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('plugins/easypiechart/jquery.easypiechart.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.chart').easyPieChart({
                barColor: '#5eb404',
                trackColor: '#e3e3e3',
                easing: 'easeOutBounce',
                onStep: function (from, to, percent) {
                    $(this.el).find('span').text(Math.round(percent));
                }
            });

            $('[data-lightbox]').lightbox();
        });
    </script>
@endpush


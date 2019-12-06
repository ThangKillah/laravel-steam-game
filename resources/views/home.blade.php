@extends('layout.blank')

@section('title', __('Home'))

@push('styles')
    <link href="{{ asset('plugins/owl-carousel/css/owl.carousel.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- main -->
    <section class="p-y-5">
        <div class="owl-carousel owl-posts">
            @foreach($topBlog as $top)
                <div class="post-carousel">
                    <a href="blog-post.html"><img src="{{ urlBlogImage($top->image) }}" alt=""></a>
                    <span class="badge badge-ps4">{{ badgesBlog($top->category) }}</span>
                    <div class="post-block">
                        <div class="post-caption">
                            <h2 class="post-title">
                                <a href="blog-post.html">{{ $top->title }}</a>
                            </h2>
                            <div class="post-meta">
                            <span><i class="fa fa-clock-o"></i> Julye 28, 2017 by <a
                                        href="profile.html">Venom</a></span>
                                <span><a href="blog-post.html#comments"><i
                                                class="fa fa-comment-o"></i> 98 comments</a></span>
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
                        <a class="btn btn-default btn-icon m-r-10 float-left hidden-xs-down" href="#"
                           data-toggle="tooltip" title="refresh" data-placement="bottom" role="button"><i
                                    class="fa fa-refresh"></i></a>
                        <div class="dropdown float-left">
                            <button class="btn btn-default" type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">All Platform <i class="fa fa-caret-down"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item active" href="#">All platform</a>
                                <a class="dropdown-item" href="#">Playstation 4</a>
                                <a class="dropdown-item" href="#">Xbox One</a>
                                <a class="dropdown-item" href="#">Origin</a>
                                <a class="dropdown-item" href="#">Steam</a>
                            </div>
                        </div>

                        <a class="btn btn-default btn-icon m-l-10 float-right hidden-xs-down" href="#"
                           data-toggle="tooltip" title="list" data-placement="bottom" role="button"><i
                                    class="fa fa-bars"></i></a>
                        <div class="dropdown float-right">
                            <button class="btn btn-default" type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">Date Added <i class="fa fa-caret-down"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item active" href="#">Date Added</a>
                                <a class="dropdown-item" href="#">Popular</a>
                                <a class="dropdown-item" href="#">Newest</a>
                                <a class="dropdown-item" href="#">Oldest</a>
                            </div>
                        </div>
                    </div>

                    <!-- post -->
                    @foreach($blogs as $blog)
                        <div class="post">
                            <h2 class="post-title"><a href="blog-post.html">{{ $blog->title }}</a></h2>
                            <div class="post-meta">
                                <span><i class="fa fa-clock-o"></i> June 16, 2017 by <a
                                            href="profile.html">{{ $blog->authors }}</a></span>
                                <span>
                                <a href="blog-post.html#comments"><i class="fa fa-comment-o"></i> 98 comments</a>
                            </span>
                            </div>
                            <div class="post-thumbnail">
                                <img src="{{ urlBlogImage($blog->image) }}"
                                     alt="Uncharted The Lost Legacy First Gameplay Details Revealed">
                                <span class="badge badge-ps4">{{ badgesBlog($blog->category) }}</span>
                            </div>
                            <p>{{ $blog->deck }}</p>
                        </div>
                    @endforeach

                    <div class="pagination-results">
                        <span>Showing 10 to 20 of 48 results</span>
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span
                                                aria-hidden="true"><i class="fa fa-angle-left"></i></span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="separate"><span>...</span></li>
                                <li class="page-item"><a class="page-link" href="#">25</a></li>
                                <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span
                                                aria-hidden="true"><i class="fa fa-angle-right"></i></span></a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- /.post -->
                </div>

                <!-- sidebar -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <!-- widget-games -->
                        <div class="widget widget-games">
                            <h5 class="widget-title">Upcoming Games</h5>
                            <a href="#"
                               style="background-image: url('https://i1.ytimg.com/vi/mW4LMCtoIkg/mqdefault.jpg')">
                                <span class="overlay"></span>
                                <div class="widget-block">
                                    <div class="count">1</div>
                                    <div class="description">
                                        <h5 class="title">Horizon: Zero Dawn The Frozen Wilds</h5>
                                        <span class="date">November 14, 2017</span>
                                    </div>
                                </div>
                            </a>
                            <a href="#"
                               style="background-image: url('https://i1.ytimg.com/vi/GaERL8Nrl9k/mqdefault.jpg')">
                                <span class="overlay"></span>
                                <div class="widget-block">
                                    <div class="count">2</div>
                                    <div class="description">
                                        <h5 class="title">Tom Clancy's Ghost Recon: Wildlands</h5>
                                        <span class="date">August 29, 2017</span>
                                    </div>
                                </div>
                            </a>
                            <a href="#"
                               style="background-image: url('https://i1.ytimg.com/vi/feqIj5PaqCQ/mqdefault.jpg')">
                                <span class="overlay"></span>
                                <div class="widget-block">
                                    <div class="count">3</div>
                                    <div class="description">
                                        <h5 class="title">Call of Duty WW2</h5>
                                        <span class="date">December 15, 2017</span>
                                    </div>
                                </div>
                            </a>
                            <a href="#"
                               style="background-image: url('https://i.ytimg.com/vi/N1NsF9c90f0/mqdefault.jpg')">
                                <span class="overlay"></span>
                                <div class="widget-block">
                                    <div class="count">4</div>
                                    <div class="description">
                                        <h5 class="title">Final Fantasy VII</h5>
                                        <span class="date">Q3 2018</span>
                                    </div>
                                </div>
                            </a>
                            <a href="#"
                               style="background-image: url('https://i1.ytimg.com/vi/xUGRjNzGz3o/mqdefault.jpg')">
                                <span class="overlay"></span>
                                <div class="widget-block">
                                    <div class="count">5</div>
                                    <div class="description">
                                        <h5 class="title">Mass Effect Andromeda</h5>
                                        <span class="date">Q1, 2018</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- widget post  -->
                        <div class="widget widget-post">
                            <h5 class="widget-title">Recommends</h5>
                            <a href="blog-post.html"><img src="https://i1.ytimg.com/vi/4BLkEJu9szM/mqdefault.jpg"
                                                          alt=""></a>
                            <h4><a href="blog-post.html">Titanfall 2's Trophies Only Have 3 Multiplayer</a></h4>
                            <span><i class="fa fa-clock-o"></i> June 12, 2017</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel neque sed ante
                                facilisis efficitur.</p>
                        </div>

                        <!-- widget facebook -->
                        <div class="widget">
                            <h5 class="widget-title">Follow Us on Facebook</h5>
                            <div id="fb-root"></div>
                            <script async="" src="https://www.google-analytics.com/analytics.js"></script>
                            <script id="facebook-jssdk"
                                    src="//connect.facebook.net/en_US/sdk.js#xfbml=1&amp;version=v2.8"></script>
                            <script>
                                (function (d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
                            </script>
                            <div class="fb-page" data-href="https://www.facebook.com/yakuthemes"
                                 data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
                                 data-show-facepile="true"></div>
                        </div>

                        <!-- widget post -->
                        <div class="widget widget-post">
                            <h5 class="widget-title">Popular on Gameforest</h5>
                            <a href="blog-post.html"><img src="img/blog/blog-widget-popular-1.jpg" alt=""></a>
                            <h4><a href="blog-post.html">Red Dead Redemption Being Modded Into GTA5 Multiplayer</a></h4>
                            <span><i class="fa fa-clock-o"></i> June 16, 2017</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel neque sed anter.</p>
                            <ul class="widget-list">
                                <li>
                                    <div class="widget-img"><a href="blog-post.html"><img
                                                    src="img/blog/blog-widget-1.jpg" alt=""></a></div>
                                    <div>
                                        <h4><a href="blog-post.html">Dead Island 2 and Escape Impressions</a></h4>
                                        <span>June 16, 2017</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="widget-img"><a href="blog-post.html"><img
                                                    src="img/blog/blog-widget-2.jpg" alt=""></a></div>
                                    <div>
                                        <h4><a href="blog-post.html">How to Finish Mafia 3 With All of Your
                                                Underbosses</a></h4>
                                        <span>May 30, 2017</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="widget-img"><a href="blog-post.html"><img
                                                    src="img/blog/blog-widget-3.jpg" alt=""></a></div>
                                    <div>
                                        <h4><a href="blog-post.html">Spider-Man Spin-Off, Venom, Gets Release Date</a>
                                        </h4>
                                        <span>June 10, 2017</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="widget-img"><a href="blog-post.html"><img
                                                    src="img/blog/blog-widget-4.jpg" alt=""></a></div>
                                    <div>
                                        <h4><a href="blog-post.html">Is Ghost Recon: Wildlands Worth Your Time?</a></h4>
                                        <span>June 16, 2017</span>
                                    </div>
                                </li>
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
                                        <li>
                                            <div><a href="profile.html"><img src="img/user/user-2.jpg" alt=""></a></div>
                                            <div>
                                                <a href="blog-post.html#comments"><b>Elizabeth:</b> It would have taken
                                                    a ridiculous amount of careful precise actions.</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div><a href="profile.html"><img src="img/user/user-3.jpg" alt=""></a></div>
                                            <div>
                                                <a href="blog-post-disqus.html#comments"><b>Clark:</b> Lorem ipsum dolor
                                                    sit amet, consectetur adipiscing elit curabitur risque.</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div><a href="profile.html"><img src="img/user/user-1.jpg" alt=""></a></div>
                                            <div>
                                                <a href="blog-post-video.html#comments"><b>Venom:</b> Practically no
                                                    verticality, which on levels like The Spire (Geonosis)
                                                    incredible.</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div><a href="profile.html"><img src="img/user/user-3.jpg" alt=""></a></div>
                                            <div>
                                                <a href="blog-post-disqus.html#comments"><b>Clark:</b> I'm low level at
                                                    this point and have almost nothing unlocked, and veteran players
                                                    have an unfair advantage over me thanks.</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div><a href="profile.html"><img src="img/user/user-5.jpg" alt=""></a></div>
                                            <div>
                                                <a href="blog-post-disqus.html#comments"><b>Trevor:</b> A lot of people
                                                    would have stopped playing now if it wasn't for the online
                                                    stuff!</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="popular">
                                    <div class="widget-post">
                                        <ul class="widget-list">
                                            <li>
                                                <img src="https://i1.ytimg.com/vi/B6qY-P4eo1Q/mqdefault.jpg" alt="">
                                                <h4><a href="blog-post.html">How to Finish Mafia 3 With All of Your
                                                        Underbosses</a></h4>
                                                <span><i class="fa fa-clock-o"></i> July 12, 2017</span>
                                                <span>19 comments</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel
                                                    neque sed anter.</p>
                                            </li>
                                            <li>
                                                <h4><a href="blog-post.html">Uncharted: The Lost Legacy's Demo</a></h4>
                                                <span>June 28, 2017</span>
                                                <span>41 comments</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel
                                                    neque sed anter.</p>
                                            </li>
                                            <li>
                                                <h4><a href="blog-post.html">Mafia III Stones Unturned DLC Launch
                                                        Trailer</a></h4>
                                                <span>June 17, 2017</span>
                                                <span>7 comments</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel
                                                    neque sed anter.</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="recent">
                                    <div class="widget-post">
                                        <ul class="widget-list">
                                            <li>
                                                <img src="https://i1.ytimg.com/vi/ckUrcdnWZ2g/mqdefault.jpg" alt="">
                                                <h4><a href="blog-post.html">Free Mass Effect: Andromeda Trial Now
                                                        Available On All Platforms</a></h4>
                                                <span><i class="fa fa-clock-o"></i> July 12, 2017</span>
                                                <span>76 comments</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel
                                                    neque sed anter.</p>
                                            </li>
                                            <li>
                                                <h4><a href="blog-post.html">GTA 5 Online Players Find Secret Alien
                                                        Mission</a></h4>
                                                <span>June 23, 2017</span>
                                                <span>34 comments</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel
                                                    neque sed anter.</p>
                                            </li>
                                            <li>
                                                <h4><a href="blog-post.html">Mafia III Stones Unturned DLC Launch
                                                        Trailer</a></h4>
                                                <span>June 17, 2017</span>
                                                <span>7 comments</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel
                                                    neque sed anter.</p>
                                            </li>
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

    <section class="p-t-35 p-b-10">
        <div class="container">
            <h6 class="subtitle">Recommended Posts</h6>
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="card card-widget">
                        <div class="card-img">
                            <a href="blog-post-carousel.html">
                                <img src="img/blog/blog-related-1.jpg" alt="Injustice 2 Story Mode Superman Ending">
                            </a>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title"><a href="blog-post-carousel.html">Injustice 2 Story Mode Clark Ending
                                    Scene</a></h4>
                            <div class="card-meta"><span><i class="fa fa-clock-o"></i> July 21, 2017</span></div>
                            <p>Injustice 2's Story Mode features hours of cinematic cutscenes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card card-widget">
                        <div class="card-img">
                            <a href="blog-post-video.html"><img src="img/blog/blog-related-2.jpg"
                                                                alt="New Injustice 2 Video Explains The Gear System"></a>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title"><a href="blog-post-video.html">New Injustice 2 Video Explains The
                                    Gear System</a></h4>
                            <div class="card-meta"><span><i class="fa fa-clock-o"></i> June 19, 2017</span></div>
                            <p>Following the new trailer dedicated to The Flash.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card card-widget">
                        <div class="card-img">
                            <a href="blog-post-disqus.html"><img src="img/blog/blog-related-3.jpg"
                                                                 alt="An Extra Week Of Double Rewards In GTA V"></a>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title"><a href="blog-post-disqus.html">An Extra Week Of Double Rewards In
                                    GTA V</a></h4>
                            <div class="card-meta"><span><i class="fa fa-clock-o"></i> June 18, 2017</span></div>
                            <p>Grand Theft Auto V players are getting an extra week to earn.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-widget">
                        <div class="card-img">
                            <a href="blog-post-hero.html"><img src="img/blog/blog-related-4.jpg"
                                                               alt="BioShock: The Collection PC System Requirements Revealed"></a>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title"><a href="blog-post-hero.html">BioShock: The Collection PC System
                                    Requirements Revealed</a></h4>
                            <div class="card-meta"><span><i class="fa fa-clock-o"></i> June 09, 2017</span></div>
                            <p>2K revealed the PC system requirements for BioShock.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /main -->
@endsection

@push('js')
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
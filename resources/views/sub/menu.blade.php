<header id="header">
    <div class="container">
        <div class="navbar-backdrop">
            <div class="navbar">
                <div class="navbar-left">
                    <a class="navbar-toggle"><i class="fa fa-bars"></i></a>
                    <a href="{{ route('home') }}" style="padding: 16px 0 !important;" class="logo"><img
                                src="{{ asset('img/logo.png') }}" alt="Game Immortal"></a>
                    <nav class="nav">
                        <ul>
                            <li>
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="has-dropdown">
                                <a href="forums.html">Games</a>
                                <ul>
                                    <li><a href="forums.html">PC</a></li>
                                    <li><a href="forum-topic.html">PlayStation 4</a></li>
                                    <li><a href="forum-topic.html">PlayStation 3</a></li>
                                    <li><a href="forum-post.html">Xbox One</a></li>
                                    <li><a href="forum-create.html">Xbox 360</a></li>
                                    <li><a href="forum-create.html">Nintendo Switch</a></li>
                                    <li><a href="forum-create.html">Linux</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('home') }}">Reviews</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="nav navbar-right">
                    <ul>
                        @if(checkLoginUser())
                            <li class="dropdown dropdown-profile">
                                <a href="javascript:void(0)" data-toggle="dropdown"><img
                                            src="{{ asset('img/avatar.png') }}" alt="">
                                    <span>{{ getUser()->name }}</span></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    {{--                                    <a class="dropdown-item active" href="#"><i class="fa fa-user"></i> Profile</a>--}}
                                    {{--                                    <a class="dropdown-item" href="#"><i class="fa fa-envelope-open"></i> Inbox</a>--}}
                                    {{--                                    <a class="dropdown-item" href="#"><i class="fa fa-heart"></i> Games</a>--}}
                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-cog"></i>
                                        Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-sign-out"></i>
                                        Logout</a>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a class="checkbox checkbox-toggle checkbox-primary">
                                    <input type="checkbox"
                                           id="checkbox-toggle" {{ \Illuminate\Support\Facades\Cookie::get('theme') == 'dark' ? 'checked' : ''}}>
                                    <label for="checkbox-toggle"></label>
                                </a>
                            </li>
                        @else
                            <li class="hidden-xs-down"><a href="{{ route('login') }}">Login</a></li>
                            <li class="hidden-xs-down"><a href="{{ route('register') }}">Register</a></li>
                        @endif
                        {{--                        <li><a data-toggle="search"><i class="fa fa-search"></i></a></li>--}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="navbar-search">
            <div class="container">
                <form method="post">
                    <input type="text" class="form-control" placeholder="Search...">
                    <i class="fa fa-times close"></i>
                </form>
            </div>
        </div>
    </div>
</header>
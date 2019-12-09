<header id="header">
    <div class="container">
        <div class="navbar-backdrop">
            <div class="navbar">
                <div class="navbar-left">
                    <a class="navbar-toggle"><i class="fa fa-bars"></i></a>
                    <a href="index.html" style="padding: 16px 0 !important;" class="logo"><img
                                src="{{ asset('img/logo.png') }}" alt="Gameforest - Game Theme HTML"></a>
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
                        <li class="hidden-xs-down"><a href="{{ route('login') }}">Login</a></li>
                        <li class="hidden-xs-down"><a href="{{ route('register') }}">Register</a></li>
                        <li><a data-toggle="search"><i class="fa fa-search"></i></a></li>
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
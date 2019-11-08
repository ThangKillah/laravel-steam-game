@extends('layout.blank')

@section('title', 'Blank Page')

@section('breadcrumb')
    <section class="breadcrumbs">
        <div class="container">
            {{ Breadcrumbs::render('home') }}
        </div>
    </section>
@endsection

@section('content')
    <div id="twitch-embed"></div>

    <section class="blank" style="padding: 50px;">
        @if(Sentinel::check())
            <input type="hidden" id="user-id" value="{{ Sentinel::getUser()->hashid }}">
            {{ Sentinel::getUser() }}
        @else
            <input type="hidden" id="user-id" value="">
    @endif

    <!-- On button click, call reset() function with empty SSO auth payload to log out current user -->
        <button onclick="reset('e30= c1ad77866d19a308f133d18bb12a3e1f5d536a3b 1495142696');">
            Log out user with empty SSO auth
        </button>

        <button onclick="login();">
            Login
        </button>

        <div id="disqus_thread"></div>
    </section>
    <!-- /main -->
@endsection

@push('js')
    <script src="https://embed.twitch.tv/embed/v1.js"></script>
    <!-- Create a Twitch.Embed object that will render within the "twitch-embed" root element. -->
    <script type="text/javascript">
        new Twitch.Embed("twitch-embed", {
            width: 854,
            height: 480,
            channel: "monstercat"
        });
    </script>
    <script>
        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
         */

        var disqus_config = function () {
            this.page.url = 'https://blog-game.com/comment';  // Replace PAGE_URL with your page's canonical URL variable
            //this.page.identifier = '1 https://disqus-sso-demo.glitch.me/'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            this.page.title = 'ThangBT Gaming';
            this.page.api_key = 'V40BtVqpsHNRRqiNacQ6MtuSABY6o6dAh5X1ORUiMMzsfzo2FAPGicVSTAFRFMwy';
            // this.sso = {
            //     name:   "SampleNews",
            //     button:  "http://example.com/images/samplenews.gif",
            //     icon:     "http://example.com/favicon.png",
            //     url:        "http://example.com/login/",
            //     logout:  "http://example.com/logout/",
            //     width:   "800",
            //     height:  "400"
            // };
        };

        (function () {  // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');

            s.src = 'https://https-blog-game-com.disqus.com/embed.js';

            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();

        /* * * Disqus Reset Function * * */
        var reset = function (newAuth) {
            DISQUS.reset({
                reload: true,
                config: function () {
                    this.page.remote_auth_s3 = newAuth;
                    this.page.api_key = 'V40BtVqpsHNRRqiNacQ6MtuSABY6o6dAh5X1ORUiMMzsfzo2FAPGicVSTAFRFMwy';
                }
            });
        };

        /**
         * Makes call to server to get payload and reset Disqus
         * DISQUS.reset() is not required for SSO but can used to refresh Disqus with a new user
         */
        function login() {
            $.post('/login-with-disqus',
                {
                    id: $('#user-id').val()
                },
                function (auth) {
                    console.log(auth);
                    reset(auth)
                });
        }
    </script>
    <noscript>Please enable JavaScript to view the
        <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a>
    </noscript>
@endpush
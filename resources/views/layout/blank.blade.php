<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- meta -->

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title') - Game Immortal</title>
    <!-- vendor css -->
    <link rel="stylesheet"
          href="{{ asset('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap') }}">
    <link rel="preload" href="{{ asset('plugins/font-awesome/fonts/fontawesome-webfont.woff2' . '?v=4.7.0') }}"
          as="font" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('plugins/animate/animate.min.css') }}">
    <!-- theme css -->
    <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dark.css') }}">
    @stack('styles')
</head>
<body class="{{ \Illuminate\Support\Facades\Cookie::get('theme') == 'dark' ? 'dark' : '' }}">
<div id="ajax-loading" style="display: none;">
    <img id="ajax-gif" src="{{ asset('img/ajax.gif') }}" alt="Loading..."/>
</div>
<!-- header -->
<div class="fixed-header">
    @include('sub.menu')

    @yield('breadcrumb')

    @yield('content')

    @include('sub.footer')
</div>
<!-- vendor js -->
<script src="{{ asset('plugins/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('plugins/popper/popper.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.1.2/lazysizes.min.js"
        integrity="sha256-Md1qLToewPeKjfAHU1zyPwOutccPAm5tahnaw7Osw0A=" crossorigin="anonymous"></script>
<script>
    function showAjaxGif() {
        $("#ajax-loading").fadeIn();
    }

    function hideAjaxGif() {
        $("#ajax-loading").fadeOut();
    }
</script>
<!-- theme js -->
<script src="{{ asset('js/theme.min.js') }}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    $(document).ready(function () {
        let setTheme = function (theme) {
            if (theme === 'dark') {
                // dark
                $("body").removeClass("standard");
                $("body").addClass("dark");
                ajaxSetThem(theme);
            } else {
                $("body").removeClass("dark");
                $("body").addClass("standard");
                ajaxSetThem(theme)
            }
        };

        $("#checkbox-toggle").on("click", function () {
            if ($("body").hasClass("dark")) {
                // standard
                setTheme('standard');
            } else {
                // dark mode
                setTheme('dark');
            }
        });
    });

    function ajaxSetThem(theme) {
        $.ajax({
            url: '{{ route('switch-theme') }}' + '?theme=' + theme,
            type: "get",
            beforeSend: function () {
                showAjaxGif();
            },
            success: function (data) {
                hideAjaxGif();
                console.log(data);
            },
            error: function (request, status, error) {
                hideAjaxGif();
            }
        });
    }
</script>

@stack('modal')
@stack('js')

</body>
</html>
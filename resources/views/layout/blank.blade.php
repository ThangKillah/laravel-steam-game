<!DOCTYPE html>
<html lang="en">
<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title') - Game Immortal</title>
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700') }}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/animate/animate.min.css') }}">
    <!-- theme css -->
    <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @stack('styles')
</head>
<body>
<div id="loading">
    <img id="loading-image" src="{{ asset('img/pacman.gif') }}" alt="Loading..." />
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

<!-- theme js -->
<script src="{{ asset('js/theme.min.js') }}"></script>
<script>
    // $(window).on('load', function(){
    //     $('#loading').fadeOut();
    //     setTimeout(function(){ $('#loading').fadeOut(); }, 10000);
    // });
    // my callback function
    // which relies on CSS being loaded function
    function CSSDone() {
        console.log('done loaded css');
        $('#loading').fadeOut(1000);
        setTimeout(function () {
            $('#loading').fadeOut();
        }, 10000);
    };

    // load me some stylesheet
    let url = "https://blog-game.com/css/theme.min.css",
        head = document.getElementsByTagName('head')[0],
        link = document.createElement('link');

    link.type = "text/css";
    link.rel = "stylesheet";
    link.href = url;

    // MAGIC
    // call CSSDone() when CSS arrives
    head.appendChild(link);

    link.onload = function () {
        CSSDone('onload listener');
    };
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@stack('modal')
@stack('js')

</body>
</html>
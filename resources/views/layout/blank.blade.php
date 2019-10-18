<!DOCTYPE html>
<html lang="en">
<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ __('Gaming') }} - @yield('title')</title>
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700') }}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/animate/animate.min.css') }}">
    <!-- theme css -->
    <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>
<!-- header -->
<div class="fixed-header">
    @include('sub.menu')
    <!-- /header -->

    <!-- main -->
    <section class="breadcrumbs">
        <div class="container">
            @yield('breadcrumb')
        </div>
    </section>

    @yield('content')

    <!-- footer -->
    @include('sub.footer')
    <!-- /footer -->
</div>
<!-- vendor js -->
<script src="{{ asset('plugins/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('plugins/popper/popper.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- theme js -->
<script src="{{ asset('js/theme.min.js') }}"></script>
</body>
</html>
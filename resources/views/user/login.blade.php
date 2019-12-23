@extends('layout.blank')

@push('styles')
    <link href="{{ asset('plugins/ytplayer/jquery.mb.YTPlayer.min.css') }}" rel="stylesheet">
@endpush

@section('title', __('Login'))

@section('content')
    <!-- main -->
    <section class="bg-image player p-y-70"
             style="background-image: url('https://img.youtube.com/vi/1GWRDuL04-Q/maxresdefault.jpg');"
             data-property="{videoURL:'1GWRDuL04-Q',containment:'self', stopMovieOnBlur:false, showControls: false, realfullscreen: true, showYTLogo: false, quality: 'highres',autoPlay:true,loop:true,opacity:1}">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-4 mx-auto">
                    <div class="card m-b-0">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fa fa-sign-in"></i> Login to your account</h4>
                        </div>
                        <div class="card-block">
                            <form id="form-login" action="{{ route('postLogin') }}" method="post">
                                @csrf
                                <input type="hidden"
                                       value="{{ app('request')->has('nextUrl') ? app('request')->input('nextUrl') : '' }}"
                                       name="nextUrl">
                                @include('sub.social', ['nextUrl' => app('request')->has('nextUrl') ? app('request')->input('nextUrl') : ''])
                                <div class="divider">
                                    <span>or</span>
                                </div>
                                @if(session('errLogin'))
                                    <div class="alert alert-warning" role="alert"> {{ session('errLogin') }}</div>
                                @endif
                                <div class="form-group input-icon-left m-b-10 @error('email') has-danger @enderror">
                                    <i class="fa fa-user"></i>
                                    <input type="email" name="email" class="form-control form-control-secondary"
                                           placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                    <small class="form-text">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group input-icon-left m-b-15 @error('password') has-danger @enderror">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" name="password" class="form-control form-control-secondary"
                                           placeholder="Password" value="{{ old('password') }}">
                                    @error('password')
                                    <small class="form-text">{{ $message }}</small>
                                    @enderror
                                </div>
                                <label class="custom-control custom-checkbox custom-checkbox-primary">
                                    <input type="checkbox" class="custom-control-input" name="remember">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Remember me</span>
                                </label>
                                <button type="submit" class="btn btn-primary btn-block m-t-10">Login <i class="fa fa-sign-in"></i></button>
                                <div class="divider">
                                    <span>Don't have an account?</span>
                                </div>
                                <a class="btn btn-secondary btn-block" href="{{ route('register') }}" role="button">Register</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /main -->
@endsection

@push('js')
    <script src="{{ asset('plugins/ytplayer/jquery.mb.YTPlayer.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('messages.js') }}"></script>
    <script>
        (function ($) {
            "use strict";
            $(".player").mb_YTPlayer();
        })(jQuery);
    </script>
    <script>
        $().ready(function () {
            //console.log(Lang.get('auth.failed'));
            $.validator.addMethod('checkPass', function (value) {
                return /^[a-zA-Z0-9]+$/.test(value);
            }, 'Password only include number and letter.');

            $("#form-login").validate({
                ignore: [],
                success: function (label, element) {
                    label.parent().removeClass('error');
                    label.remove();
                },
                errorElement: 'small',
                errorPlacement: function (error, element) {
                    let placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {
                    "email": {
                        required: true,
                        maxlength: 255
                    },
                    "password": {
                        required: true,
                        minlength: 6,
                        checkPass: true
                    },
                },
            });
        });
    </script>
@endpush
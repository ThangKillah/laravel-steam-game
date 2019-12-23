@extends('layout.blank')

@section('title', __('Register'))

@section('content')
    <!-- main -->
    <section class="bg-image bg-image-sm" style="background-image: url('https://img.youtube.com/vi/BhTkoDVgF6s/maxresdefault.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-4 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fa fa-user-plus"></i> Register a new account</h4>
                        </div>
                        <div class="card-block">
                            <form id="form-register" action="{{ route('register') }}" method="post">
                                @csrf
                                <input type="hidden"
                                       value="{{ app('request')->has('nextUrl') ? app('request')->input('nextUrl') : '' }}"
                                       name="nextUrl">
                                @include('sub.social', ['nextUrl' => app('request')->has('nextUrl') ? app('request')->input('nextUrl') : ''])
                                <div class="divider"><span>or</span></div>
                                <div class="form-group input-icon-left m-b-10 @error('name') has-danger @enderror">
                                    <i class="fa fa-user"></i>
                                    <input type="text"
                                           name="name"
                                           value="{{ old('name') }}"
                                           class="form-control form-control-secondary"
                                           placeholder="Username">
                                    @error('name')
                                        <small class="form-text">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group input-icon-left m-b-10 @error('email') has-danger @enderror">
                                    <i class="fa fa-envelope"></i>
                                    <input type="email"
                                           class="form-control form-control-secondary"
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="Email Address">
                                    @error('email')
                                    <small class="form-text">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="divider"><span>Security</span></div>
                                <div class="form-group input-icon-left m-b-10 @error('password') has-danger @enderror">
                                    <i class="fa fa-lock"></i>
                                    <input type="password"
                                           class="form-control form-control-secondary"
                                           name="password"
                                           id="password"
                                           value="{{ old('password') }}"
                                           placeholder="Password">
                                    @error('password')
                                    <small class="form-text">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group input-icon-left m-b-10 @error('password_confirmation') has-danger @enderror">
                                    <i class="fa fa-unlock"></i>
                                    <input type="password"
                                           class="form-control form-control-secondary"
                                           name="password_confirmation"
                                           value="{{ old('password_confirmation') }}"
                                           placeholder="Repeat Password">
                                    @error('password_confirmation')
                                    <small class="form-text">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="divider"><span>I am not a robot</span></div>
                                <div class="g-recaptcha-outer">
                                    <script src='https://www.google.com/recaptcha/api.js'></script>
                                    <div class="g-recaptcha" data-sitekey="{{ $recaptcha_site_key }}"></div>
                                </div>
                                <input type="hidden"  name="recaptcha" id="recaptcha">
                                @error('g-recaptcha-response')
                                    <small class="form-text" style="color: #ff4a38">{{ $message }}</small>
                                @enderror
                                <button type="submit" class="btn btn-primary m-t-10 btn-block">Complete Registration</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="terms">
            <div class="modal-dialog modal-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa fa-file-text-o"></i> Terms of Service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>1. Morbi ut pharetra tellus</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lobortis justo vel lorem sagittis, eu bibendum ipsum accumsan. Donec congue eget elit ut posuere. Curabitur congue, enim a viverra ultrices, elit velit auctor neque, eget vehicula
                            augue purus et lectus. Mauris cursus ac ex in vehicula. Sed ut sagittis eros. Vivamus accumsan diam vitae lectus consectetur aliquet. Proin varius tempor ullamcorper. Quisque malesuada mollis arcu, in euismod nisi pharetra pellentesque.
                            Sed ullamcorper quis dui sed varius. Fusce efficitur augue purus, vitae mattis orci blandit ac. Integer suscipit arcu ac diam tincidunt, sed elementum augue lobortis.</p>
                        <p>Pellentesque finibus dui dui, sit amet scelerisque neque venenatis non. Nullam gravida nisi pretium malesuada luctus. Nunc porttitor ipsum a massa gravida congue. Vestibulum dapibus mauris sit amet volutpat faucibus. Nulla lacinia diam sed
                            ultricies venenatis. Ut ultricies, urna commodo aliquam molestie, lectus leo efficitur tellus, et aliquam magna magna id est. In euismod ac magna quis imperdiet.</p>
                        <p>Aliquam ornare elit neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi ut pharetra tellus. Vestibulum a dui nisl. Sed commodo sodales dolor, et malesuada nulla consectetur vitae. Quisque nec neque ac tellus auctor pellentesque
                            vel eleifend urna. Phasellus non urna id tellus fringilla hendrerit. Quisque vel mauris nisi. Mauris nec odio vitae sapien sodales lacinia. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam sit amet nisi quis ex pretium
                            congue id id magna. Aenean dictum justo sit amet augue mollis ullamcorper. Aliquam mattis vel mauris et elementum. Morbi et risus quis nisl ullamcorper pulvinar eget et erat.</p>
                        <p>Ut viverra urna non orci interdum, in viverra urna pretium. Suspendisse potenti. Mauris et massa a enim lobortis facilisis. In hac habitasse platea dictumst. Ut varius erat vulputate libero sagittis, vitae feugiat nibh malesuada. Sed vel lacinia
                            urna. Curabitur eget dui nisi.</p>
                        <p>Vivamus orci felis, varius tempor lacus eu, scelerisque bibendum nunc. Vestibulum rutrum, enim quis maximus pretium, nisi est condimentum magna, venenatis dignissim magna nulla quis felis. Quisque id tellus nec mauris sagittis mattis non et
                            quam. Etiam posuere, tellus sed tincidunt egestas, tortor orci interdum risus, nec egestas dolor tortor non turpis. Curabitur in tellus laoreet, congue eros a, bibendum tortor. Nulla in facilisis libero, sit amet sagittis tellus. Aliquam
                            nec pulvinar velit, mattis pharetra urna. Donec et tincidunt libero. Duis at nisi in neque vulputate tempus. Curabitur et lobortis lacus. In sagittis egestas lorem, nec bibendum lacus maximus sed.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /main -->
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('messages.js') }}"></script>
    <script>
        $().ready(function () {
            //console.log(Lang.get('auth.failed'));
            $.validator.addMethod('checkPass', function (value) {
                return /^[a-zA-Z0-9]+$/.test(value);
            }, 'Password only include number and letter.');

            $.validator.addMethod('checkCaptcha', function (value) {
                return $('#g-recaptcha-response').val().length > 0
            }, 'Please check captcha i am not a robot');



            $("#form-register").validate({
                // onfocusout: false,
                // onkeyup: false,
                // onclick: false,
                ignore: [],
                success: function(label,element) {
                    label.parent().removeClass('error');
                    label.remove();
                },
                errorElement : 'small',
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {
                    "name": {
                        required: true,
                        maxlength: 255
                    },
                    "recaptcha": {
                        checkCaptcha : true
                    },
                    "email": {
                        required: true,
                        maxlength: 255
                    },
                    "password": {
                        required: true,
                        minlength: 6,
                        checkPass : true
                    },
                    "password_confirmation": {
                        equalTo: "#password",
                    }
                },
                messages: {
                    "password": {
                        required: "Please enter your password",
                    },
                    "password_confirmation": {
                        equalTo: "Please enter same password confirm",
                    },
                    "recaptcha": {
                        required: "Please check i am not a robot."
                    }
                }
            });
        });
    </script>
@endpush
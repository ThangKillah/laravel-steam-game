@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
@endpush

<div id="comments" class="comments anchor">
    <input id="type" hidden value="{{ $comments->first()->type ?? 'no-comment' }}">
    <input id="core_id" hidden value="{{ $comments->first()->core_id ?? 'no-comment' }}">

    <div class="comments-header">
        <h5><i class="fa fa-comment-o m-r-5"></i> Comments ({{ $totalComment }})</h5>
        @if($comments->total() > 1)
            <div class="dropdown float-right">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Sorted by Best
                    <span class="caret"></span></button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item active" href="#">Best</a>
                    <a class="dropdown-item" href="#">Latest</a>
                    <a class="dropdown-item" href="#">Oldest</a>
                    <a class="dropdown-item" href="#">Random</a>
                </div>
            </div>
        @endif
    </div>

    <form data-comment="0">
        <div class="text-editor mt-5">
            <div class="form-group">
                <div class="summernote"></div>
                <small class="error" hidden></small>
            </div>
            <button class="btn btn-primary btn-comment">Submit Comment</button>
        </div>
    </form>

    <div id="loading-gif">
    </div>

    <ul id="comments-list">
        @include('ajax.comment', ['comments' => $comments])
    </ul>

    @if($comments->currentPage() < $comments->lastPage())
        <div class="d-flex justify-content-center mb-5">
            <button id="btn-load-more" class="btn btn-primary btn-rounded" href="javascript:void(0)" role="button">
                Load more comments
            </button>
        </div>
    @endif
</div>

@push('modal')
    <div class="modal fade" id="modal-login">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-sign-in"></i>Login or register to comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-a-20">
                    <form action="profile.html" method="post">
                        @include('sub.social', ['nextUrl' => \Illuminate\Support\Facades\Request::url()])
                        <div class="divider">
                            <span>or</span>
                        </div>
                        <a class="btn btn-secondary btn-block" id="register-open-modal"
                           href="{{ redirectSignIn('login') }}"
                           role="button">Login using password and email<i class="fa fa-sign-in"></i>
                        </a>
                        <div class="divider">
                            <span>Don't have an account?</span>
                        </div>
                        <a class="btn btn-secondary btn-block" href="{{ redirectSignIn('register') }}"
                           role="button">Register with password and email<i class="fa fa-sign-in"></i>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('js')
    <script src="{{ asset('plugins/summernote/summernote-bs4.js') }}"></script>
    <script>
        function uploadImage(file, comment_id) {
            let data = new FormData();
            data.append('file', file, file.name);
            console.log(comment_id + '_id');
            $.ajax({
                method: 'POST',
                url: '{{ route('upload-image-comment') }}',
                contentType: false,
                cache: false,
                processData: false,
                data: data,
                success: function (img) {
                    let editor = $("form[data-comment='" + comment_id + "']");
                    editor.find('.summernote').summernote('insertImage', img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        }

        function initEditor(comment_id, content = null) {
            let editor = $("form[data-comment='" + comment_id + "']");
            editor.find('.summernote').summernote({
                callbacks: {
                    onImageUpload: function (files) {
                        for (let i = 0; i < files.length; i++) {
                            uploadImage(files[i], comment_id);
                        }
                    },
                    // onMediaDelete: function(files, editor, welEditable)
                    // {
                    //     var imageUrl = $(files[0]).attr('src');
                    //     var image = imageUrl.split('/');
                    //     console.log(image);
                    // }
                },
                height: 150,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ["insert", ["link", "picture"]],
                ]
            });

            if (content !== null) {
                editor.find('.summernote').summernote("code", content);
            }
        }

        function changeContent(comment_id, content) {
            let editor = $("form[data-comment='" + comment_id + "']");
            editor.find('.summernote').summernote("code", content);
        }

        //click close cancel comment
        $(document).on("click", '.btn-comment-close', function (event) {
            event.preventDefault();
            $(this).closest('form').html('');
        });

        //click reply
        $(document).on("click", '.reply-btn', function (event) {
            event.preventDefault();
            let comment_id = $(this).data('comment');
            let place;
            let content = '<span class="tag-user">@' + $(this).data('name') + ':&nbsp;</span>';
            place = $("form[data-comment='" + comment_id + "']");
            if (!$.trim(place.html()).length) {
                place.hide().html(
                    '                            <div class="text-editor">\n' +
                    '                                <div class="form-group">\n' +
                    '                                    <div class="summernote"></div>\n' +
                    '                                    <small class="error" hidden></small>\n' +
                    '                                </div>\n' +
                    '                                <button class="btn btn-primary btn-comment">Submit Comment</button>' +
                    '                                <button class="btn btn-danger btn-comment-close">Cancel</button>\n' +
                    '                            </div>').fadeIn(1000);
                initEditor(comment_id, content);
            } else {
                changeContent(comment_id, content)
            }
        });


        $(document).on("click", '.btn-comment', function (event) {
            event.preventDefault();
            let summernote = $(this).closest('div').find('.summernote');
            let content = summernote.summernote('code');
            let clean_content = content.replace(/<\/?[^>]+(>|$)/g, "");

            console.log(content);
            let check = true;
            if (clean_content.length === 0 || clean_content >= 255) {

            }

            $.ajax({
                type: "GET",
                url: "/check-login-ajax",
                success: function (data) {
                    let response = JSON.parse(data);
                    if (response.status === 'fail') {
                        console.log(JSON.parse(data).status);
                        $('#modal-login').modal('show');
                    }
                }
            });
        });


        $(document).ready(function () {
            "use strict";
            var page = 2;
            $("#btn-load-more").click(function (event) {
                event.preventDefault();
                $('#loading-gif').html('<a class="btn btn-primary text-left m-t-15 btn-block" href="#comments" role="button"><i class="fa fa-spinner fa-pulse m-r-5"></i> Loading more comments</a>');
                $.ajax({
                    type: "GET",
                    url: "/comments?page=" + page + '&core_id=' + $('#core_id').val() + '&type=' + $('#type').val(),
                    success: function (data) {
                        $("#comments-list").append(data);
                        $('#loading-gif').html('');
                        page = page + 1;
                    }
                });
            });

            initEditor(0);
        });
    </script>
@endpush
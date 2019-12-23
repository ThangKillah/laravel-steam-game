@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
@endpush

<div id="comments" class="comments anchor">
    <input id="type" hidden value="{{ $type }}">
    <input id="core_id" hidden value="{{ $core_id }}">
    <input id="is_login" hidden value="{{ getUserId() }}">
    <input id="max_page" hidden value="{{ $comments->lastPage() }}">

    <div class="comments-header">
        <h5><i class="fa fa-comment-o m-r-5"></i> Comments ({{ $totalComment }})</h5>
        @if($comments->total() > 1)
            <div class="dropdown float-right">
                <select class="form-control" id="sort-comment">
                    <option value="{{ \App\Model\Comment::LATEST }}">Sort by latest</option>
                    <option value="{{ \App\Model\Comment::OLDEST }}">Sort by oldest</option>
                </select>
            </div>
        @endif
    </div>

    <form data-comment="0">
        <div class="text-editor mt-5">
            <div class="form-group">
                <div class="summernote"></div>
                <small data-comment="0" class="error"></small>
            </div>
            <button data-comment="0" class="btn btn-primary btn-comment">Submit Comment</button>
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
    <div class="modal fade" id="modal-delete-comment" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-body" style="max-height: 773px; overflow-y: auto;">
                    <div class="d-flex justify-content-between bg-secondary mb-3">
                        <div>
                            <p>{{ __('Are you sure delete this comment ?') }}</p>
                        </div>
                        <div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="delete-comment" type="button" data-comment="0" class="btn btn-primary">Ok</button>
                </div>
            </div>
        </div>
    </div>

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
                    <form>
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

<button hidden type="button" class="btn-success-notify"
        data-notification="success"
        data-toggle="notification"
        data-alignment="right"
        data-title="{{ __('Post your comment successful') }}"></button>

<button hidden type="button" class="btn-success-delete"
        data-notification="success"
        data-toggle="notification"
        data-alignment="right"
        data-title="{{ __('Delete your comment successful') }}"></button>

<button hidden type="button" class="btn-danger-notify"
        data-notification="danger"
        data-toggle="notification"
        data-alignment="right"
        data-title="{{ __('Something is wrong ~~!') }}"></button>

@push('js')
    <script src="{{ asset('plugins/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('plugins/notification/notification.js') }}" charset="utf-8"></script>
    <script src="{{ asset('messages.js') }}" charset="utf-8"></script>
    <script>
        (function ($) {
            "use strict";
            // notification
            $('[data-toggle="notification"]').notification();
        })(jQuery);
    </script>
    <script>
        function initEditor(comment_id, content = null, isEdit = 0) {
            let editor;
            if (isEdit === 1) {
                editor = $(".edit-comment[data-comment='" + comment_id + "']");
            } else {
                editor = $("form[data-comment='" + comment_id + "']");
            }
            editor.find('.summernote').summernote({
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

        //click delete comment
        $(document).on("click", '.delete-comment-drop', function (event) {
            event.preventDefault();
            $('#modal-delete-comment').modal('show');
            $('#delete-comment').data('comment', $(this).data('comment'));
        });

        //submit delete comment
        $(document).on("click", '#delete-comment', function (event) {
            event.preventDefault();
            $('#modal-delete-comment').modal('hide');
            let comment_id = $(this).data('comment');
            $.ajax({
                url: "{{ route('ajax-delete-comment') }}",
                type: "POST",
                data: {
                    comment_id: comment_id,
                },
                success: function (data) {
                    let status = JSON.parse(data).status;
                    if (status != 200) {
                        $('.btn-danger-notify').click();
                    } else {
                        $('.btn-success-delete').click();
                        $(".comment[data-comment='" + comment_id + "']").parent('li').remove();
                    }
                },
                error: function (request, status, error) {
                    $('.btn-danger-notify').click();
                }
            });
        });


        //submit edit comment
        $(document).on("click", '.edit-comment-btn', function (event) {
            event.preventDefault();
            let comment_id = $(this).data('comment');
            var div_content = $(".content-html[data-comment='" + comment_id + "']");

            let div_editor = $(".edit-comment[data-comment='" + comment_id + "']");
            let content = div_editor.find('.summernote').summernote('code');

            if (div_editor.find('.summernote').summernote('isEmpty')) {
                $(".comment[data-comment='" + comment_id + "']").find('.error').html(Lang.get('content'));
            } else {
                $.ajax({
                    url: "{{ route('ajax-edit-comment') }}",
                    type: "POST",
                    data: {
                        comment_id: comment_id,
                        content: content,
                    },
                    success: function (data) {
                        $('.btn-success-notify').click();
                        div_content.html(data);
                        $(".content-html[data-comment='" + comment_id + "']").removeClass('d-none');
                        $(".edit-comment[data-comment='" + comment_id + "']").addClass('d-none');
                    },
                    error: function (request, status, error) {
                        $('.btn-danger-notify').click();
                    }
                });
            }
        });

        //click edit comment
        $(document).on("click", '.edit-comment-drop', function (event) {
            event.preventDefault();
            let comment_id = $(this).data('comment');
            let div_content = $(".content-html[data-comment='" + comment_id + "']");
            div_content.addClass('d-none');

            let div_edit = $(".edit-comment[data-comment='" + comment_id + "']");
            div_edit.removeClass('d-none');

            let content = div_content.html();

            initEditor(comment_id, content, 1);
        });


        //click cancel edit comment
        $(document).on("click", '.cancel-edit-comment', function (event) {
            event.preventDefault();
            let comment_id = $(this).data('comment');
            $(".content-html[data-comment='" + comment_id + "']").removeClass('d-none');
            $(".edit-comment[data-comment='" + comment_id + "']").addClass('d-none');
        });

        $(document).on("summernote.change", '.summernote', function (event) {
            if (!$(this).summernote('isEmpty')) {
                $(this).closest('form').find('.error').html('');
            }

            if ($('#is_login').val() == 0) {
                $('#modal-login').modal('show');
            }
        });

        //click reply
        $(document).on("click", '.reply-btn', function (event) {
            event.preventDefault();
            let comment_id = $(this).data('comment');
            let place;

            let content = '';
            if ($(this).data('user') !== $('#is_login').val()) {
                content = '<span class="tag-user">@' + $(this).data('name') + ':</span><span>&nbsp;</span>';
            }
            place = $("form[data-comment='" + comment_id + "']");
            if (!$.trim(place.html()).length) {
                place.hide().html(
                    '                            <div class="text-editor">\n' +
                    '                                <div class="form-group">\n' +
                    '                                    <div class="summernote"></div>\n' +
                    '                                    <small class="error"></small>\n' +
                    '                                </div>\n' +
                    '                                <button data-comment="' + comment_id + '" class="btn btn-primary btn-comment">Submit Comment</button>' +
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

            if ($('#is_login').val() != 0) {
                if (summernote.summernote('isEmpty')) {
                    $(this).closest('form').find('.error').html(Lang.get('content'));
                } else {
                    postComment(content, $(this).data('comment'))
                }
            } else {
                $('#modal-login').modal('show');
            }
        });

        function postComment(content, parent_id) {
            if (parent_id !== 0) {
                let form = $("form[data-comment='" + parent_id + "']");
                form.hide(1000).html('').show();
            }

            $.ajax({
                url: "{{ route('post-comment') }}",
                type: "POST",
                data: {
                    type: $('#type').val(),
                    core_id: $('#core_id').val(),
                    content: content,
                    parent_id: parent_id
                },
                success: function (data) {
                    $('.btn-success-notify').click();
                    if (parent_id === 0) {
                        initEditor(0, '');
                        $('#comments-list').prepend(data);
                    } else {
                        let form = $("form[data-comment='" + parent_id + "']");
                        $(data).insertBefore(form);
                    }
                },
                error: function (request, status, error) {
                    $('.btn-danger-notify').click();
                }
            });
        }


        $(document).ready(function () {
            "use strict";
            var page = 2;

            $('#sort-comment').on('change', function () {
                $('#btn-load-more').show();
                page = 1;
                $.ajax({
                    type: "GET",
                    url: "/ajax-comments?page=" + page + '&core_id=' + $('#core_id').val() + '&type=' + $('#type').val() + '&sortBy=' + $('#sort-comment').val(),
                    success: function (data) {
                        $("#comments-list").html(data);
                        $('#loading-gif').html('');
                        if (page == $('#max_page').val()) {
                            $('#btn-load-more').hide(1000);
                        }
                        page = page + 1;
                    }
                });
            });


            $("#btn-load-more").click(function (event) {
                event.preventDefault();
                $('#loading-gif').html('<a class="btn btn-primary text-left m-t-15 btn-block" href="#comments" role="button"><i class="fa fa-spinner fa-pulse m-r-5"></i> Loading more comments</a>');
                $.ajax({
                    type: "GET",
                    url: "/ajax-comments?page=" + page + '&core_id=' + $('#core_id').val() + '&type=' + $('#type').val() + '&sortBy=' + $('#sort-comment').val(),
                    success: function (data) {
                        $("#comments-list").append(data);
                        $('#loading-gif').html('');
                        if (page == $('#max_page').val()) {
                            $('#btn-load-more').hide(1000);
                        }
                        page = page + 1;

                    }
                });
            });

            initEditor(0);
        });
    </script>
@endpush
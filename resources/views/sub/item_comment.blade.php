<li class="li-comment">
    <div class="comment" data-comment="{{ $comment->id }}">
        <div class="comment-avatar">
            <a href="profile.html"><img src="{{ asset('img/avatar.png') }}" alt="avatar"></a>
        </div>
        <div class="comment-post">
            <div class="comment-header">
                <div class="comment-author">
                    <h5><a href="profile.html">{{ $comment->user->name }}</a></h5>
                    <span>Member</span>
                </div>
                <div class="comment-action">
                    <div class="dropdown float-right">
                        <a href="#" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false"><i class="fa fa-chevron-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @if(getUserId() ===  hashId($comment->user_id))
                                <a class="dropdown-item edit-comment-drop" data-comment="{{ $comment->id }}" href="#">Edit</a>
                                <a class="dropdown-item delete-comment-drop" data-comment="{{ $comment->id }}" href="#">Delete</a>
                            @endif
                            @if(getUserId() !== hashId($comment->user_id))
                                <a class="dropdown-item report-comment-drop" data-comment="{{ $comment->id }}"
                                   href="javascript:void(0)">Mark as spam</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-html" data-comment="{{ $comment->id }}">
                {!! $comment->content !!}
            </div>

            <div class="d-none edit-comment mb-2" data-comment="{{ $comment->id }}">
                <div class="text-editor">
                    <div class="form-group">
                        <div class="summernote"></div>
                        <small data-comment="{{ $comment->id }}" class="error"></small>
                    </div>
                    <button data-comment="{{ $comment->id }}" class="edit-comment-btn btn btn-primary">Edit Comment
                    </button>
                    <button data-comment="{{ $comment->id }}" class="btn btn-danger cancel-edit-comment">Cancel</button>
                </div>
            </div>

            <div class="comment-footer">
                <ul>
                    <li><a href="javascript:void(0)"><i class="fa fa-heart-o"></i> Like</a></li>
                    <li><a class="reply-btn"
                           data-comment="{{ $comment->id }}"
                           data-name="{{ $comment->user->name }}"
                           data-user="{{ hashId($comment->user_id) }}"
                           href="#">
                            <i class="icon-reply"></i> Reply</a>
                    </li>
                    <li><a href="javascript:void(0)"><i class="fa fa-clock-o"></i> {{ $comment->created_at }}</a></li>
                </ul>
            </div>
        </div>
    </div>


    <ul class="reply ul-reply" data-comment="{{ $comment->id }}">
        @if(count($comment->reply) >= 1)
            @foreach($comment->reply as $reply)
                @include('sub.item_reply', ['reply' => $reply])
            @endforeach
        @endif
        <form class="reply-editor" data-comment="{{ $comment->id }}">
        </form>
    </ul>
</li>
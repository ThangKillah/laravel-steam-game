<li class="li-reply">
    <div class="comment mt-2" data-comment="{{ $reply->id }}">
        <div class="comment-avatar"><img src="{{ asset('img/avatar.png') }}" alt="">
        </div>
        <div class="comment-post">
            <div class="comment-header">
                <div class="comment-author">
                    <h5><a class="name-author" href="profile.html">{{ $reply->user->name }}</a>
                    </h5>
                    <span>Member</span>
                </div>
                <div class="comment-action">
                    <div class="dropdown float-right">
                        <a href="#" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false"><i class="fa fa-chevron-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @if(getUserId() === hashId($reply->user_id))
                                <a class="dropdown-item edit-comment-drop" data-comment="{{ $reply->id }}"
                                   href="#">Edit</a>
                                <a class="dropdown-item delete-comment-drop" data-comment="{{ $reply->id }}" href="#">Delete</a>
                            @endif
                            @if(getUserId() !== hashId($reply->user_id))
                                <a class="dropdown-item report-comment-drop" data-comment="{{ $reply->id }}"
                                   href="javascript:void(0)">Mark as spam</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="reply-content mt-2 mb-2 content-html" data-comment="{{ $reply->id }}">
                {!! $reply->content !!}
            </div>

            <div class="d-none edit-comment mb-2" data-comment="{{ $reply->id }}">
                <div class="text-editor">
                    <div class="form-group">
                        <div class="summernote"></div>
                        <small data-comment="{{ $reply->id }}" class="error"></small>
                    </div>
                    <button data-comment="{{ $reply->id }}" class="edit-comment-btn btn btn-primary">Edit Comment
                    </button>
                    <button data-comment="{{ $reply->id }}" class="btn btn-danger cancel-edit-comment">Cancel</button>
                </div>
            </div>

            <div class="comment-footer">
                <ul>
                    <li><a href="javascript:void(0)"><i class="fa fa-heart-o"></i> Like</a></li>
                    <li><a class="reply-btn"
                           data-comment="{{ $reply->parent_id }}"
                           data-name="{{ $reply->user->name }}"
                           data-user="{{ hashId($reply->user_id) }}"
                           href="#">
                            <i class="icon-reply"></i> Reply</a>
                    </li>
                    <li><a href="javascript:void(0)"><i class="fa fa-clock-o"></i> {{ $reply->created_at }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</li>
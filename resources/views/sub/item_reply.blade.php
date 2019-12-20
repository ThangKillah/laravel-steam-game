<li class="li-reply">
    <div class="comment mt-2">
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
                            <a class="dropdown-item" href="#">Moderate</a>
                            <a class="dropdown-item" href="#">Embed</a>
                            <a class="dropdown-item" href="#">Report</a>
                            <a class="dropdown-item" href="#">Mark as spam</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="reply-content mt-2 mb-2">
                {!! $reply->content !!}
            </div>
            <div class="comment-footer">
                <ul>
                    <li><a href="#"><i class="fa fa-heart-o"></i> Like</a></li>
                    <li><a class="reply-btn"
                           data-comment="{{ $reply->parent_id }}"
                           data-name="{{ $reply->user->name }}"
                           data-user="{{ hashId($reply->user_id) }}"
                           href="#">
                            <i class="icon-reply"></i> Reply</a>
                    </li>
                    <li><a href="#"><i class="fa fa-clock-o"></i> {{ $reply->created_at }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</li>
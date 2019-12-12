<div id="comments" class="comments anchor">
    <input id="type" hidden value="{{ $comments->first()->type ?? 'no-comment' }}">
    <input id="core_id" hidden value="{{ $comments->first()->core_id ?? 'no-comment' }}">

    <div class="comments-header">
        <h5><i class="fa fa-comment-o m-r-5"></i> Comments ({{ $comments->total() }})</h5>
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
    </div>
    <div id="loading-gif">
    </div>

    <ul id="comments-list">
        @if($comments->total() >= 1)
            @foreach($comments as $comment)
                <li>
                    <div class="comment">
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
                                            <a class="dropdown-item" href="#">Moderate</a>
                                            <a class="dropdown-item" href="#">Embed</a>
                                            <a class="dropdown-item" href="#">Report</a>
                                            <a class="dropdown-item" href="#">Mark as spam</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! $comment->content !!}
                            <div class="comment-footer">
                                <ul>
                                    <li><a href="#"><i class="fa fa-heart-o"></i> Like</a></li>
                                    <li><a href="#"><i class="icon-reply"></i> Reply</a></li>
                                    <li><a href="#"><i class="fa fa-clock-o"></i> 3 hours ago</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @if(count($comment->reply) >= 1)
                        <ul class="reply">
                            @foreach($comment->reply as $reply)
                                <li>
                                    <div class="comment">
                                        <div class="comment-avatar"><img src="{{ asset('img/avatar.png') }}" alt="">
                                        </div>
                                        <div class="comment-post">
                                            <div class="comment-header">
                                                <div class="comment-author">
                                                    <h5><a href="profile.html">{{ $reply->user->name }}</a></h5>
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
                                            {!! $reply->content !!}
                                            <div class="comment-footer">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-heart-o"></i> Like</a></li>
                                                    <li><a href="#"><i class="icon-reply"></i> Reply</a></li>
                                                    <li><a href="#"><i class="fa fa-clock-o"></i> 24 minutes ago</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        @endif
    </ul>

    <div class="d-flex justify-content-center mb-5">
        <button id="btn-load-more" class="btn btn-primary btn-rounded" href="javascript:void(0)" role="button">Load more
            comment
        </button>
    </div>

    <form>
        <h5>Leave a comment</h5>
        <div class="form-group">
            <textarea class="form-control" rows="5" placeholder="Your Comment"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </form>
</div>

@push('js')
    <script>
        $(document).ready(function () {
            console.log("ready!");
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
        });
    </script>
@endpush
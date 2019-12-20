@if($comments->total() >= 1)
    @foreach($comments as $comment)
        @include('sub.item_comment', ['comment' => $comment])
    @endforeach
@endif
@foreach($blogs as $blog)
    <div class="post">
        <h2 class="post-title"><a
                    href="{{ route('blog-detail', ['slug' => $blog->slug, 'id' => \Vinkla\Hashids\Facades\Hashids::encode($blog->id) ]) }}">{{ $blog->title }}</a>
        </h2>
        <div class="post-meta">
                                <span><i class="fa fa-clock-o"></i> {{ $blog->blog_date }} by <a
                                            href="profile.html">{{ $blog->authors }}</a></span>
            <span>
                            <a href="blog-post.html#comments"><i class="fa fa-eye"></i> {{ rand(50,100) }} views</a>
                            </span>
        </div>
        <div class="post-thumbnail">
            <a href="{{ route('blog-detail', ['slug' => $blog->slug, 'id' => \Vinkla\Hashids\Facades\Hashids::encode($blog->id) ]) }}">
                <img src="{{ urlBlogImage($blog->image) }}"
                     alt="Uncharted The Lost Legacy First Gameplay Details Revealed">
            </a>
            <span class="badge badge-ps4">{{ badgesBlog($blog->category) }}</span>
        </div>
        <p>{{ $blog->deck }}</p>
    </div>
@endforeach

<div class="pagination-results d-flex justify-content-between">
    <span>Showing {{ $blogs->perPage() }} to {{ $blogs->count() * $blogs->currentPage() }} of {{ $blogs->total() }} results</span>
    {{ $blogs->links() }}
</div>
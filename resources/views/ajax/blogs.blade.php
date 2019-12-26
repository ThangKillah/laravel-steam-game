@foreach(array_chunk($blogs->all(), 2) as $blogSmallList)
    <div class="row">
        @foreach($blogSmallList as $blog)
            <div class="post column">
                <h2 class="post-title text-over-two-line"><a
                            href="{{ route('blog-detail', ['slug' => $blog->slug, 'id' => hashId($blog->id) ]) }}">{{ $blog->title }}</a>
                </h2>
                <div class="post-meta">
                    <span><i class="fa fa-clock-o"></i> {{ $blog->blog_date }} by <a
                                href="javascript:void(0)">{{ $blog->authors }}</a></span>
                    <span><a href="{{ route('blog-detail', ['slug' => $blog->slug, 'id' => hashId($blog->id) ]) }}#comments"><i
                                    class="fa fa-eye"></i> {{ rand(50,100) }} views</a></span>
                </div>
                <div class="post-thumbnail">
                    <a href="{{ route('blog-detail', ['slug' => $blog->slug, 'id' => hashId($blog->id) ]) }}">
                        <img src="{{ urlBlogImage($blog->image) }}"
                             alt="Uncharted The Lost Legacy First Gameplay Details Revealed">
                    </a>
                    <span data-toggle="tooltip" data-placement="bottom" title=""
                          data-original-title="{{ badgesBlog($blog->category) }}"
                          class="badge badge-ps4 text-over-badge">{{ badgesBlog($blog->category) }}</span>
                </div>
                <p>{{ $blog->deck }}</p>
            </div>
        @endforeach
    </div>
@endforeach


<div class="pagination-results d-flex justify-content-between">
    <span>Showing {{ $blogs->perPage() }} to {{ $blogs->count() * $blogs->currentPage() }} of {{ $blogs->total() }} results</span>
    {{ $blogs->links() }}
</div>
<div class="single-blog">
    <div class="single-blog-text">
        <span>{{ $blog->date }}</span>
        <a href="#" class="blog-title">{{ $blog->title }}</a>
        <p>
            {{ $blog->content }}
        </p>
        <a href="#" class="more">read more</a>
    </div>
    <div class="single-blog-img">
        <img src="{{ $blog->image }}" alt="">
    </div>
</div>
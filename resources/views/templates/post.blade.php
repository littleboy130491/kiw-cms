@php
    use Illuminate\Support\Str;
@endphp
<x-layouts.app :title="$item->title ?? 'Post'" :body-classes="$bodyClasses">
    <x-partials.header />
    <main>
        <article class="post-single">
            <header class="post-header">
                <h1 class="post-title">{{ $item->title ?? 'Untitled Post' }}</h1>

                <div class="post-meta">
                    @if ($item->published_at)
                        <time datetime="{{ $item->published_at->toISOString() }}" class="post-date">
                            {{ $item->published_at->format('F j, Y') }}
                        </time>
                    @endif

                    @if ($item->author)
                        <span class="post-author">
                            by {{ $item->author->name }}
                        </span>
                    @endif
                    <x-ui.page-views :count="$item->custom_fields['page_views']" format="long" class="post-views" />

                    <span class="post-likes">
                        {{ $item->page_likes }} {{ Str::plural('like', $item->page_likes) }}
                    </span>
                </div>
            </header>

            @if ($item->featuredImage)
                <div class="post-featured-image">
                    <img src="{{ $item->featuredImage->url }}" alt="{{ $item->featuredImage->alt ?? $item->title }}" />
                </div>
            @endif

            @if ($item->excerpt)
                <div class="post-excerpt">
                    {!! $item->excerpt !!}
                </div>
            @endif

            <div class="post-content">
                {!! $item->content !!}
            </div>
            <x-ui.behold-ig-feed />

            {{-- Like button section --}}
            <div class="post-actions">
                <livewire:like-button :content="$item" :lang="$lang" :content-type="$item_type" />
            </div>

            @if ($item->categories->count() > 0)
                <div class="post-categories">
                    <strong>Categories:</strong>
                    @foreach ($item->categories as $category)
                        <a href="#" class="category-link">{{ $category->title }}</a>
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>
            @endif

            @if ($item->tags->count() > 0)
                <div class="post-tags">
                    <strong>Tags:</strong>
                    @foreach ($item->tags as $tag)
                        <a href="#" class="tag-link">#{{ $tag->title }}</a>
                        @if (!$loop->last)
                        @endif
                    @endforeach
                </div>
            @endif
        </article>

        {{-- Comments section --}}
        @if ($item->comments->count() > 0)
            <section class="comments-section">
                <h3>Comments ({{ $item->comments->count() }})</h3>
                @foreach ($item->comments as $comment)
                    <div class="comment">
                        <div class="comment-meta">
                            <strong>{{ $comment->author_name }}</strong>
                            <time datetime="{{ $comment->created_at->toISOString() }}">
                                {{ $comment->created_at->format('F j, Y \a\t g:i A') }}
                            </time>
                        </div>
                        <div class="comment-content">
                            {!! $comment->content !!}
                        </div>
                    </div>
                @endforeach
            </section>
        @endif
    </main>
    <x-partials.footer />
</x-layouts.app>

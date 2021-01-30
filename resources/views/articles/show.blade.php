@extends ('layout')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <aside class="right-section">
                <div class="_button">
                    <a href="{{ $article->id }}/edit" class="button">Edit Article</a>
                </div>

                <div class="_button">
                    <a href="{{ $article->id }}/delete" class="button">Delete Article</a>
                </div>
            </aside>

            <div id="content">
                <div class="title">
                    <h2>{{ $article->title }}</h2>
                </div>
                <p><img src="/images/banner.jpg" alt="" class="image image-full" /> </p>
                {{ $article->body }}
 
                <p style="margin-top: 1em" >
                    @foreach ($article->tags as $tag)
                        <span class="tag">
                            <a href="{{ route('articles.index', ['tag' => $tag->name]) }}">{{ $tag->name }}</a>
                        </span>
                    @endforeach
                </p>

            </div>
        </div>
    </div>
@endsection
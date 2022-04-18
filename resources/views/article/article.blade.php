@extends('article.template.app')
@section('title', $article->title)
@section('content')


    <div class="card mt-4">
        <a href="/{{ $article->slug }}">
            <img style="height: 324px; object-fit: cover;" src="{{ asset('upload/post/' . $article->picture) }}"
                class="card-img-top w-100" alt="{{ $article->title }}" />
        </a>
        <div class="card-body">
            <h5 class="card-title">{{ $article->title }}
                <small class="float-right text-center">
                    <a href="/konu/{{ $article->kategori->slug }}">
                        <small class="text-muted">{{ $article->kategori->name }}</small>
                    </a>
                    /
                    <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                    /
                    @foreach ($article->tag as $item)
                        @if ($loop->last)
                            <small class="text-muted"><a href="/icerik/{{ $item->slug }}">{{ $item->name }}</a></small>
                        @else
                            <small class="text-muted"><a href="/icerik/{{ $item->slug }}">{{ $item->name }},</a></small>
                        @endif
                    @endforeach
                </small>

            </h5>
            <hr>
            <p class="card-text">{!! $article->content !!}</p>

            <a href="/" class="btn btn-secondary btn-sm">Geri</a>
        </div>
    </div>


@endsection

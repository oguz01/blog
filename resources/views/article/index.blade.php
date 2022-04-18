@extends('article.template.app')
@section('title', 'Anasayfa | ' . env('BLOG_TITLE'))
@section('content')
    <div class="row mt-4">
        @foreach ($article as $item)
            <div class="col-md-4">
                <div class="card">
                    <a href="/{{ $item->slug }}">
                        <img src="{{ asset('upload/post/' . $item->picture) }}" class="card-img-top"
                            alt="{{ $item->title }}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text"><small
                                class="text-muted">{{ $item->created_at->diffForHumans() }}</small></p>
                        <a href="/{{ $item->slug }}" class="btn btn-primary btn-sm">Yazıyı Görüntüle</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

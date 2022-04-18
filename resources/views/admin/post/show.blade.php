@extends('layouts.sb-admin.app')
@section('title', 'Yazı Detayları | ' . env('BLOG_TITLE'))
@section('content')
    <a href="{{ route('post.index') }}" class="btn btn-secondary btn-sm mb-3"><i class="fa fa-arrow-left"></i> Geri</a>
    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary btn-sm mb-3"><i class="fa fa-edit"></i> Yazıyı
        Düzenle</a>
        <div class="card mb-3">
            <img src="/upload/post/{{ $post->picture }}" class="card-img-top"
                style="display: block;width: 100%;margin-bottom: 20px;height: 350px;object-fit: cover;"
                alt="{{ $post->title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->title }}</p>
                <p class="card-text"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                </p>
            </div>
        </div>
@endsection

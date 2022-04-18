@extends('layouts.sb-admin.app')
@section('title', 'Etiket Oluştur | ' . env('BLOG_TITLE'))
@section('content')
    <h1 class="h3 mb-0 text-gray-800">Etiket Düzenle</h1>
    <hr>
    <form action="{{ route('tag.update', $tag->id) }}" method="POST" class="mb-3">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="isim">Etiket</label>
                    <input type="text" id="isim" name="name" value="{{ $tag->name }}" class="form-control"
                        placeholder="Etiket">
                </div>
            </div>
            @error('name')
                <small class="text-danger p-1">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Düzenle</button>
        <a href="{{ route('tag.index') }}" class="btn btn-warning btn-sm">Geri</a>
    </form>
@endsection

@extends('layouts.sb-admin.app')
@section('title', 'Kategori Oluştur | ' . env('BLOG_TITLE'))
@section('content')
    <h1 class="h3 mb-0 text-gray-800">Kategoriler Düzenle</h1>
    <hr>
    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="mb-3">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="isim">Kategori</label>
                    <input type="text" id="isim" name="name" value="{{ $kategori->name }}" class="form-control" placeholder="Kategori">
                </div>
            </div>
            @error('name')
            <small class="text-danger p-1">{{ $message }}</small>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Düzenle</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-warning btn-sm">Geri</a>
    </form>
@endsection

@extends('layouts.sb-admin.app')
@section('title', 'Kategori Oluştur | ' . env('BLOG_TITLE'))
@section('content')
    <h1 class="h3 mb-0 text-gray-800">Kategoriler Oluştur</h1>
    <hr>
    <form action="{{ route('kategori.store') }}" method="POST" class="mb-3">
        @csrf
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="isim">Kategori</label>
                    <input type="text" id="isim" name="name" class="form-control" placeholder="Kategori">
                </div>


                {{-- <div class="col">
                    <label for="slug">Slug</label>
                    <input type="text" id="slug" class="form-control" placeholder="Slug">
                </div> --}}
            </div>
            @error('name')
            <small class="text-danger p-1">{{ $message }}</small>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Kaydet</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-warning btn-sm">Geri</a>
    </form>

@endsection

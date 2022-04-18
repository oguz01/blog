@extends('layouts.sb-admin.app')
@section('title', 'Yazıyı Düzenle | ' . env('BLOG_TITLE'))
@section('content')
    <h1 class="h3 mb-0 text-gray-800">Yazıyı Düzenle</h1>
    <hr>
    <form action="{{ route('post.update', $post->id) }}" method="POST" class="mb-3"
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <div class="form-row">
                <div class="col-5">
                    <label for="title">Başlık</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Başlık Giriniz"
                        value="{{ old('title') ? old('title') : $post->title }}">
                </div>
                @error('title')
                    <small class="text-danger p-1">{{ $message }}</small>
                @enderror

                <div class="col-5">
                    <label for="resim">Resim</label>
                    <input type="file" id="resim" name="picture" value="{{ $post->picture }}" class="form-control">
                </div>
                <div class="col-2">
                    @if ($post->picture)
                        <img src="{{ asset('upload/post/' . $post->picture) }}" width="auto" height="100px"
                            alt="{{ old('title') ? old('title') : $post->title }}">
                    @else
                        <p>Resim Bulunamadı.</p>
                    @endif
                </div>
            </div>
            @error('picture')
                <small class="text-danger p-1">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="kategori">Kategori Seçiniz</label>
            <select class="form-control" id="kategori" name="kategori">
                @foreach ($kategori as $item)
                    <option {{ $item->id == $post->id_kategori ? 'selected' : '' }} value="{{ $item->id }}">
                        {{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        @error('kategori')
            <small class="text-danger p-1">{{ $message }}</small>
        @enderror

        <div class="form-group">
            <label for="tag">Etiket Seçiniz</label>
            <select multiple class="form-control" id="tag" name="tag[]">
                @foreach ($tag as $item)
                    <option value="{{ $item->id }}"
                        @foreach ($post->tag as $row) {{ $item->id == $row->id ? 'selected' : '' }} @endforeach>
                        {{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        @error('tag')
            <small class="text-danger p-1">{{ $message }}</small>
        @enderror

        <div class="form-group">
            <label for="textarea">içerik</label>
            <textarea class="form-control" name="content" placeholder="İçerik giriniz" id="textarea">
           {{ old('content') ? old('content') : $post->content }}
            </textarea>
            @error('content')
                <small class="text-danger p-1">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Düzenle</button>
        <a href="{{ route('post.index') }}" class="btn btn-warning btn-sm">Geri</a>
    </form>


@endsection
@push('js')
    <script>
        ClassicEditor
            .create(document.querySelector('#textarea'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush

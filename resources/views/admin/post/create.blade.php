@extends('layouts.sb-admin.app')
@section('title', 'Post Oluştur | ' . env('BLOG_TITLE'))
@section('content')
    <h1 class="h3 mb-0 text-gray-800">Post Oluştur</h1>
    <hr>
    <form action="{{ route('post.store') }}" method="POST" class="mb-3" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="title">Başlık</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Başlık Giriniz"
                        value="{{ old('title') }}">
                </div>
                @error('title')
                    <small class="text-danger p-1">{{ $message }}</small>
                @enderror
                <div class="col">
                    <label for="resim">Resim</label>
                    <input type="file" id="resim" name="picture" class="form-control">
                </div>
            </div>
            @error('picture')
                <small class="text-danger p-1">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="kategori">Kategori Seçiniz</label>
            <select class="form-control" id="kategori" name="kategori">
                <option selected disabled>Kategori Seçiniz</option>
                @foreach ($kategori as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          @error('tag')
          <small class="text-danger p-1">{{ $message }}</small>
      @enderror
        <div class="form-group">
            <label for="textarea">içerik</label>
            <textarea class="form-control" name="content" placeholder="İçerik giriniz" id="textarea">
                {{ old('content') }}
            </textarea>
            @error('content')
                <small class="text-danger p-1">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Kaydet</button>
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

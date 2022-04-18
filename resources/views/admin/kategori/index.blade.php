@extends('layouts.sb-admin.app')
@section('title', 'Kategori | ' . env('BLOG_TITLE'))
@section('content')
    <h1 class="h3 mb-0 text-gray-800">Kategoriler</h1>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm mt-2">
        <i class="fas fa-plus"></i> Kategory
        Oluştur</a>
    @if ($kategori[0])
        {{-- Table --}}
        <table class="table table-bordered table-striped table-sm table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kategory</th>
                    <th scope="col">Seo Url</th>
                    <th scope="col">İşlem</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-primary btn-sm mr-1"><i
                                        class="fas fa-edit"></i> Düzenle</a>
                                <form method="POST" action="{{ route('kategori.destroy', $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Sil
                                    </button>
                                </form>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex mb-3 justify-content-end">
            {{ $kategori->links() }}
        </div>
        @else
        <div class="alert alert-info mt-3 text-center" role="alert">
            Mevcut Kategori Bulunmamaktadır.
        </div>
    @endif
@endsection

@extends('layouts.sb-admin.app')
@section('title', 'Banner | ' . env('BLOG_TITLE'))
@section('content')
    <h1 class="h3 mb-0 text-gray-800">Banner</h1>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('banner.create') }}" class="btn btn-primary btn-sm mt-2">
        <i class="fas fa-plus"></i> Banner
        Oluştur</a>
    @if ($banner[0])
        {{-- Table --}}
        <table class="table table-bordered table-striped table-sm table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Resim</th>
                    <th scope="col">Başlık</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Etiket</th>
                    <th scope="col">İşlem</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banner as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td align="center"><img width="auto" height="50px" src="upload/banner/{{ $item->picture }}"
                                alt="{{ $item->title }}"></td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->kategori->name }}</td>
                        <td class="text-center align-items-center">

                            @forelse ($item->tag as $row)
                                <span class="badge badge-info">{{ $row->name }}</span>
                            @empty
                                <span class="badge badge-secondary">Etiket Bulunamadı.</span>
                            @endforelse
                        </td>
                        <td class="align-items-center d-flex justify-content-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('banner.show', $item->id) }}" class="btn btn-primary btn-sm mr-1"><i
                                        class="fas fa-eye"></i> Ön İzleme</a>
                                <a href="{{ route('banner.edit', $item->id) }}" class="btn btn-primary btn-sm mr-1"><i
                                        class="fas fa-edit"></i> Düzenle</a>

                                <a href="/banner/{{ $item->id }}/kontrol" class="btn btn-danger btn-sm mr-1"><i
                                        class="fas fa-trash"></i> Sil</a>
                                {{-- <form method="banner" action="{{ route('banner.destroy', $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Eminmisin Bu işin Geri Dönüşü Yok Babbbaaaaaa....?')">
                                        <i class="fas fa-trash"></i> Sil
                                    </button>
                                </form> --}}
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex mb-3 justify-content-end">
            {{ $banner->links() }}
        </div>
    @else
        <div class="alert alert-info mt-3 text-center" role="alert">
            Mevcut Banner Bulunmamaktadır.
        </div>
    @endif
@endsection

@extends('layouts.app')

@section('title', 'Projeler')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>Projeler</span>
    <a href="{{ route('proje.create') }}" class="btn btn-success btn-sm">Yeni Proje Ekle</a>
  </div>
  <div class="card-body">
    @if(session('message'))
      <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr class="text-center">
            <th>ID</th>
            <th>Başlık</th>
            <th>Toplam Tutar (₺)</th>
            <th>Daire Başı Ödeme (₺)</th>
            <th>İşlemler</th>
          </tr>
        </thead>
        <tbody>
          @foreach($projes as $proje)
          <tr>
            <td class="text-center">{{ $proje->id }}</td>
            <td>{{ $proje->baslik }}</td>
            <td class="text-end">{{ number_format($proje->toplam_tutar, 2, ',', '.') }}</td>
            <td class="text-end">{{ number_format($proje->daire_basi_odeme, 2, ',', '.') }}</td>
            <td class="text-center">
              <a href="{{ route('proje.edit', $proje->id) }}" class="btn btn-sm btn-primary">Düzenle</a>
              <form action="{{ route('proje.destroy', $proje->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

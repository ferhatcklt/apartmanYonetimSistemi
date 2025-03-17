@extends('layouts.app')

@section('title', 'Proje Düzenle')

@section('content')
<div class="card">
  <div class="card-header">Proje Düzenle</div>
  <div class="card-body">
    <form action="{{ route('proje.update', $proje->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label class="form-label">Proje Başlığı</label>
        <input type="text" name="baslik" class="form-control" value="{{ $proje->baslik }}" placeholder="Proje Başlığı">
      </div>
      <div class="mb-3">
        <label class="form-label">Detay</label>
        <textarea name="detay" class="form-control" rows="4" placeholder="Proje Detayı">{{ $proje->detay }}</textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Toplam Proje Tutarı (₺)</label>
        <input type="text" name="toplam_tutar" class="form-control" value="{{ $proje->toplam_tutar }}" placeholder="Toplam Tutar">
      </div>
      <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
  </div>
</div>
@endsection

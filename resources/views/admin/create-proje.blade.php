@extends('layouts.app')

@section('title', 'Yeni Proje Ekle')

@section('content')
<div class="card">
  <div class="card-header">Yeni Proje Ekle</div>
  <div class="card-body">
    <form action="{{ route('proje.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label">Proje Başlığı</label>
        <input type="text" name="baslik" class="form-control" placeholder="Proje Başlığı">
      </div>
      <div class="mb-3">
        <label class="form-label">Detay</label>
        <textarea name="detay" class="form-control" rows="4" placeholder="Proje Detayı"></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Toplam Proje Tutarı (₺)</label>
        <input type="text" name="toplam_tutar" class="form-control" placeholder="Toplam Tutar">
      </div>
      <button type="submit" class="btn btn-primary">Projeyi Kaydet</button>
    </form>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Gelir Düzenle')

@section('content')
<div class="card">
  <div class="card-header">Gelir Düzenle</div>
  <div class="card-body">
    <form action="{{ route('gelir.update', $gelir->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label class="form-label">Başlık</label>
        <input type="text" name="baslik" class="form-control" value="{{ $gelir->baslik }}">
      </div>
      <div class="mb-3">
        <label class="form-label">Açıklama</label>
        <textarea name="aciklama" class="form-control" rows="3">{{ $gelir->aciklama }}</textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Fotoğraf URL (Opsiyonel)</label>
        <input type="text" name="foto" class="form-control" value="{{ $gelir->foto }}">
      </div>
      <div class="mb-3">
        <label class="form-label">Proje Seçimi (Opsiyonel)</label>
        <input type="text" name="proje_id" class="form-control" value="{{ $gelir->proje_id }}">
      </div>
      <div class="mb-3">
        <label class="form-label">Miktar (₺)</label>
        <input type="text" name="miktar" class="form-control" value="{{ $gelir->miktar }}">
      </div>
      <div class="mb-3">
        <label class="form-label">Tarih</label>
        <input type="date" name="tarih" class="form-control" value="{{ $gelir->tarih }}">
      </div>
      <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
  </div>
</div>
@endsection

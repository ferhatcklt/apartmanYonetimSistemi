@extends('layouts.app')

@section('title', 'Yeni Gider Ekle')

@section('content')
<div class="card">
  <div class="card-header">Yeni Gider Ekle</div>
  <div class="card-body">
    <form action="{{ route('gider.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label">Başlık</label>
        <input type="text" name="baslik" class="form-control" placeholder="Gider Başlığı">
      </div>
      <div class="mb-3">
        <label class="form-label">Açıklama</label>
        <textarea name="aciklama" class="form-control" rows="3" placeholder="Açıklama"></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Fotoğraf URL (Opsiyonel)</label>
        <input type="text" name="foto" class="form-control" placeholder="Fotoğraf URL">
      </div>
      <div class="mb-3">
        <label class="form-label">Miktar (₺)</label>
        <input type="text" name="miktar" class="form-control" placeholder="Miktar">
      </div>
      <div class="mb-3">
        <label class="form-label">Tarih</label>
        <input type="date" name="tarih" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Kaydet</button>
    </form>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Gider Düzenle')

@section('content')
<div class="card">
  <div class="card-header">Gider Düzenle</div>
  <div class="card-body">
    <form action="{{ route('gider.update', $gider->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label class="form-label">Başlık</label>
        <input type="text" name="baslik" class="form-control" value="{{ $gider->baslik }}">
      </div>
      <div class="mb-3">
        <label class="form-label">Açıklama</label>
        <textarea name="aciklama" class="form-control" rows="3">{{ $gider->aciklama }}</textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Fotoğraf URL (Opsiyonel)</label>
        <input type="text" name="foto" class="form-control" value="{{ $gider->foto }}">
      </div>
      <div class="mb-3">
        <label class="form-label">Miktar (₺)</label>
        <input type="text" name="miktar" class="form-control" value="{{ $gider->miktar }}">
      </div>
      <div class="mb-3">
        <label class="form-label">Tarih</label>
        <input type="date" name="tarih" class="form-control" value="{{ $gider->tarih }}">
      </div>
      <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
  </div>
</div>
@endsection

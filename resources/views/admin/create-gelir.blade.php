@extends('layouts.app')

@section('title', 'Yeni Gelir Ekle')

@section('content')
<div class="card">
  <div class="card-header">Yeni Gelir Ekle</div>
  <div class="card-body">
    <form action="{{ route('gelir.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label class="form-label">Başlık</label>
        <input type="text" name="baslik" class="form-control" placeholder="Gelir Başlığı">
      </div>
      <div class="mb-3">
        <label class="form-label">Açıklama</label>
        <textarea name="aciklama" class="form-control" rows="3" placeholder="Açıklama"></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Fotoğraf (Opsiyonel)</label>
        <input type="file" name="foto" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Proje Seçimi (Opsiyonel)</label>
        <select name="proje_id" class="form-select">
          <option value="">Seçiniz</option>
          @foreach($projeler as $proje)
            <option value="{{ $proje->id }}">{{ $proje->baslik }}</option>
          @endforeach
        </select>
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

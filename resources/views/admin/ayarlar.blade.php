@extends('layouts.app')

@section('title', 'Ayarlar')

@section('content')
<div class="card">
  <div class="card-header">Bina Ayarları</div>
  <div class="card-body">
    @if(session('message'))
      <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <form action="{{ route('admin.ayarlar.update') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label">Daire Sayısı</label>
        <input type="number" name="daire_sayisi" class="form-control" value="{{ $ayar->daire_sayisi }}">
      </div>
      <div class="mb-3">
        <label class="form-label">Güncel Aidat (₺)</label>
        <input type="text" name="guncel_aidat" class="form-control" value="{{ $ayar->guncel_aidat }}">
      </div>
      <div class="mb-3">
        <label class="form-label">İlk Kasa (₺)</label>
        <input type="text" name="ilk_kasa" class="form-control" value="{{ $ayar->ilk_kasa }}">
      </div>
      <div class="mb-3">
        <label class="form-label">Log Kayıtları</label>
        <textarea name="log_kayitlari" class="form-control" rows="4" placeholder="Log kayıtlarını buraya ekleyin...">{{ $ayar->log_kayitlari ?? '' }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">Ayarları Güncelle</button>
    </form>
  </div>
</div>
@endsection

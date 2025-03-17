@extends('layouts.app')

@section('title', 'Aidat Kaydı Düzenle')

@section('content')
<div class="card shadow-sm">
  <div class="card-header">
    <h4>Aidat Kaydı Düzenle</h4>
  </div>
  <div class="card-body">
    <form action="{{ route('admin.aidat.gelir.update', $aidat->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label class="form-label">Daire No</label>
        <input type="number" name="daire_no" class="form-control" value="{{ $aidat->daire_no }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Ay</label>
        <input type="text" name="ay" class="form-control" value="{{ $aidat->ay }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Yıl</label>
        <input type="number" name="yil" class="form-control" value="{{ $aidat->yil }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Miktar (₺)</label>
        <input type="text" name="miktar" class="form-control" value="{{ $aidat->miktar }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Ödeme Durumu</label>
        <select name="status" class="form-select" required>
          <option value="odendi" {{ $aidat->status == 'odendi' ? 'selected' : '' }}>Ödendi</option>
          <option value="odenmedi" {{ $aidat->status == 'odenmedi' ? 'selected' : '' }}>Ödenmedi</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Güncelle</button>
      <a href="{{ route('admin.aidat.gelir') }}" class="btn btn-secondary">İptal</a>
    </form>
  </div>
</div>
@endsection

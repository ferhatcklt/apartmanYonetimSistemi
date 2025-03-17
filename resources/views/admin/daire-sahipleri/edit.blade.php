@extends('layouts.app')

@section('title', 'Daire Sahibi Düzenle')

@section('content')
<div class="card shadow-sm">
  <div class="card-header">
    <h4>Daire Sahibi Düzenle</h4>
  </div>
  <div class="card-body">
    <form action="{{ route('admin.daire-sahipleri.update', $daireSahibi->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label class="form-label">Daire No</label>
        <input type="number" name="daire_no" class="form-control" value="{{ $daireSahibi->daire_no }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">İsim</label>
        <input type="text" name="isim" class="form-control" value="{{ $daireSahibi->isim }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $daireSahibi->email }}">
      </div>
      <div class="mb-3">
        <label class="form-label">Telefon</label>
        <input type="text" name="telefon" class="form-control" value="{{ $daireSahibi->telefon }}">
      </div>
      <button type="submit" class="btn btn-primary">Güncelle</button>
      <a href="{{ route('admin.daire-sahipleri.index') }}" class="btn btn-secondary">İptal</a>
    </form>
  </div>
</div>
@endsection

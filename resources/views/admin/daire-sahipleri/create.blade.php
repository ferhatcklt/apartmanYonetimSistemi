@extends('layouts.app')

@section('title', 'Yeni Daire Sahibi Ekle')

@section('content')
<div class="card shadow-sm">
  <div class="card-header">
    <h4>Yeni Daire Sahibi Ekle</h4>
  </div>
  <div class="card-body">
    <form action="{{ route('admin.daire-sahipleri.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label">Daire No</label>
        <input type="number" name="daire_no" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">İsim</label>
        <input type="text" name="isim" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Telefon</label>
        <input type="text" name="telefon" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Ekle</button>
      <a href="{{ route('admin.daire-sahipleri.index') }}" class="btn btn-secondary">İptal</a>
    </form>
  </div>
</div>
@endsection

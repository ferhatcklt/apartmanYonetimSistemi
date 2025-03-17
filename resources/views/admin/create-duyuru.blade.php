@extends('layouts.app')

@section('title', 'Yeni Duyuru Ekle')

@section('content')
<div class="card">
  <div class="card-header">Yeni Duyuru Ekle</div>
  <div class="card-body">
    <form action="{{ route('duyuru.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label">Başlık</label>
        <input type="text" name="baslik" class="form-control" placeholder="Duyuru Başlığı">
      </div>
      <div class="mb-3">
        <label class="form-label">Açıklama</label>
        <textarea name="aciklama" class="form-control" rows="4" placeholder="Duyuru Açıklaması"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Ekle</button>
    </form>
  </div>
</div>
@endsection

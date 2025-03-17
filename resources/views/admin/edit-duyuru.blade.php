@extends('layouts.app')

@section('title', 'Duyuru Düzenle')

@section('content')
<div class="card">
  <div class="card-header">Duyuru Düzenle</div>
  <div class="card-body">
    <form action="{{ route('duyuru.update', $duyuru->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label class="form-label">Başlık</label>
        <input type="text" name="baslik" class="form-control" value="{{ $duyuru->baslik }}">
      </div>
      <div class="mb-3">
        <label class="form-label">Açıklama</label>
        <textarea name="aciklama" class="form-control" rows="4">{{ $duyuru->aciklama }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
  </div>
</div>
@endsection

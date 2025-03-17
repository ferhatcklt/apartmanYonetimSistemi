@extends('layouts.app')

@section('title', 'Duyurular')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>Duyurular</span>
    <a href="{{ route('duyuru.create') }}" class="btn btn-success btn-sm">Yeni Duyuru Ekle</a>
  </div>
  <div class="card-body">
    @if(session('message'))
      <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <table class="table table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Başlık</th>
          <th>Açıklama</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
        @foreach($duyurular as $duyuru)
          <tr>
            <td>{{ $duyuru->id }}</td>
            <td>{{ $duyuru->baslik }}</td>
            <td>{{ $duyuru->aciklama }}</td>
            <td>
              <a href="{{ route('duyuru.edit', $duyuru->id) }}" class="btn btn-primary btn-sm">Düzenle</a>
              <form action="{{ route('duyuru.destroy', $duyuru->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit">Sil</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

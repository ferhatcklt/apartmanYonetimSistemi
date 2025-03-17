@extends('layouts.app')

@section('title', 'Gelir Yönetimi')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>Gelir Kayıtları</span>
    <a href="{{ route('gelir.create') }}" class="btn btn-success btn-sm">Yeni Gelir Ekle</a>
  </div>
  <div class="card-body">
    @if(session('message'))
      <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <table class="table table-responsive table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Başlık</th>
          <th>Miktar (₺)</th>
          <th>Tarih</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
        @foreach($gelirler as $gelir)
          <tr>
            <td>{{ $gelir->id }}</td>
            <td>{{ $gelir->baslik }}</td>
            <td>{{ number_format($gelir->miktar, 2, ',', '.') }}</td>
            <td>{{ $gelir->tarih }}</td>
            <td>
              <a href="{{ route('gelir.edit', $gelir->id) }}" class="btn btn-primary btn-sm">Düzenle</a>
              <form action="{{ route('gelir.destroy', $gelir->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

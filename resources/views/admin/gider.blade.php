@extends('layouts.app')

@section('title', 'Gider Yönetimi')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <span>Gider Kayıtları</span>
    <a href="{{ route('gider.create') }}" class="btn btn-success btn-sm">Yeni Gider Ekle</a>
  </div>
  <div class="card-body">
    @if(session('message'))
      <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <table class="table table-responsive table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Başlık</th>
          <th>Miktar</th>
          <th>Tarih</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
        @foreach($giderler as $gider)
        <tr>
          <td>{{ $gider->id }}</td>
          <td>{{ $gider->baslik }}</td>
          <td>{{ $gider->miktar }} ₺</td>
          <td>{{ $gider->tarih }}</td>
          <td>
            <a href="{{ route('gider.edit', $gider->id) }}" class="btn btn-primary btn-sm">Düzenle</a>
            <form action="{{ route('gider.destroy', $gider->id) }}" method="POST" class="d-inline">
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

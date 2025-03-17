@extends('layouts.app')

@section('title', 'Daire Sahipleri')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h4>Daire Sahipleri</h4>
    <a href="{{ route('admin.daire-sahipleri.create') }}" class="btn btn-success btn-sm">Yeni Daire Sahibi Ekle</a>
  </div>
  <div class="card-body">
    @if(session('message'))
      <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr class="text-center">
            <th>ID</th>
            <th>Daire No</th>
            <th>İsim</th>
            <th>Email</th>
            <th>Telefon</th>
            <th>İşlemler</th>
          </tr>
        </thead>
        <tbody>
          @foreach($daireSahipleri as $sahip)
            <tr class="text-center">
              <td>{{ $sahip->id }}</td>
              <td>{{ $sahip->daire_no }}</td>
              <td>{{ $sahip->isim }}</td>
              <td>{{ $sahip->email }}</td>
              <td>{{ $sahip->telefon }}</td>
              <td>
                <a href="{{ route('admin.daire-sahipleri.edit', $sahip->id) }}" class="btn btn-sm btn-primary">Düzenle</a>
                <form action="{{ route('admin.daire-sahipleri.destroy', $sahip->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Silmek istediğinize emin misiniz?')" class="btn btn-sm btn-danger">Sil</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

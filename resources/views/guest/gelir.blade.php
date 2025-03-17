@extends('layouts.app')

@section('title', 'Gelirler')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Gelirler</h4>
    <!-- Güncelleme veya ekleme butonu yok, yalnızca görüntüleme -->
  </div>
  <div class="card-body">
    @if($gelirler->count() > 0)
      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <thead class="table-light">
            <tr class="text-center">
              <th>ID</th>
              <th>Başlık</th>
              <th>Açıklama</th>
              <th>Miktar (₺)</th>
              <th>Tarih</th>
            </tr>
          </thead>
          <tbody>
            @foreach($gelirler as $gelir)
              <tr>
                <td class="text-center">{{ $gelir->id }}</td>
                <td>{{ $gelir->baslik }}</td>
                <td>{{ $gelir->aciklama }}</td>
                <td class="text-end">{{ number_format($gelir->miktar, 2, ',', '.') }}</td>
                <td class="text-center">{{ $gelir->tarih }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="alert alert-info">Hiç gelir kaydı bulunmamaktadır.</div>
    @endif
  </div>
</div>
@endsection

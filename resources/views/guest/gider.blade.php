@extends('layouts.app')

@section('title', 'Giderler')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Giderler</h4>
    <!-- Güncelleme veya ekleme butonu yok, yalnızca görüntüleme -->
  </div>
  <div class="card-body">
    @if($giderler->count() > 0)
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
            @foreach($giderler as $gider)
              <tr>
                <td class="text-center">{{ $gider->id }}</td>
                <td>{{ $gider->baslik }}</td>
                <td>{{ $gider->aciklama }}</td>
                <td class="text-end">{{ number_format($gider->miktar, 2, ',', '.') }}</td>
                <td class="text-center">{{ $gider->tarih }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="alert alert-info">Hiç gider kaydı bulunmamaktadır.</div>
    @endif
  </div>
</div>
@endsection

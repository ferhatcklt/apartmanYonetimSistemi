@extends('layouts.app')

@section('title', 'Borçlular')

@section('content')
<div class="card shadow-sm">
  <div class="card-header">
    <h4 class="mb-0">Borçlular ({{ $year }})</h4>
  </div>
  <div class="card-body">
    @if(count($borcluList) > 0)
      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <thead class="table-light text-center">
            <tr>
              <th>Daire No</th>
              <th>İsim</th>
              <th>Ödenmeyen Ay Sayısı</th>
              <th>Toplam Ödenmemiş Tutar (₺)</th>
            </tr>
          </thead>
          <tbody>
            @foreach($borcluList as $borc)
              <tr class="text-center">
                <td class="fw-bold">{{ $borc['daire_no'] }}</td>
                <td>{{ $borc['isim'] }}</td>
                <td>{{ $borc['unpaidCount'] }}</td>
                <td>{{ number_format($borc['unpaidTotal'], 2, ',', '.') }} ₺</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="alert alert-info">Borçlu daire kaydı bulunmamaktadır.</div>
    @endif
  </div>
</div>
@endsection

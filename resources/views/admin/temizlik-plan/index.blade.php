@extends('layouts.app')

@section('title', 'Aylık Temizlik Planı')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Temizlik Planı - {{ $months[$selectedMonth] }} {{ $selectedYear }}</h4>
    <!-- Ay ve Yıl Seçimi Formu -->
    <form action="{{ route('admin.temizlik.plan.index') }}" method="GET" class="d-flex align-items-center">
      <select name="month" class="form-select me-2" style="width: auto;">
        @foreach($months as $num => $name)
          <option value="{{ $num }}" {{ $selectedMonth == $num ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
      </select>
      <input type="number" name="year" value="{{ $selectedYear }}" class="form-control me-2" style="width: 100px;">
      <button type="submit" class="btn btn-primary">Göster</button>
    </form>
  </div>
  <div class="card-body">
    <table class="table table-bordered text-center">
      <thead class="table-light">
        <tr>

          <th>Pazartesi</th>
          <th>Salı</th>
          <th>Çarşamba</th>
          <th>Perşembe</th>
          <th>Cuma</th>
          <th>Cumartesi</th>
          <th>Pazar</th>
        </tr>
      </thead>
      <tbody>
        @foreach($weeks as $week)
          <tr>
            @foreach($week as $day)
              @if($day)
                <td>
                  <div>{{ $day }}</div>
                  @if(isset($cleaningByDay[$day]))
                    @php
                      $item = $cleaningByDay[$day];
                      // Eğer ödeme haftası ise yeşil, aksi halde sarı
                      $badgeClass = $item['is_payment'] ? 'bg-success' : 'bg-warning text-dark';
                      $badgeText = $item['is_payment'] ? 'Ödeme' : 'Temizlik';
                    @endphp
                    <div class="mt-1">
                      <span class="badge {{ $badgeClass }}">{{ $badgeText }}</span>
                    </div>
                  @endif
                </td>
              @else
                <td></td>
              @endif
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
    <p class="mt-2"><em>Not: Temizlik tarihleri sarı ile, ödeme tarihleri yeşil ile işaretlenmiştir.</em></p>
  </div>
</div>
@endsection

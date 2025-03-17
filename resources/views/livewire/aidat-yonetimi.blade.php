<div>
  <!-- Yıl Seçim Bölümü -->
  <div class="mb-3">
    <label for="yearSelect" class="form-label">Yıl Seçiniz:</label>
    <!-- wire:change eklendi, böylece yıl seçildiğinde loadAidatRecords() tetiklenir -->
    <select id="yearSelect" wire:model="selectedYear" wire:change="loadAidatRecords" class="form-select" style="width: auto;">
      @foreach($years as $year)
        <option value="{{ $year }}">{{ $year }}</option>
      @endforeach
    </select>
  </div>

  <table class="table table-bordered table-responsive">
    <thead class="table-light">
      <tr>
        <th>Daire No</th>
        @foreach($aylar as $ay)
          <th class="text-center">{{ $ay }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @foreach($daireler as $daire)
        <tr>
          <td class="fw-bold">{{ $daire->no }}</td>
          @foreach($aylar as $ay)
            @php $renk = $this->getCellColor($daire->no, $ay); @endphp
            <td style="background-color: {{ $renk }};" class="text-center">
              <input type="text"
                     wire:model.defer="aidatMiktarlari.{{ $daire->no }}.{{ $ay }}"
                     class="form-control form-control-sm mb-1"
                     placeholder="Miktar">
              <button wire:click="ode({{ $daire->no }}, '{{ $ay }}')" class="btn btn-sm btn-outline-light">Öde</button>
            </td>
          @endforeach
        </tr>
      @endforeach
    </tbody>
  </table>

  @if(session()->has('message'))
    <div class="alert alert-success mt-2">{{ session('message') }}</div>
  @endif

  @if(session()->has('error'))
    <div class="alert alert-danger mt-2">{{ session('error') }}</div>
  @endif
</div>

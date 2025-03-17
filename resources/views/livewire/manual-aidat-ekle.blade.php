<div class="mt-4">
  <h5>Manuel Aidat Girişi</h5>
  <form wire:submit.prevent="submit">
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Daire No</label>
        <input type="number" wire:model="daire_no" class="form-control">
        @error('daire_no') <small class="text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="col-md-4">
        <label class="form-label">Aidat Ücreti (₺)</label>
        <input type="text" wire:model="miktar" class="form-control">
        @error('miktar') <small class="text-danger">{{ $message }}</small> @enderror
      </div>
      <div class="col-md-4">
        <label class="form-label">Tarih</label>
        <input type="date" wire:model="tarih" class="form-control">
        @error('tarih') <small class="text-danger">{{ $message }}</small> @enderror
      </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Kaydet</button>
  </form>
  @if(session()->has('message'))
    <div class="alert alert-success mt-3">{{ session('message') }}</div>
  @endif
</div>

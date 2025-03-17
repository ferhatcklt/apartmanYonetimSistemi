<div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Daire No</th>
                @foreach($aylar as $ay)
                    <th>{{ $ay }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($daireler as $daire)
                <tr>
                    <td>{{ $daire->no }}</td>
                    @foreach($aylar as $ay)
                        @php
                            $renk = $this->getCellColor($daire->no, $ay);
                        @endphp
                        <td style="background-color: {{ $renk }};">
                            <input type="text" wire:model.defer="aidatMiktarlari.{{ $daire->no }}.{{ $ay }}" class="form-control" placeholder="Miktar">
                            <button wire:click="ode({{ $daire->no }}, '{{ $ay }}')" class="btn btn-sm btn-primary mt-1">Öde</button>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    @if(session()->has('message'))
        <div class="alert alert-success mt-3">{{ session('message') }}</div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif
</div>

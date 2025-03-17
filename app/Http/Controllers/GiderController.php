<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gider;

class GiderController extends Controller
{
    public function index()
    {
        $giderler = Gider::all();
        return view('admin.gider', compact('giderler'));
    }

    public function create()
    {
        return view('admin.create-gider');
    }

    public function store(Request $request)
    {
        $request->validate([
            'baslik' => 'required|string|max:255',
            'miktar' => 'required|numeric|min:0',
            'tarih'  => 'required|date',
        ]);

        Gider::create($request->all());
        return redirect()->route('gider.index')->with('message', 'Gider kaydı eklendi.');
    }

    public function edit($id)
    {
        $gider = Gider::findOrFail($id);
        return view('admin.edit-gider', compact('gider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'baslik' => 'required|string|max:255',
            'miktar' => 'required|numeric|min:0',
            'tarih'  => 'required|date',
        ]);

        $gider = Gider::findOrFail($id);
        $gider->update($request->all());
        return redirect()->route('gider.index')->with('message', 'Gider kaydı güncellendi.');
    }

    public function destroy($id)
    {
        $gider = Gider::findOrFail($id);
        $gider->delete();
        return redirect()->route('gider.index')->with('message', 'Gider kaydı silindi.');
    }
}

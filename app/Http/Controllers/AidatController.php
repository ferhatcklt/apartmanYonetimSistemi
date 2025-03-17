<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aidat;

class AidatController extends Controller
{
    public function index(Request $request)
    {
        $query = Aidat::query();

        // Filtreleme: daire_no, ay, yil, status
        if ($request->filled('daire_no')) {
            $query->where('daire_no', $request->daire_no);
        }
        if ($request->filled('ay')) {
            $query->where('ay', $request->ay);
        }
        if ($request->filled('yil')) {
            $query->where('yil', $request->yil);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Kayıtları oluşturulma tarihine göre sıralayıp paginate ediyoruz (10 kayıt/sayfa)
        $aidatlar = $query->orderBy('created_at', 'desc')->paginate(10);
        $aidatlar->appends($request->all());

        return view('admin.aidat-gelir', compact('aidatlar'));
    }

    public function edit($id)
    {
        $aidat = Aidat::findOrFail($id);
        return view('admin.aidat-gelir-edit', compact('aidat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'daire_no' => 'required|integer',
            'ay'       => 'required|string',
            'yil'      => 'required|integer',
            'miktar'   => 'required|numeric',
            'status'   => 'required|in:odendi,odenmedi'
        ]);

        $aidat = Aidat::findOrFail($id);
        $aidat->update($request->all());

        return redirect()->route('admin.aidat.gelir')->with('message', 'Aidat kaydı güncellendi.');
    }

    public function destroy($id)
    {
        $aidat = Aidat::findOrFail($id);
        $aidat->delete();

        return redirect()->route('admin.aidat.gelir')->with('message', 'Aidat kaydı silindi.');
    }
}

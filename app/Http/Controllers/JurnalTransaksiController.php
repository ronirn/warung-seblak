<?php

namespace App\Http\Controllers;

use App\Models\JurnalTransaksi;
use Illuminate\Http\Request;

class JurnalTransaksiController extends Controller
{
    public function index()
    {
        $jurnals = JurnalTransaksi::all();
        return view('jurnal.index', compact('jurnals'));
    }

    public function create()
    {
        return view('jurnal.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pesanan_id' => 'required|exists:pesanan,id',
            'total_harga' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        JurnalTransaksi::create($validated);

        return redirect()->route('jurnal.index')->with('success', 'Jurnal transaksi berhasil dibuat.');
    }

    public function show(JurnalTransaksi $jurnal)
    {
        return view('jurnal.show', compact('jurnal'));
    }

    public function edit(JurnalTransaksi $jurnal)
    {
        return view('jurnal.edit', compact('jurnal'));
    }

    public function update(Request $request, JurnalTransaksi $jurnal)
    {
        $validated = $request->validate([
            'pesanan_id' => 'required|exists:pesanan,id',
            'total_harga' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $jurnal->update($validated);

        return redirect()->route('jurnal.index')->with('success', 'Jurnal transaksi berhasil diperbarui.');
    }

    public function destroy(JurnalTransaksi $jurnal)
    {
        $jurnal->delete();
        return redirect()->route('jurnal.index')->with('success', 'Jurnal transaksi berhasil dihapus.');
    }
}


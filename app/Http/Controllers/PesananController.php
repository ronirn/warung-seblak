<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Barang;
use App\Models\JurnalTransaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with('barang')->get();
        return view('pesanan.index', compact('pesanan'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('pesanan.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer',
            'total_harga' => 'required|numeric',
        ]);

        $pesanan = Pesanan::create($validated);

        // Cek jika status pesanan completed, catat di jurnal
        if ($pesanan->status === 'completed') {
            $this->catatJurnal($pesanan);
        }

        Alert::success('Sukses', 'Pesanan berhasil dibuat.');
        return redirect()->route('pesanan.index');
    }

    public function show(Pesanan $pesanan)
    {
        return view('pesanan.show', compact('pesanan'));
    }

    public function edit(Pesanan $pesanan)
    {
        $barang = Barang::all();
        return view('pesanan.edit', compact('pesanan', 'barang'));
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer',
            'total_harga' => 'required|numeric',
            'status' => 'required|in:pending,completed,void',
        ]);

        $pesanan->update($validated);

        // Cek jika status pesanan completed, catat di jurnal
        if ($pesanan->status === 'completed' && !$pesanan->jurnalTransaksi) {
            $this->catatJurnal($pesanan);
        }

        Alert::success('Sukses', 'Pesanan berhasil diperbarui.');
        return redirect()->route('pesanan.index');
    }

    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();
        Alert::success('Sukses', 'Pesanan berhasil dihapus.');
        return redirect()->route('pesanan.index');
    }

    private function catatJurnal(Pesanan $pesanan)
    {
        JurnalTransaksi::create([
            'pesanan_id' => $pesanan->id,
            'total_harga' => $pesanan->total_harga,
            'tanggal_transaksi' => Carbon::now(),
            'keterangan' => 'Transaksi selesai dan dicatat di jurnal.'
        ]);
    }
}




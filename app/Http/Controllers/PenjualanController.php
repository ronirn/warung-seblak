<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Pesanan::where('status', 'completed')
            ->whereNotNull('tanggal_penjualan')
            ->with('barang')
            ->get();

        $totalPendapatan = $penjualan->sum('total_harga');
        $jumlahBarangTerjual = $penjualan->sum('jumlah');

        return view('penjualan.index', compact('penjualan', 'totalPendapatan', 'jumlahBarangTerjual'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('penjualan.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer',
            'total_harga' => 'required|numeric',
        ]);

        $validated['status'] = 'completed';
        $validated['tanggal_penjualan'] = Carbon::now();

        Pesanan::create($validated);

        Alert::success('Sukses', 'Penjualan berhasil dibuat.');
        return redirect()->route('penjualan.index');
    }

    public function show(Pesanan $penjualan)
    {
        return view('penjualan.show', compact('penjualan'));
    }

    public function destroy(Pesanan $penjualan)
    {
        $penjualan->delete();

        Alert::success('Sukses', 'Penjualan berhasil dihapus.');
        return redirect()->route('penjualan.index');
    }
}

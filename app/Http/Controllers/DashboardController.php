<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Barang;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPendapatan = Pesanan::where('status', 'completed')->sum('total_harga');
        $jumlahBarangTerjual = Pesanan::where('status', 'completed')->sum('jumlah');
        $jumlahPesananPending = Pesanan::where('status', 'pending')->count();

        $recentOrders = Pesanan::with('barang')->orderBy('created_at', 'desc')->take(5)->get();

        $topProducts = Barang::with(['pesanan' => function ($query) {
            $query->where('status', 'completed');
        }])->get()->sortByDesc(function($barang) {
            return $barang->pesanan->sum('jumlah');
        })->take(5);

        return view('dashboard.index', compact('totalPendapatan', 'jumlahBarangTerjual', 'jumlahPesananPending', 'recentOrders', 'topProducts'));
    }
}




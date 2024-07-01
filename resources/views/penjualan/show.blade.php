@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Penjualan</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Barang: {{ $penjualan->barang->nama }}</h5>
                <p class="card-text">Jumlah: {{ $penjualan->jumlah }}</p>
                <p class="card-text">Total Harga: {{ $penjualan->total_harga }}</p>
                <p class="card-text">Tanggal Penjualan: {{ $penjualan->tanggal_penjualan }}</p>
                <a href="{{ route('penjualan.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
@endsection

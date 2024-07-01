@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Pesanan</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Barang: {{ $pesanan->barang->nama }}</h5>
                <p class="card-text">Jumlah: {{ $pesanan->jumlah }}</p>
                <p class="card-text">Total Harga: {{ $pesanan->total_harga }}</p>
                <p class="card-text">Status: {{ $pesanan->status }}</p>
                <a href="{{ route('pesanan.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
@endsection

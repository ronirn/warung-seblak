@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Barang</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $barang->nama }}</h5>
                <p class="card-text">Stok: {{ $barang->stok }}</p>
                <p class="card-text">Harga: {{ $barang->harga }}</p>
                <a href="{{ route('barang.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
@endsection

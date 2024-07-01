@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Data Penjualan</h1>

        <a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Tambah
        </a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-4">
            <h3 class="mb-3">Total Pendapatan: {{ $totalPendapatan }}</h3>
            <h3 class="mb-3">Jumlah Barang Terjual: {{ $jumlahBarangTerjual }}</h3>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal Penjualan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penjualan as $item)
                        <tr>
                            <td>{{ $item->barang->nama }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->total_harga }}</td>
                            <td>{{ $item->tanggal_penjualan }}</td>
                            <td>
                                <form action="{{ route('penjualan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

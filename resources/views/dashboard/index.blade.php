@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Dashboard Warung Seblak</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Info boxes -->
        <div class="row">
            <!-- Info box for Total Pendapatan -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-money-bill-wave"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pendapatan</span>
                        <span class="info-box-number">
                            Rp. {{ number_format($totalPendapatan, 2) }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- Info box for Jumlah Barang Terjual -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-boxes"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Barang Terjual</span>
                        <span class="info-box-number">
                            {{ $jumlahBarangTerjual }} Barang
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- Info box for Pesanan Pending -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pesanan Pending</span>
                        <span class="info-box-number">
                            {{ $jumlahPesananPending }} Pesanan
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-6">
                <!-- Card for Pesanan Terbaru -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pesanan Terbaru</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($recentOrders as $order)
                                <li class="list-group-item">
                                    <strong>{{ $order->barang->nama }}</strong>
                                    <span class="badge badge-primary float-right">{{ $order->status }}</span>
                                    <br>
                                    Jumlah: {{ $order->jumlah }} <br>
                                    Total Harga: Rp. {{ number_format($order->total_harga, 2) }} <br>
                                    Tanggal: {{ $order->created_at->format('d M Y') }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Card for Produk Terlaris -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Produk Terlaris</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($topProducts as $product)
                                <li class="list-group-item">
                                    <strong>{{ $product->nama }}</strong>
                                    <span class="badge badge-success float-right">{{ $product->pesanan->sum('jumlah') }} Terjual</span>
                                    <br>
                                    Harga: Rp. {{ number_format($product->harga, 2) }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection

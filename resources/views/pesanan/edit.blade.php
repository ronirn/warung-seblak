@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Pesanan</h1>
        <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="barang_id">Barang</label>
                <select name="barang_id" id="barang_id" class="form-control" required>
                    @foreach($barang as $item)
                        <option value="{{ $item->id }}" @if($item->id == $pesanan->barang_id) selected @endif>{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $pesanan->jumlah }}" required>
            </div>
            <div class="form-group">
                <label for="total_harga">Total Harga</label>
                <input type="number" name="total_harga" id="total_harga" class="form-control" value="{{ $pesanan->total_harga }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="pending" @if($pesanan->status == 'pending') selected @endif>Pending</option>
                    <option value="completed" @if($pesanan->status == 'completed') selected @endif>Completed</option>
                    <option value="void" @if($pesanan->status == 'void') selected @endif>Void</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection

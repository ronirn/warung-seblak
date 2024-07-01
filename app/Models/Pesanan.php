<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';

    protected $fillable = ['barang_id', 'jumlah', 'total_harga', 'status', 'tanggal_penjualan'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function jurnalTransaksi()
    {
        return $this->hasOne(JurnalTransaksi::class);
    }
}

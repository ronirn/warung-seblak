<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalTransaksi extends Model
{
    use HasFactory;

    protected $table = 'jurnal';

    protected $fillable = ['pesanan_id', 'total_harga', 'tanggal_transaksi', 'keterangan'];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}

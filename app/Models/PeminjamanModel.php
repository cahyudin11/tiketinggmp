<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_barang',
        'keterangan',
        'quantity',
        'barang_id_peminjaman',
        'status',
    ];
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id_peminjaman');
    }
    public function divisi()
    {
        return $this->belongsTo(DivisiModel::class, 'divisi_id');
    }
    public function svp()
{
    return $this->belongsTo(User::class, 'svp_id');
}
}

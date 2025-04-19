<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiketingModel extends Model
{
    protected $table = 'permintaan';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_barang',
        'keterangan',
        'quantity',
        'barang_id',
    ];
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id');
    }
    public function divisi()
    {
        return $this->belongsTo(DivisiModel::class, 'divisi_id');
    }
}

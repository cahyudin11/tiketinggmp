<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_barang',
    ];
    public function permintaan()
    {
        return $this->hasMany(tiketingModel::class, 'barang_id');
    }
}

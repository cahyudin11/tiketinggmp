<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tiketingModel extends Model
{
    protected $table = 'permintaan';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_barang',
        'keterangan',
        'quantity',
    ];
}

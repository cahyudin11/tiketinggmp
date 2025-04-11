<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerbaikanModel extends Model
{
    protected $table = 'tiket';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'tanggal',
        'kode_tiket',
        'nama',
        'divisi_id',
        'detail',
        'kontak',
        'photo',
        'status',
    ];

    public function divisi()
    {
        return $this->belongsTo(DivisiModel::class, 'divisi_id');
    }
}

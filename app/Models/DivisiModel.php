<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DivisiModel extends Model
{
    protected $table = 'divisi';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_divisi',
    ];

    public function tiket()
    {
        return $this->hasMany(PerbaikanModel::class, 'divisi_id');
    }
}

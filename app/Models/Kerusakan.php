<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal','id_masteralat','lokasi','kapasitas','ketkerusakan'
    ];

    public function masteralat()
    {
        return $this->hasOne(Masteralat::class, 'id', 'id_masteralat');
    }
}



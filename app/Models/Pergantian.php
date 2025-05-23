<?php

namespace App\Models;

use App\Models\Masteralat;
use App\Models\Masterteknisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pergantian extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_masteralat','tanggal','lokasi','sebelumganti','sesudahganti','id_masterteknisi','keterangan'
    ];

    public function masteralat()
    {
        return $this->hasOne(Masteralat::class, 'id', 'id_masteralat');
    }
    public function masterteknisi()
    {
        return $this->hasOne(Masterteknisi::class, 'id', 'id_masterteknisi');
    }
}

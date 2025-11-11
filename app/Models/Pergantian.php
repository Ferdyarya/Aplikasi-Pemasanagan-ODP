<?php

namespace App\Models;

use App\Models\Perbaikan;
use App\Models\Masteralat;
use App\Models\Masterteknisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pergantian extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal','lokasi','fotosebelum','fotosesudah','id_masterperbaikan','keterangan','biaya','waktumulai','waktuselesai'
    ];

    // public function masteralat()
    // {
    //     return $this->hasOne(Masteralat::class, 'id', 'id_masteralat');
    // }
    public function masterperbaikan()
    {
        return $this->hasOne(Perbaikan::class, 'id', 'id_masterperbaikan');
    }
}

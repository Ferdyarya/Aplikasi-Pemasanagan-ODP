<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal','lokasi','keterangan','fotosebelum','fotosesudah','id_masterpemasangan','waktumulai','waktuselesai'
    ];

    // public function masteralat()
    // {
    //     return $this->hasOne(Masteralat::class, 'id', 'id_masteralat');
    // }
    // public function masterteknisi()
    // {
    //     return $this->hasOne(Masterteknisi::class, 'id', 'id_masterteknisi');
    // }

    public function masterpemasangan()
    {
        return $this->hasOne(Pemasangan::class, 'id', 'id_masterpemasangan');
    }
}

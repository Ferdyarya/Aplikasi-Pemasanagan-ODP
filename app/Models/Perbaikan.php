<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_masteralat','tanggal','lokasi','kapasitas','catatan','fotosebelum','fotosesudah','id_masterteknisi'
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

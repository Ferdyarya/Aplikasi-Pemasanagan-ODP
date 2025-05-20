<?php

namespace App\Models;

use App\Models\Masteralat;
use App\Models\Masterclient;
use App\Models\Masterteknisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemasangan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_masterclient','id_masteralat','lokasi','kapasitas','odcterhubung','id_masterteknisi','nopemasangan','tanggal'
    ];

    public function masteralat()
    {
        return $this->hasOne(Masteralat::class, 'id', 'id_masteralat');
    }
    public function masterclient()
    {
        return $this->hasOne(Masterclient::class, 'id', 'id_masterclient');
    }

    public function masterteknisi()
    {
        return $this->hasOne(Masterteknisi::class, 'id', 'id_masterteknisi');
    }
}

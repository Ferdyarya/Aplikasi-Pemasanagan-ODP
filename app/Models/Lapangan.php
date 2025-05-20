<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_masterclient','id_masteralat','id_masterteknisi','lokasi','material','deskripsi','tanggal','hambatan'
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

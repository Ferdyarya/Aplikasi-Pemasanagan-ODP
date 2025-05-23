<?php

namespace App\Models;

use App\Models\Masterclient;
use App\Models\Masterteknisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jaringan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_masterclient','tanggal','alamat','fotohasil','id_masterteknisi','catatan','statuspasang','nopemasangan'
    ];

    public function masterclient()
    {
        return $this->hasOne(Masterclient::class, 'id', 'id_masterclient');
    }
    public function masterteknisi()
    {
        return $this->hasOne(Masterteknisi::class, 'id', 'id_masterteknisi');
    }
}

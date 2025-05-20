<?php

namespace App\Models;

use App\Models\Masterteknisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Izinlokasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_masterteknisi','tglkunjungan','lokasi','alasan','status','tujuan'
    ];

    public function masterteknisi()
    {
        return $this->hasOne(Masterteknisi::class, 'id', 'id_masterteknisi');
    }
}

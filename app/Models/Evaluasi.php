<?php

namespace App\Models;

use App\Models\Masterteknisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_masterteknisi','tanggal','statusnilai','keterangankerja','jumlahtugas'
    ];

    public function masterteknisi()
    {
        return $this->hasOne(Masterteknisi::class, 'id', 'id_masterteknisi');
    }
}

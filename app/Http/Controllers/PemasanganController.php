<?php

namespace App\Http\Controllers;

use PDF;

use App\Models\Masteralat;
use App\Models\Pemasangan;
use App\Models\Masterclient;
use Illuminate\Http\Request;
use App\Models\Masterteknisi;

class PemasanganController extends Controller
{
    public function index(Request $request)
{
    if ($request->has('search')) {
        $pemasangan = Pemasangan::whereHas('masterteknisi', function($query) use ($request) {
            $query->where('nama', 'LIKE', '%' . $request->search . '%');
        })->paginate(10);
    } else {
        $pemasangan = Pemasangan::paginate(10);
    }

    return view('pemasangan.index', [
        'pemasangan' => $pemasangan
    ]);
}


public function create()
{
    $masterclient = Masterclient::all();
    $masteralat = Masteralat::all();
    $masterteknisi = Masterteknisi::all();

    return view('pemasangan.create', [
        'masterclient' => $masterclient,
        'masteralat' => $masteralat,
        'masterteknisi' => $masterteknisi,
    ]);
}

public function store(Request $request)
{
    // Ambil data terakhir dari tabel pemasangan
    $lastPemasangan = Pemasangan::orderBy('id', 'desc')->first();

    // Generate nomor pemasangan
    if (!$lastPemasangan) {
        $nopemasangan = 'PSG-0001';
    } else {
        $lastNumber = (int) substr($lastPemasangan->nopemasangan, -4);
        $nextNumber = $lastNumber + 1;
        $nopemasangan = 'PSG-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    // Ambil semua data dari request
    $data = $request->all();

    // Tambahkan nomor pemasangan ke dalam data
    $data['nopemasangan'] = $nopemasangan;

    // Simpan ke database
    Pemasangan::create($data);

    return redirect()->route('pemasangan.index')->with('success', 'Data telah ditambahkan');
}




    public function show($id)
    {

    }


    public function edit(Pemasangan $pemasangan)
    {
        $masterclient = Masterclient::all();
        $masteralat = Masteralat::all();
        $masterteknisi = Masterteknisi::all();

        return view('pemasangan.edit', [
            'item' => $pemasangan,
            'masterclient' => $masterclient,
            'masteralat' => $masteralat,
            'masterteknisi' => $masterteknisi,
        ]);
    }


    public function update(Request $request, Pemasangan $pemasangan)
    {
        $data = $request->all();

        $pemasangan->update($data);

        //dd($data);

        return redirect()->route('pemasangan.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Pemasangan $pemasangan)
    {
        $pemasangan->delete();
        return redirect()->route('pemasangan.index')->with('success', 'Data Telah dihapus');
    }

    //Approval Status
//     public function updateStatusRawat(Request $request, $id)
// {
//     $validated = $request->validate([
//         'status' => 'required|in:Terverifikasi,Ditolak',
//     ]);

//     $pemasangan = Pemasangan::findOrFail($id);

//     $pemasangan->status = $validated['status'];
//     $pemasangan->save();

//     return redirect()->route('pemasangan.index')->with('success', 'Status surat berhasil diperbarui.');
// }













    //Report
    //  Laporan Buku pemasangan Filter
     public function cetakpasangpertanggal()
     {
         $pemasangan = Pemasangan::Paginate(10);

         return view('laporannya.laporanpemasangan', ['laporanpemasangan' => $pemasangan]);
     }

     public function filterdatepasang(Request $request)
     {
         $startDate = $request->input('dari');
         $endDate = $request->input('sampai');

          if ($startDate == '' && $endDate == '') {
             $laporanpemasangan = Pemasangan::paginate(10);
         } else {
             $laporanpemasangan = Pemasangan::whereDate('tanggal','>=',$startDate)
                                         ->whereDate('tanggal','<=',$endDate)
                                         ->paginate(10);
         }
         session(['filter_start_date' => $startDate]);
         session(['filter_end_date' => $endDate]);

         return view('laporannya.laporanpemasangan', compact('laporanpemasangan'));
     }


     public function laporanpemasanganpdf(Request $request )
     {
         $startDate = session('filter_start_date');
         $endDate = session('filter_end_date');

         if ($startDate == '' && $endDate == '') {
             $laporanpemasangan = Pemasangan::all();
         } else {
             $laporanpemasangan = Pemasangan::whereDate('tanggal', '>=', $startDate)
                                             ->whereDate('tanggal', '<=', $endDate)
                                             ->get();
         }

         // Render view dengan menyertakan data laporan dan informasi filter
         $pdf = PDF::loadview('laporannya.laporanpemasanganpdf', compact('laporanpemasangan'));
         return $pdf->download('laporan_laporanpemasangan.pdf');
     }
}

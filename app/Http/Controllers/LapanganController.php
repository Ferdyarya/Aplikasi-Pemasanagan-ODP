<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Lapangan;
use App\Models\Masteralat;
use App\Models\Masterclient;
use Illuminate\Http\Request;
use App\Models\Masterteknisi;

class LapanganController extends Controller
{
    public function index(Request $request)
{
    if ($request->has('search')) {
        $lapangan = Lapangan::whereHas('masterteknisi', function($query) use ($request) {
            $query->where('nama', 'LIKE', '%' . $request->search . '%');
        })->paginate(10);
    } else {
        $lapangan = Lapangan::paginate(10);
    }

    return view('lapangan.index', [
        'lapangan' => $lapangan
    ]);
}


public function create()
{
    $masterclient = Masterclient::all();
    $masteralat = Masteralat::all();
    $masterteknisi = Masterteknisi::all();

    return view('lapangan.create', [
        'masterclient' => $masterclient,
        'masteralat' => $masteralat,
        'masterteknisi' => $masterteknisi,
    ]);
}

public function store(Request $request)
{
    // Validasi permintaan
    // $request->validate([
    //     'id_masterrumahkaca' => 'required|string',
    //     'tanggal' => 'required|date',
    //     'deskripsi' => 'required|string',
    //     'keperluandana' => 'required|numeric',
    // ]);

    $data = $request->all();

    // dd($data);

    Lapangan::create($data);

    return redirect()->route('lapangan.index')->with('success', 'Data telah ditambahkan');
}



    public function show($id)
    {

    }


    public function edit(Lapangan $lapangan)
    {
        $masterclient = Masterclient::all();
        $masteralat = Masteralat::all();
        $masterteknisi = Masterteknisi::all();

        return view('lapangan.edit', [
            'item' => $lapangan,
            'masterclient' => $masterclient,
            'masteralat' => $masteralat,
            'masterteknisi' => $masterteknisi,
        ]);
    }


    public function update(Request $request, Lapangan $lapangan)
    {
        $data = $request->all();

        $lapangan->update($data);

        //dd($data);

        return redirect()->route('lapangan.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Lapangan $lapangan)
    {
        $lapangan->delete();
        return redirect()->route('lapangan.index')->with('success', 'Data Telah dihapus');
    }

    //Approval Status
//     public function updateStatusRawat(Request $request, $id)
// {
//     $validated = $request->validate([
//         'status' => 'required|in:Terverifikasi,Ditolak',
//     ]);

//     $lapangan = lapangan::findOrFail($id);

//     $lapangan->status = $validated['status'];
//     $lapangan->save();

//     return redirect()->route('lapangan.index')->with('success', 'Status surat berhasil diperbarui.');
// }













    //Report
    //  Laporan Buku lapangan Filter
     public function cetaklapanganpertanggal()
     {
         $lapangan = Lapangan::Paginate(10);

         return view('laporannya.laporanlapangan', ['laporanlapangan' => $lapangan]);
     }

     public function filterdatelapangan(Request $request)
     {
         $startDate = $request->input('dari');
         $endDate = $request->input('sampai');

          if ($startDate == '' && $endDate == '') {
             $laporanlapangan = Lapangan::paginate(10);
         } else {
             $laporanlapangan = Lapangan::whereDate('tanggal','>=',$startDate)
                                         ->whereDate('tanggal','<=',$endDate)
                                         ->paginate(10);
         }
         session(['filter_start_date' => $startDate]);
         session(['filter_end_date' => $endDate]);

         return view('laporannya.laporanlapangan', compact('laporanlapangan'));
     }


     public function laporanlapanganpdf(Request $request )
     {
         $startDate = session('filter_start_date');
         $endDate = session('filter_end_date');

         if ($startDate == '' && $endDate == '') {
             $laporanlapangan = Lapangan::all();
         } else {
             $laporanlapangan = Lapangan::whereDate('tanggal', '>=', $startDate)
                                             ->whereDate('tanggal', '<=', $endDate)
                                             ->get();
         }

         // Render view dengan menyertakan data laporan dan informasi filter
         $pdf = PDF::loadview('laporannya.laporanlapanganpdf', compact('laporanlapangan'));
         return $pdf->download('laporan_laporanlapangan.pdf');
     }
}

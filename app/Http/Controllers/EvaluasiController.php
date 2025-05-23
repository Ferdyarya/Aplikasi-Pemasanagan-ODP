<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Evaluasi;
use Illuminate\Http\Request;
use App\Models\Masterteknisi;

class EvaluasiController extends Controller
{
    public function index(Request $request)
{
    if ($request->has('search')) {
        $evaluasi = Evaluasi::whereHas('masterteknisi', function($query) use ($request) {
            $query->where('nama', 'LIKE', '%' . $request->search . '%');
        })->paginate(10);
    } else {
        $evaluasi = Evaluasi::paginate(10);
    }

    return view('evaluasi.index', [
        'evaluasi' => $evaluasi
    ]);
}


    public function create()
{
    $masterteknisi = Masterteknisi::all();

    return view('evaluasi.create', [
        'masterteknisi' => $masterteknisi,
    ]);
}

public function store(Request $request)
{

    $data = $request->all();
    // dd($data);
    Evaluasi::create($data);

    return redirect()->route('evaluasi.index')->with('success', 'Data telah ditambahkan');
}



    public function show($id)
    {

    }


    public function edit(Evaluasi $evaluasi)
    {
        $masterteknisi = Masterteknisi::all();

        return view('evaluasi.edit', [
            'item' => $evaluasi,
            'masterteknisi' => $masterteknisi,
        ]);
    }


    public function update(Request $request, Evaluasi $evaluasi)
    {
        $data = $request->all();

        $evaluasi->update($data);

        //dd($data);

        return redirect()->route('evaluasi.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Evaluasi $evaluasi)
    {
        $evaluasi->delete();
        return redirect()->route('evaluasi.index')->with('success', 'Data Telah dihapus');
    }

    //Approval Status
//     public function updateStatusLokasi(Request $request, $id)
// {
//     $validated = $request->validate([
//         'status' => 'required|in:Terverifikasi,Ditolak',
//     ]);

//     $evaluasi = Evaluasi::findOrFail($id);

//     $evaluasi->status = $validated['status'];
//     $evaluasi->save();

//     return redirect()->route('evaluasi.index')->with('success', 'Status surat berhasil diperbarui.');
// }













    //Report
    //  Laporan Buku evaluasi Filter
     public function cetakevaluasipertanggal()
     {
         $evaluasi = Evaluasi::Paginate(10);

         return view('laporannya.laporanevaluasi', ['laporanevaluasi' => $evaluasi]);
     }

     public function filterdateevaluasi(Request $request)
     {
         $startDate = $request->input('dari');
         $endDate = $request->input('sampai');

          if ($startDate == '' && $endDate == '') {
             $laporanevaluasi = Evaluasi::paginate(10);
         } else {
             $laporanevaluasi = Evaluasi::whereDate('tanggal','>=',$startDate)
                                         ->whereDate('tanggal','<=',$endDate)
                                         ->paginate(10);
         }
         session(['filter_start_date' => $startDate]);
         session(['filter_end_date' => $endDate]);

         return view('laporannya.laporanevaluasi', compact('laporanevaluasi'));
     }


     public function laporanevaluasipdf(Request $request )
     {
         $startDate = session('filter_start_date');
         $endDate = session('filter_end_date');

         if ($startDate == '' && $endDate == '') {
             $laporanevaluasi = Evaluasi::all();
         } else {
             $laporanevaluasi = Evaluasi::whereDate('tanggal', '>=', $startDate)
                                             ->whereDate('tanggal', '<=', $endDate)
                                             ->get();
         }

         // Render view dengan menyertakan data laporan dan informasi filter
         $pdf = PDF::loadview('laporannya.laporanevaluasipdf', compact('laporanevaluasi'));
         return $pdf->download('laporan_laporanevaluasi.pdf');
     }
}

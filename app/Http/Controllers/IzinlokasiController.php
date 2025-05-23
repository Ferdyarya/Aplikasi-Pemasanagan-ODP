<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Izinlokasi;
use Illuminate\Http\Request;
use App\Models\Masterteknisi;

class IzinlokasiController extends Controller
{
    public function index(Request $request)
{
    if ($request->has('search')) {
        $izinlokasi = Izinlokasi::whereHas('masterteknisi', function($query) use ($request) {
            $query->where('nama', 'LIKE', '%' . $request->search . '%');
        })->paginate(10);
    } else {
        $izinlokasi = izinlokasi::paginate(10);
    }

    return view('izinlokasi.index', [
        'izinlokasi' => $izinlokasi
    ]);
}


    public function create()
{
    $masterteknisi = Masterteknisi::all();

    return view('izinlokasi.create', [
        'masterteknisi' => $masterteknisi,
    ]);
}

public function store(Request $request)
{

    $data = $request->all();
    // dd($data);
    izinlokasi::create($data);

    return redirect()->route('izinlokasi.index')->with('success', 'Data telah ditambahkan');
}



    public function show($id)
    {

    }


    public function edit(izinlokasi $izinlokasi)
    {
        $masterteknisi = Masterteknisi::all();

        return view('izinlokasi.edit', [
            'item' => $izinlokasi,
            'masterteknisi' => $masterteknisi,
        ]);
    }


    public function update(Request $request, izinlokasi $izinlokasi)
    {
        $data = $request->all();

        $izinlokasi->update($data);

        //dd($data);

        return redirect()->route('izinlokasi.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(izinlokasi $izinlokasi)
    {
        $izinlokasi->delete();
        return redirect()->route('izinlokasi.index')->with('success', 'Data Telah dihapus');
    }

    //Approval Status
    public function updateStatusLokasi(Request $request, $id)
{
    $validated = $request->validate([
        'status' => 'required|in:Terverifikasi,Ditolak',
    ]);

    $izinlokasi = izinlokasi::findOrFail($id);

    $izinlokasi->status = $validated['status'];
    $izinlokasi->save();

    return redirect()->route('izinlokasi.index')->with('success', 'Status surat berhasil diperbarui.');
}













    //Report
    //  Laporan Buku izinlokasi Filter
     public function cetakizinlokasipertanggal()
     {
         $izinlokasi = izinlokasi::Paginate(10);

         return view('laporannya.laporanizinlokasi', ['laporanizinlokasi' => $izinlokasi]);
     }

     public function filterdatelokasi(Request $request)
     {
         $startDate = $request->input('dari');
         $endDate = $request->input('sampai');

          if ($startDate == '' && $endDate == '') {
             $laporanizinlokasi = izinlokasi::paginate(10);
         } else {
             $laporanizinlokasi = izinlokasi::whereDate('tanggal','>=',$startDate)
                                         ->whereDate('tanggal','<=',$endDate)
                                         ->paginate(10);
         }
         session(['filter_start_date' => $startDate]);
         session(['filter_end_date' => $endDate]);

         return view('laporannya.laporanizinlokasi', compact('laporanizinlokasi'));
     }


     public function laporanizinlokasipdf(Request $request )
     {
         $startDate = session('filter_start_date');
         $endDate = session('filter_end_date');

         if ($startDate == '' && $endDate == '') {
             $laporanizinlokasi = izinlokasi::all();
         } else {
             $laporanizinlokasi = izinlokasi::whereDate('tanggal', '>=', $startDate)
                                             ->whereDate('tanggal', '<=', $endDate)
                                             ->get();
         }

         // Render view dengan menyertakan data laporan dan informasi filter
         $pdf = PDF::loadview('laporannya.laporanizinlokasipdf', compact('laporanizinlokasi'));
         return $pdf->download('laporan_laporanizinlokasi.pdf');
     }
}

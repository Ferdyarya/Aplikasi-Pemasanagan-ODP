<?php

namespace App\Http\Controllers;

use App\Models\Jaringan;
use Illuminate\Http\Request;

class JaringanController extends Controller
{
    public function index(Request $request)
{
    if ($request->has('search')) {
        $jaringan = Jaringan::whereHas('masterteknisi', function($query) use ($request) {
            $query->where('nama', 'LIKE', '%' . $request->search . '%');
        })->paginate(10);
    } else {
        $jaringan = Jaringan::paginate(10);
    }

    return view('jaringan.index', [
        'jaringan' => $jaringan
    ]);
}


public function create()
{
    $masterclient = Masterclient::all();
    $masterteknisi = Masterteknisi::all();

    return view('jaringan.create', [
        'masterclient' => $masterclient,
        'masterteknisi' => $masterteknisi,
    ]);
}

public function store(Request $request)
{
    $data = Jaringan::create($request->all());
        if($request->hasFile('fotohasil')) {
            $request->file('fotohasil')->move('fotohasil/', $request->file('fotohasil')->getClientOriginalName());
            $data->fotohasil = $request->file('fotohasil')->getClientOriginalName();
            $data->save();
        }
    // Ambil data terakhir dari tabel jaringan
    $lastjaringan = Jaringan::orderBy('id', 'desc')->first();

    // Generate nomor jaringan
    if (!$lastjaringan) {
        $nopemasangan = 'PSG-0001';
    } else {
        $lastNumber = (int) substr($lastjaringan->nopemasangan, -4);
        $nextNumber = $lastNumber + 1;
        $nopemasangan = 'PSG-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    // Ambil semua data dari request
    $data = $request->all();

    // Tambahkan nomor jaringan ke dalam data
    $data['nopemasangan'] = $nopemasangan;

    // Simpan ke database
    Jaringan::create($data);


    return redirect()->route('jaringan.index')->with('success', 'Data telah ditambahkan');
}




    public function show($id)
    {

    }


    public function edit(Jaringan $jaringan)
    {
        $masterclient = Masterclient::all();
        $masterteknisi = Masterteknisi::all();

        return view('jaringan.edit', [
            'item' => $jaringan,
            'masterclient' => $masterclient,
            'masterteknisi' => $masterteknisi,
        ]);
    }


    public function update(Request $request, Jaringan $jaringan)
    {
        $data = $request->all();

        $jaringan->update($data);

        //dd($data);

        return redirect()->route('jaringan.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Jaringan $jaringan)
    {
        $jaringan->delete();
        return redirect()->route('jaringan.index')->with('success', 'Data Telah dihapus');
    }

    //Approval Status
//     public function updateStatusJaringan(Request $request, $id)
// {
//     $validated = $request->validate([
//         'status' => 'required|in:Terpasang,Terkendala',
//     ]);

//     $jaringan = Jaringan::findOrFail($id);

//     $jaringan->status = $validated['status'];
//     $jaringan->save();

//     return redirect()->route('jaringan.index')->with('success', 'Status surat berhasil diperbarui.');
// }













    //Report
    //  Laporan Buku jaringan Filter
     public function cetakpasangpertanggal()
     {
         $jaringan = Jaringan::Paginate(10);

         return view('laporannya.laporanjaringan', ['laporanjaringan' => $jaringan]);
     }

     public function filterdatepasang(Request $request)
     {
         $startDate = $request->input('dari');
         $endDate = $request->input('sampai');

          if ($startDate == '' && $endDate == '') {
             $laporanjaringan = Jaringan::paginate(10);
         } else {
             $laporanjaringan = Jaringan::whereDate('tanggal','>=',$startDate)
                                         ->whereDate('tanggal','<=',$endDate)
                                         ->paginate(10);
         }
         session(['filter_start_date' => $startDate]);
         session(['filter_end_date' => $endDate]);

         return view('laporannya.laporanjaringan', compact('laporanjaringan'));
     }


     public function laporanjaringanpdf(Request $request )
     {
         $startDate = session('filter_start_date');
         $endDate = session('filter_end_date');

         if ($startDate == '' && $endDate == '') {
             $laporanjaringan = Jaringan::all();
         } else {
             $laporanjaringan = Jaringan::whereDate('tanggal', '>=', $startDate)
                                             ->whereDate('tanggal', '<=', $endDate)
                                             ->get();
         }

         // Render view dengan menyertakan data laporan dan informasi filter
         $pdf = PDF::loadview('laporannya.laporanjaringanpdf', compact('laporanjaringan'));
         return $pdf->download('laporan_laporanjaringan.pdf');
     }
}

<?php

namespace App\Http\Controllers;


use PDF;
use App\Models\Kerusakan;
use App\Models\Masteralat;
use Illuminate\Http\Request;

class KerusakanController extends Controller
{
    public function index(Request $request)
{
    if ($request->has('search')) {
        $kerusakan = Kerusakan::whereHas('masteralat', function($query) use ($request) {
            $query->where('nama', 'LIKE', '%' . $request->search . '%');
        })->paginate(10);
    } else {
        $kerusakan = Kerusakan::paginate(10);
    }

    return view('kerusakan.index', [
        'kerusakan' => $kerusakan
    ]);
}


    public function create()
{
    $masteralat = Masteralat::all();

    return view('kerusakan.create', [
        'masteralat' => $masteralat,
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

    Kerusakan::create($data);

    return redirect()->route('kerusakan.index')->with('success', 'Data telah ditambahkan');
}



    public function show($id)
    {

    }


    public function edit(Kerusakan $kerusakan)
    {
        $masteralat = Masteralat::all();

        return view('kerusakan.edit', [
            'item' => $kerusakan,
            'masteralat' => $masteralat,
        ]);
    }


    public function update(Request $request, Kerusakan $kerusakan)
    {
        $data = $request->all();

        $kerusakan->update($data);

        //dd($data);

        return redirect()->route('kerusakan.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Kerusakan $kerusakan)
    {
        $kerusakan->delete();
        return redirect()->route('kerusakan.index')->with('success', 'Data Telah dihapus');
    }

    //Approval Status
//     public function updateStatusRawat(Request $request, $id)
// {
//     $validated = $request->validate([
//         'status' => 'required|in:Terverifikasi,Ditolak',
//     ]);

//     $kerusakan = kerusakan::findOrFail($id);

//     $kerusakan->status = $validated['status'];
//     $kerusakan->save();

//     return redirect()->route('kerusakan.index')->with('success', 'Status surat berhasil diperbarui.');
// }













    //Report
    //  Laporan Buku kerusakan Filter
     public function cetakkerusakanpertanggal()
     {
         $kerusakan = Kerusakan::Paginate(10);

         return view('laporannya.laporankerusakan', ['laporankerusakan' => $kerusakan]);
     }

     public function filterdatekerusakan(Request $request)
     {
         $startDate = $request->input('dari');
         $endDate = $request->input('sampai');

          if ($startDate == '' && $endDate == '') {
             $laporankerusakan = Kerusakan::paginate(10);
         } else {
             $laporankerusakan = Kerusakan::whereDate('tanggal','>=',$startDate)
                                         ->whereDate('tanggal','<=',$endDate)
                                         ->paginate(10);
         }
         session(['filter_start_date' => $startDate]);
         session(['filter_end_date' => $endDate]);

         return view('laporannya.laporankerusakan', compact('laporankerusakan'));
     }


     public function laporankerusakanpdf(Request $request )
     {
         $startDate = session('filter_start_date');
         $endDate = session('filter_end_date');

         if ($startDate == '' && $endDate == '') {
             $laporankerusakan = Kerusakan::all();
         } else {
             $laporankerusakan = Kerusakan::whereDate('tanggal', '>=', $startDate)
                                             ->whereDate('tanggal', '<=', $endDate)
                                             ->get();
         }

         // Render view dengan menyertakan data laporan dan informasi filter
         $pdf = PDF::loadview('laporannya.laporankerusakanpdf', compact('laporankerusakan'));
         return $pdf->download('laporan_laporankerusakan.pdf');
     }
}

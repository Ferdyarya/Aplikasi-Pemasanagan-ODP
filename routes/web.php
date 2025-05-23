<?php

use App\Models\Sewarumahkaca;
use App\Models\Masterrumahkaca;
use App\Models\Pembangunanrumahkaca;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\JaringanController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\IzinlokasiController;
use App\Http\Controllers\MasteralatController;
use App\Http\Controllers\PemasanganController;
use App\Http\Controllers\PergantianController;
use App\Http\Controllers\MasterclientController;
use App\Http\Controllers\MasterteknisiController;
use App\Http\Controllers\SewarumahkacaController;
use App\Http\Controllers\MasterrumahkacaController;
use App\Http\Controllers\PembangunanrumahkacaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // $penyewacount = Sewarumahkaca::count();
    // $totalrumahcount = Masterrumahkaca::count();
    // $pembangunancount = Pembangunanrumahkaca::count();
    // $perawatancount = Rawatrumahkaca::count();


    return view('dashboard');
})->middleware('auth');


Route::prefix('dashboard')->middleware(['auth:sanctum'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::resource('masterrumahkaca', MasterrumahkacaController::class);
    Route::resource('masterclient', MasterclientController::class);
    Route::resource('masteralat', MasteralatController::class);
    Route::resource('masterteknisi', MasterteknisiController::class);

    // Data Tables Surat
    Route::resource('izinlokasi', IzinlokasiController::class);
    Route::resource('pemasangan', PemasanganController::class);
    Route::resource('kerusakan', KerusakanController::class);
    Route::resource('perbaikan', PerbaikanController::class);
    Route::resource('lapangan', LapanganController::class);
    Route::resource('evaluasi', EvaluasiController::class);
    Route::resource('jaringan', JaringanController::class);
    Route::resource('pergantian', PergantianController::class);

    // Route::resource('sewarumahkaca', SewarumahkacaController::class);
    // Route::resource('pembangunanrumahkaca', PembangunanrumahkacaController::class);

    // Report
    // Izin Masuk Lokasi
    Route::get('laporannya/laporanizinlokasi', [IzinlokasiController::class, 'cetakizinlokasipertanggal'])->name('laporanizinlokasi');
    Route::get('laporanizinlokasi', [IzinlokasiController::class, 'filterdatelokasi'])->name('laporanizinlokasi');
    Route::get('laporanizinlokasipdf/filter={filter}', [IzinlokasiController::class, 'laporanizinlokasipdf'])->name('laporanizinlokasipdf');

    // Pemasangan
    Route::get('laporannya/laporanpemasangan', [PemasanganController::class, 'cetakpasangpertanggal'])->name('laporanpemasangan');
    Route::get('laporanpemasangan', [PemasanganController::class, 'filterdatepasang'])->name('laporanpemasangan');
    Route::get('laporanpemasanganpdf/filter={filter}', [PemasanganController::class, 'laporanpemasanganpdf'])->name('laporanpemasanganpdf');

    // Kerusakan
    Route::get('laporannya/laporanKerusakan', [KerusakanController::class, 'cetakkerusakanpertanggal'])->name('laporankerusakan');
    Route::get('laporankerusakan', [KerusakanController::class, 'filterdatekerusakan'])->name('laporankerusakan');
    Route::get('laporankerusakanpdf/filter={filter}', [KerusakanController::class, 'laporankerusakanpdf'])->name('laporankerusakanpdf');

    // Perbaikan
    Route::get('laporannya/laporanperbaikan', [PerbaikanController::class, 'cetakperbaikanpertanggal'])->name('laporanperbaikan');
    Route::get('laporanperbaikan', [PerbaikanController::class, 'filterdateperbaikan'])->name('laporanperbaikan');
    Route::get('laporanperbaikanpdf/filter={filter}', [PerbaikanController::class, 'laporanperbaikanpdf'])->name('laporanperbaikanpdf');

    // lapangan
    Route::get('laporannya/laporanlapangan', [LapanganController::class, 'cetaklapanganpertanggal'])->name('laporanlapangan');
    Route::get('laporanlapangan', [LapanganController::class, 'filterdatelapangan'])->name('laporanlapangan');
    Route::get('laporanlapanganpdf/filter={filter}', [LapanganController::class, 'laporanlapanganpdf'])->name('laporanlapanganpdf');

    // New
    // Evaluasi
    Route::get('laporannya/laporanevaluasi', [EvaluasiController::class, 'cetakevaluasipertanggal'])->name('laporanevaluasi');
    Route::get('laporanevaluasi', [EvaluasiController::class, 'filterdateevaluasi'])->name('laporanevaluasi');
    Route::get('laporanevaluasipdf/filter={filter}', [EvaluasiController::class, 'laporanevaluasipdf'])->name('laporanevaluasipdf');

    // Jaringan
    Route::get('laporannya/laporanjaringan', [JaringanController::class, 'cetakjaringanpertanggal'])->name('laporanjaringan');
    Route::get('laporanjaringan', [JaringanController::class, 'filterdatejaringan'])->name('laporanjaringan');
    Route::get('laporanjaringanpdf/filter={filter}', [JaringanController::class, 'laporanjaringanpdf'])->name('laporanjaringanpdf');

    // Pergantian
    Route::get('laporannya/laporanpergantian', [PergantianController::class, 'cetakpergantianpertanggal'])->name('laporanpergantian');
    Route::get('laporanpergantian', [PergantianController::class, 'filterdatepergantian'])->name('laporanpergantian');
    Route::get('laporanpergantianpdf/filter={filter}', [PergantianController::class, 'laporanpergantianpdf'])->name('laporanpergantianpdf');




    // Sewa Rumah Kaca
    // Route::get('laporannya/laporansewarumahkaca', [SewarumahkacaController::class, 'cetakrumahkacapertanggal'])->name('laporansewarumahkaca');
    // Route::get('laporansewarumahkaca', [SewarumahkacaController::class, 'filterdaterumahkaca'])->name('laporansewarumahkaca');
    // Route::get('laporansewarumahkacapdf/filter={filter}', [SewarumahkacaController::class, 'laporansewarumahkacapdf'])->name('laporansewarumahkacapdf');

    //Pernama
    Route::get('laporannya/pernama', [SewarumahkacaController::class, 'pernama'])->name('pernama');
    Route::get('/pernamapdf', [SewarumahkacaController::class, 'cetakPernamaPdf'])->name('pernamapdf');
    //Perkategorirumah
    Route::get('laporannya/perkategori', [SewarumahkacaController::class, 'perkategori'])->name('perkategori');
    Route::get('/perkategoripdf', [SewarumahkacaController::class, 'cetakPerkategoriPdf'])->name('perkategoripdf');

    // Pembangunan Rumah Kaca
    Route::get('laporannya/laporanpembangunanrumahkaca', [PembangunanrumahkacaController::class, 'cetakpembangunanpertanggal'])->name('laporanpembangunanrumahkaca');
    Route::get('laporanpembangunanrumahkaca', [PembangunanrumahkacaController::class, 'filterdatepembangunan'])->name('laporanpembangunanrumahkaca');
    Route::get('laporanpembangunanrumahkacapdf/filter={filter}', [PembangunanrumahkacaController::class, 'laporanpembangunanrumahkacapdf'])->name('laporanpembangunanrumahkacapdf');

    // Status Route
    Route::put('/izinlokasi/{id}/status', [IzinlokasiController::class, 'updateStatusLokasi'])->name('updateStatusLokasi');
    Route::put('/pembangunanrumahkaca/{id}/status', [PembangunanrumahkacaController::class, 'updateStatus'])->name('updateStatus');
    // Pembangunan Rumah Kaca



    // Verifikasi Di Master Data surat
    // Route::put('/items/{id}/verify', [MasteranggotaController::class, 'verify'])->name('items.verify');






// Data Tables Report Report
// Route::get('suratdisposisipdf', [SuratdisposisiController::class, 'suratdisposisipdf'])->name('suratdisposisipdf');

// Rute untuk menampilkan laporan anggota
// Route::get('laporannya/laporananggota', [MasteranggotaController::class, 'perkelas'])->name('laporananggota');

// Rute untuk mengekspor PDF
// Route::get('/perkelaspdf', [MasteranggotaController::class, 'cetakPerkelasPdf'])->name('laporananggotapdf');

// Recap Laporan Tampilan
// Route::get('laporannya/laporanpeminjaman', [SuratdisposisiController::class, 'cetakpertanggalpengembalian'])->name('laporanpeminjaman');

// Filtering
// Route::get('laporanpeminjaman', [SuratdisposisiController::class, 'filterdatebarang'])->name('laporanpeminjaman');


// Filter Laporan
// Route::get('laporandendapdf/filter={filter}', [SuratdisposisiController::class, 'laporandendapdf'])->name('laporandendapdf');


});



// Login Register
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/loginuser', [LoginController::class, 'loginuser'])->name('loginuser');









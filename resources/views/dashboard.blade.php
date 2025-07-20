@extends('layout.admin')

@section('content')
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
      data-sidebar-position="fixed" data-header-position="fixed">

      <div class="container-fluid">
        <!-- Row 1: Dashboard Cards -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h3 class="card-title"><b>Laporan Hari Ini</b></h3>
                        {{-- {{ $dateNow->format('d F Y') }} --}}
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6 col-md-3">
                                <h4 class="text-black"><b>Jumlah Pemasangan</b></h4>
                                <h3>{{$pemasangancount}}</h3>
                            </div>
                            <div class="col-6 col-md-3">
                                <h4 class="text-black"><b>Jumlah Perbaikan</b></h4>
                                <h3>{{$perbaikancount}}</h3>
                            </div>
                            <div class="col-6 col-md-3">
                                <h4 class="text-black"><b>Jumlah Kerusakan</b></h4>
                                <h3>{{$kerusakancount}}</h3>
                            </div>
                            <div class="col-6 col-md-3">
                                <h4 class="text-black"><b>Jumlah Pemasangan Jaringan</b></h4>
                                <h3>{{$jaringancount}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-4 col-sm-12 mb-4">
                <div class="card">
                    <img src="assets/rumahkaca.jpg" class="card-img-top" width="140px" alt="ODP">
                    <div class="card-body text-center">
                        <h4>ODP</h4>
                    </div>
                </div>
            </div>

            <!-- Kerusakan -->
            <div class="col-lg-4 col-sm-12 mb-4">
                <div class="card">
                    <img src="assets/rumahkaca.jpg" class="card-img-top" alt="ODP">
                    <div class="card-body text-center">
                        <h4>OTP</h4>
                    </div>
                </div>
            </div>
            <!-- Perbaikan -->
            <div class="col-lg-4 col-sm-12 mb-4">
                <div class="card">
                    <img src="assets/rumahkaca.jpg" class="card-img-top" alt="ODP">
                    <div class="card-body text-center">
                        <h4>OOP</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

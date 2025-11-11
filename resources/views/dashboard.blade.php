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
                                    <h3>{{ $pemasangancount }}</h3>
                                </div>
                                <div class="col-6 col-md-3">
                                    <h4 class="text-black"><b>Jumlah Perbaikan</b></h4>
                                    <h3>{{ $perbaikancount }}</h3>
                                </div>
                                <div class="col-6 col-md-3">
                                    <h4 class="text-black"><b>Jumlah Kerusakan</b></h4>
                                    <h3>{{ $kerusakancount }}</h3>
                                </div>
                                <div class="col-6 col-md-3">
                                    <h4 class="text-black"><b>Jumlah Pemasangan Jaringan</b></h4>
                                    <h3>{{ $jaringancount }}</h3>
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

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h3 class="card-title"><b>Diagram Pemasangan vs Kerusakan Per Hari</b></h3>
                        </div>
                        <div class="card-body">
                            <canvas id="pemasanganKerusakanChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tambahkan Chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const ctx = document.getElementById('pemasanganKerusakanChart').getContext('2d');

                const labels = {!! json_encode($tanggalPerHari) !!};
                const pemasanganData = {!! json_encode($pemasanganPerHari) !!};
                const kerusakanData = {!! json_encode($kerusakanPerHari) !!};

                const data = {
                    labels: labels,
                    datasets: [{
                            label: 'Pemasangan',
                            data: pemasanganData,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Kerusakan',
                            data: kerusakanData,
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                };

                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'JUMLAH'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'TANGGAL',
                                    font: {
                                        weight: 'bold' // membuat teks menjadi bold
                                    }
                                }
                            }
                        }
                    }
                };

                new Chart(ctx, config);
            </script>
        </div>
    </div>
@endsection

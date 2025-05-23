@extends('layout.admin')

@section('content')


<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

<!-- Select2 CSS -->
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<title>Data Pemasangan Jaringan</title>


<body>
    <div class="container-fluid">
        <div class="card">
          <div class="card-body" style="border-radius: 15px;">
              <h1 class="text-center mb-4">Edit Data Pemasangan Jaringan</h1>
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-8">
                          <div class="card" style="border-radius: 10px;">
                              <div class="card-body">
                                <form method="POST" action="{{ route('jaringan.update', $item->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group mb-3">
                                        <label for="id_masterclient">Client</label>
                                        <select class="form-select" name="id_masterclient" id="alat" style="border-radius: 8px;" data-placeholder="Pilih alat">
                                            <option></option>
                                            @foreach ($masterclient as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="id_masterteknisi">Teknisi</label>
                                        <select class="form-select" name="id_masterteknisi" id="teknisi" style="border-radius: 8px;" data-placeholder="Pilih Teknisi">
                                            <option></option>
                                            @foreach ($masterteknisi as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input value="{{ $item->tanggal }}" type="date" name="tanggal" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input value="{{ $item->alamat }}" type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <input value="{{ $item->catatan }}" type="text" name="catatan" class="form-control" placeholder="Masukkan Catatan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="statuspasang">Status Pasang</label>
                                        <select name="statuspasang" class="form-control" required>
                                            <option value="Berhasil terpasang" {{ $item->statuspasang == 'Berhasil terpasang' ? 'selected' : '' }}>Berhasil terpasang</option>
                                            <option value="Terkendala" {{ $item->statuspasang == 'Terkendala' ? 'selected' : '' }}>Terkendala</option>
                                            <option value="Batal dipasang" {{ $item->statuspasang == 'Batal dipasang' ? 'selected' : '' }}>Batal dipasang</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="fotohasil">Masukan Foto Hasil</label>
                                        @if ($item->fotohasil)
                                            <div class="mb-2">
                                                <img src="{{ asset('fotohasil/' . $item->fotohasil) }}" alt="Foto Hasil" width="150">
                                            </div>
                                        @endif
                                        <input type="file" name="fotohasil" class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
</body>

























<!-- Optional JavaScript Select2 -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV7YyybLOtiN6bX3h+rXxy5lVX" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+pyRy4IhBQvqo8Rx2ZR1c8KRjuva5V7x8GA" crossorigin="anonymous">
</script>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$( '#alat' ).select2( {
theme: "bootstrap-5",
width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
placeholder: $( this ).data( 'placeholder' ),
} );
$( '#teknisi' ).select2( {
theme: "bootstrap-5",
width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
placeholder: $( this ).data( 'placeholder' ),
} );
</script>
@endsection

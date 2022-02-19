@extends('template')

@section('main')
    <div id="siswa">
        <h2>Tambah Siswa</h2>

        <!-- Form Metode Html atau bukan bawaan Laravel -->
        <!-- <form action="{{ url('siswa') }}" method="POST">
           @csrf
            <div class="form-group">
                <label for="nisn" class="control-label">NISN</label>
                <input type="text" name="nisn" id="nisn" class="form-control">
            </div>
            <div class="form-group">
                <label for="nama_siswa" class="control-label">Nama</label>
                <input type="text" name="nama_siswa" id="nama_siswa" class="form-control">
            </div>
            <div class="form-group">
                <label for="tanggal_lahir" class="control-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
            </div>
            <div class="form-group">
                <label for="jenis_kelamin" class="control-label">Jenis Kelamin</label>
                <div class="radio">
                    <label><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="L">Laki_laki</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="P">Perempuan</label>
                </div>
            </div>
            <div class="form-group">
                <input class="btn btn-primary form-control" type="submit" value="Simpan">
            </div>
        </form> -->

        {!! Form::open(['url' => 'siswa', 'files' => true]) !!}
            @include('siswa.form', ['SubmitButtonText' => 'Simpan'])
        {!! Form::close() !!}

    </div>
@endsection

@section('footer')
    @include('footer')
@endsection

@extends('template')

@section('main')
    <div id="siswa">
        <h2>Siswa</h2>

        @include('_partial.flash_message')

        @include('siswa.form_pencarian')

        @if (!empty($siswa_list))
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <td>NISN</td>
                        <td>Nama</td>
                        <td>Kelas</td>
                        <td>Tanggal Lahir</td>
                        <td>Jenis Kelamin</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswa_list as $siswa)
                        <tr>

                            <td>{{ $siswa->nisn }} </td>
                            <td>{{ $siswa->nama_siswa }} </td>
                            <td>{{ $siswa->kelas->nama_kelas }} </td>
                            <td>{{ $siswa->tanggal_lahir->format('d-m-Y') }} </td>
                            <td>{{ $siswa->jenis_kelamin == 'L'  ?  'Laki-Laki' : 'Perempuan'}}</td>
                            <td>{{ !empty($siswa->telepon->nomor_telepon) ? $siswa->telepon->nomor_telepon : '-'}}</td>
                            <td>
                                <!--<a href="siswa/{{$siswa->id}}" class="btn btn-success btn-sm">Detail</a>
                                <a href="siswa/{{$siswa->id}}/edit" class="btn btn-warning btn-sm">Edit</a> -->
                                <div class="box-button">
                                    {!! link_to('siswa/'. $siswa->id, 'Detail', ['class' => 'btn btn-success btn-sm']) !!}
                                </div>
                                @if (Auth::check())
                                <div class="box-button">
                                    {!! link_to('siswa/'. $siswa->id .'/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) !!}
                                </div>
                                <div class="box-button">
                                    {!! Form::open(['method' => 'DELETE', 'action' => ['SiswaController@destroy', $siswa->id]]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </div>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data siswa</p>
        @endif

        <div class="table-nav">
            <div class="jumlah-data">
                <strong>jumlah Siswa : {{  $jumlah_siswa }} </strong>
            </div>
            <div class="paging">
                {{ $siswa_list->links() }}
            </div>
        </div>

        @if (Auth::check())
        <div class="tombol-nav">
            <div>
                <a href="{{ url('siswa/create') }} " class="btn btn-primary">Tambah Siswa</a>
            </div>
        </div>
        @endif

    </div>
@stop

@section('footer')
    @include('footer')
@stop

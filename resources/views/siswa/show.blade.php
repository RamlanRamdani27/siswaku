@extends('template')

@section('main')
    <div id="siswa">
        <h2>Detail Siswa</h2>

        <table class="table table-striped">
            <tr>
                <td>NISN</td>
                <td>{{ $siswa->nisn }} </td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>{{ $siswa->nama_siswa }} </td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>{{ $siswa->kelas->nama_kelas }} </td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>{{ $siswa->tanggal_lahir->format('d-m-Y') }} </td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>{{ $siswa->jenis_kelamin }} </td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>{{ !empty($siswa->telepon->nomor_telepon) ? $siswa->telepon->nomor_telepon : '-'}}</td>
            </tr>
            <tr>
                <td>Hobi</td>
                <td>
                    @foreach ($siswa->hobi as $item)
                        <span>{{ $item->nama_hobi }} </span>,
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Foto</td>
                <td>
                    @if ($siswa->foto)
                        <img src="{{ asset('fotoupload/'.$siswa->foto) }} ">
                    @else
                        @if ($siswa->jenis_kelamin == 'L')
                            <img src="{{ asset('fotoupload/dummymale.png') }} ">
                        @else
                            <img src="{{ asset('fotoupload/dummyfemale.png') }} ">
                        @endif
                    @endif
                </td>

            </tr>
        </table>

    </div>
@endsection

@section('footer')
    @include('footer')
@stop

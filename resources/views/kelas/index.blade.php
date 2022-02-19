@extends('template')

@section('main')
    <div id="kelas">
        <h2>Kelas</h2>

        @include('_partial.flash_message')

        @if (!empty($kelas_list))
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Kelas</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach($kelas_list as $kelas)
                        <tr>
                            <td>{{ ++$i }} </td>
                            <td>{{ $kelas->nama_kelas }} </td>
                            <td>
                                <div class="box-button">
                                    {!! link_to('kelas/'. $kelas->id .'/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) !!}
                                </div>
                                <div class="box-button">
                                    {!! Form::open(['method' => 'DELETE', 'action' => ['KelasController@destroy', $kelas->id]]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data kelas</p>
        @endif

        <div class="table-nav">
            <div class="jumlah-data">
                <strong>jumlah Kelas : {{  $jumlah_kelas }} </strong>
            </div>
            <div class="paging">
                {{ $kelas_list->links() }}
            </div>
        </div>
        <div class="tombol-nav">
            <div>
                <a href="{{ url('kelas/create') }} " class="btn btn-primary">Tambah Kelas</a>
            </div>
        </div>

    </div>
@stop

@section('footer')
    @include('footer')
@stop

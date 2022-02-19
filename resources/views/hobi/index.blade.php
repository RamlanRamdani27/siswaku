@extends('template')

@section('main')
    <div id="kelas">
        <h2>Kelas</h2>

        @include('_partial.flash_message')

        @if (!empty($hobi_list))
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Hobi</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach($hobi_list as $hobi)
                        <tr>
                            <td>{{ ++$i }} </td>
                            <td>{{ $hobi->nama_hobi }} </td>
                            <td>
                                <div class="box-button">
                                    {!! link_to('hobi/'. $hobi->id .'/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) !!}
                                </div>
                                <div class="box-button">
                                    {!! Form::open(['method' => 'DELETE', 'action' => ['HobiController@destroy', $hobi->id]]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data Hobi</p>
        @endif

        <div class="table-nav">
            <div class="jumlah-data">
                <strong>jumlah Hobi : {{  $jumlah_hobi }} </strong>
            </div>
            <div class="paging">
                {{ $hobi_list->links() }}
            </div>
        </div>
        <div class="tombol-nav">
            <div>
                <a href="{{ url('hobi/create') }} " class="btn btn-primary">Tambah Kelas</a>
            </div>
        </div>

    </div>
@stop

@section('footer')
    @include('footer')
@stop

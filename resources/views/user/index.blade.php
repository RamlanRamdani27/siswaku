@extends('template')

@section('main')
        <div id="user">
            <h2>User</h2>

            @include('_partial.flash_message')

            @if (count($user_list))
                <table class="table">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama</td>
                            <td>Email</td>
                            <td>Level</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; ?>
                        @foreach ($user_list as $user)
                        <tr>
                            <td>{{ ++$i }} </td>
                            <td>{{ $user->name }} </td>
                            <td>{{ $user->email }} </td>
                            <td>{{ $user->level }} </td>
                            <td>
                                <div class="box-button">
                                    {!! link_to('user/'. $user->id .'/edit', 'Edit',
                                    ['class' => 'btn btn-warning  btn-sm']) !!}
                                </div>
                                <div class="box-button">
                                    {!! Form::open(['method' => 'DELETE', 'action' => ['UserController@destroy',
                                    $user->id]]) !!}
                                    {!! Form::submit("Delete", ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            @else
                <p>Tidak ada user</p>
            @endif
                <div class="tombol-nav">
                    <a href="{{ url('user/create') }}" class="btn btn-primary">Tambah User</a>
                </div>
        </div>
@endsection

@section('footer')
        @include('footer')
@endsection

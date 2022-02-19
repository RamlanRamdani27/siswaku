@extends('template')

@section('main')
        <div id="user">
            <h2>Tambah User</h2>

            {!! Form::open(['url' => 'user']) !!}
                @include('user.form', ['SubmitButtonText' => 'Simpan']);
            {!! Form::close() !!}
        </div>
@endsection

@section('footer')
        @include('footer')
@endsection

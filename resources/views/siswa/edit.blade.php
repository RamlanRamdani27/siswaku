@extends('template')

@section('main')
    <div id="siswa">
        <h2>Edit Siswa</h2>


        {!! Form::model($siswa, ['method' => 'PATCH' , 'files' => true , 'action' => ['SiswaController@update', $siswa->id]]) !!}
            @include('siswa.form', ['SubmitButtonText' => 'Update'])
        {!! Form::close() !!}

    </div>
@endsection

@section('footer')
    @include('footer')
@endsection

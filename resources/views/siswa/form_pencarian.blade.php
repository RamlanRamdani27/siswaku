<div id="pencarian">
    {!! Form::open(['url' => 'siswa/cari', 'method' => 'GET']) !!}
        <div class="row">
            <div class="col-md-2">
                {!! Form::select('id_kelas', $list_kelas, (!empty($id_kelas) ? $id_kelas : null ) , ['id' => 'id_kelas',
                'class' => 'form-control', 'placeholder' => '-Kelas-']) !!}
            </div>
            <div class="col-md-2">
                {!! Form::select('jenis_kelamin', ['L'=>'Laki-Laki', 'P'=>'Perempuan'],
                (!empty($jenis_kelamin) ? $jenis_kelamin : null ) , ['id' => 'jenis_kelamin',
                'class' => 'form-control', 'placeholder' => '-Jenis Kelamin-']) !!}
            </div>
            <div class="col-md-8">
                <div class="input-group">
                    {!! Form::text('kata_kunci', (!empty($kata_kunci)) ? $kata_kunci : null , ['class' => 'form-control',
                    'placeholder' => 'Masukan Nama Siswa']) !!}
                   <div class="input-group-btn">
                    {!! Form::button('Cari', ['class' => 'btn btn-default', 'type' => 'submit']) !!}
                   </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>

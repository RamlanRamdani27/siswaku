<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Siswa;
use App\Telepon;
use Validator;
use Storage;
use Session;
use App\Http\Requests\SiswaRequest;
// use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'index',
            'show',
            'cari',
        ]]);
    }

    //
    public function index()
    {
        # code...
        $siswa_list = Siswa::orderBy('nisn','asc')->Paginate(10);
        $jumlah_siswa = $siswa_list->count();
        return view('siswa.index', compact('siswa_list','jumlah_siswa'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(SiswaRequest $request)
    {
        $input =$request->all();
        //foto
        if ($request->hasFile('foto')) {
            # code...
            $input['foto'] = $this->uploadFoto($request);
        }
        // Simpan data siswa
        $siswa = Siswa::create($input);
        // simpan tetelpon
        if ($request->filled('nomor_telepon')) {
            $this->insertTelepon($siswa, $request);
        }
        // simpan hobi
        $siswa->hobi()->attach($request->input('hobi_siswa'));

        Session::flash('flash_message', 'Data Siswa berhasil di simpan');

        return redirect('siswa');
    }

    public function show(Siswa $siswa)
    {
        # code...
        // $siswa = Siswa::where('nisn',$id)->first();
        // $siswa = Siswa::findOrFail($id);
        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        if (!empty($siswa->telepon->nomor_telepon)) {
            $siswa->nomor_telepon = $siswa->telepon->nomor_telepon;
        }
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Siswa $siswa, SiswaRequest $request)
    {
        $input = $request->all();
        // Foto. Cek adakah foto ?
        if ($request->hasFile('foto')) {
            $input['foto'] = $this->updateFoto($siswa,$request);
        }
        //Update Siswa
        $siswa->update($input);
        // update nomer telepon, jika sebelumnya sudah ada nomer telepon
        $this->updateTelepon($siswa, $request);
        //update Hobi
        $siswa->hobi()->sync($request->input('hobi_siswa'));

        Session::flash('flash_message', 'Data Siswa berhasil di Update');
        return redirect('siswa');
    }

    public function destroy(Siswa $siswa)
    {
        //Hapus Foto Lama jika ada foto baru
        $this->hapusFoto($siswa);
        $siswa->delete();
        Session::flash('flash_message', 'Data Siswa berhasil di hapus');
        Session::flash('penting', true);
        return redirect('siswa');
    }

    public function insertTelepon(Siswa $siswa, SiswaRequest $request)
    {
       $telepon = new Telepon;
       $telepon->nomor_telepon = $request->input('nomor_telepon');
       $siswa->telepon()->save($telepon);
    }

    public function updateTelepon(Siswa $siswa, SiswaRequest $request)
    {
        if ($siswa->telepon) {
           //Jika tel di isi, update
           if ($request->filled('nomor_telepon')) {
               $telepon = $siswa->telepon;
               $telepon->nomor_telepon = $request->input('nomor_telepon');
               $siswa->telepon()->save($telepon);
           } else {
              $siswa->telepon()->delete();
           }
        }
        // Buat entry baru jika sebelumnya tidak ada no telp.
        else {
            if ($request->filled('nomor_telepon')) {
                $telepon =  new Telepon;
                $telepon->nomor_telepon = $request->input('nomor_telepon');
                $siswa->telepon()->save($telepon);
            }
        }
    }

    public function uploadFoto(SiswaRequest $request)
    {
        $foto = $request->file('foto');
        $ext = $foto->getClientOriginalExtension();
        if ($request->file('foto')->isValid()) {
            $foto_name = date('YmdHis'). ".$ext";
            $request->file('foto')->move('fotoupload', $foto_name);
            return $foto_name;
        }
        return false;
    }

    public function updateFoto(Siswa $siswa, SiswaRequest $request)
    {
        //jika user mengisi foto
        if ($request->hasFile('foto')) {
            //Hapus Foto lama jika ada foto baru
            $exist = Storage::disk('foto')->exists($siswa->foto);
            if (isset($siswa->foto) && $exist) {
                $delete = Storage::disk('foto')->delete($siswa->foto);
            }

            //Uplaod Foto baru
            $foto = $request->file('foto');
            $ext = $foto->getClientOriginalExtension();
            if ($request->file('foto')->isValid()) {
                $foto_name = date('YmdHis'). ".$ext";
                $request->file('foto')->move('fotoupload', $foto_name);
                return $foto_name;
            }
        }
    }

    public function hapusFoto(Siswa $siswa)
    {
        $is_foto_exist = Storage::disk('foto')->exists($siswa->foto);

        if ($is_foto_exist) {
            $delete = Storage::disk('foto')->delete($siswa->foto);
        }
    }

    public function cari(Request $request)
    {
        $kata_kunci  = trim($request->input('kata_kunci'));

        if (!empty($kata_kunci)) {
            $jenis_kelamin = $request->input('jenis_kelamin');
            $id_kelas      = $request->input('id_kelas');

            $query        = Siswa::where('nama_siswa', 'LIKE', '%'. $kata_kunci .'%');
            (!empty($jenis_kelamin)) ? $query->JenisKelamin($jenis_kelamin) : '';
            (!empty($id_kelas)) ? $query->Kelas($id_kelas) : '';
            $siswa_list   = $query->paginate(2);

            //URL links paginaion
            $pagination   = (!empty($jenis_kelamin)) ? $siswa_list->appends(['jenis_kelamin' => $jenis_kelamin]) : '';
            $pagination   = (!empty($id_kelas)) ? $siswa_list->appends(['id_kelas' => $id_kelas]) : '';
            $pagination   = $siswa_list->appends(['kata_kunci' => $kata_kunci]);

                $jumlah_siswa =$siswa_list->total();
                return view('siswa.index', compact('siswa_list',
                'kata_kunci','pagination','jumlah_siswa',
                'id_kelas','jenis_kelamin'));
        }

        return redirect('siswa');
    }
}

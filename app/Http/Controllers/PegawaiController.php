<?php

namespace App\Http\Controllers;

/* Import Model */
use Mail;
use App\Mail\PegawaiMail;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Session;

class PegawaiController extends Controller
{
    /**
    * index
    *
    * @return void
    */

    public function index()
    {
        //get posts
        $pegawai = Pegawai::latest()->paginate(5);
        //render view with posts
        return view('pegawai.index', compact('pegawai'));
    }

    /**
    * create
    *
    * @return void
    */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
    * store
    *
    * @param Request $request
    * @return void
    */
    public function store(Request $request)
    {
        //Validasi Formulir
        $this->validate($request, [
            'nip'=> 'required',
            'nama_pegawai'=> 'required|max:15',
            'departemen_id'=> 'required',
            'email'=> 'required|email',
            'telepon'=> 'required|min:10|max:15',
            'gender'=> 'required',
            'status'=> 'required'            
        ]);

        //Fungsi Simpan Data ke dalam Database
        Pegawai::create([
            'nip' => $request->nip,
            'nama_pegawai'=> $request->nama_pegawai,
            'departemen_id'=> $request->departemen_id,
            'email'=> $request->email,
            'telepon'=> $request->telepon,
            'gender'=> $request->gender,
            'status'=> $request->status
        ]);

        try{
        //Mengisi variabel yang akan ditampilkan pada view mail
            $content = [
                'body' => $request->nip,
            ];

            //Mengirim email ke emailtujuan@gmail.com
            Mail::to('danan.ifest@gmail.com')->send(new PegawaiMail($content));

            //Redirect jika berhasil mengirim email
            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Disimpan, email telah terkirim!']);
            
        }catch(Exception $e){
            //Redirect jika gagal mengirim email
            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
        }
    }

    public function destroy($id){
        $pegawai = Pegawai::where('id',$id)->firstorfail()->delete();
        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}

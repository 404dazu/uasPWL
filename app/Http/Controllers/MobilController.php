<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Mobil;
use Symfony\Contracts\Service\Attribute\Required;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_mobil = DB::table('mobil')->get();
        
        return view('mobil.index',compact('ar_mobil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mengarahkan ke form
        return view('mobil.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //proses validasi data
        $validated = $request->validate(
            [
                'merek' => 'required',
                'model' => 'required',
                'th_buat' => 'required|numeric',
                'p_nomor' => 'required',
                'foto' => 'image|mimes:jpg,png,jpeg,gif|max:2000',
            ],

            [
                'merek.required' => 'Merek Mobil Harus di Isi',
                'model.required' => 'Model Mobil Harus di Isi',
                'th_buat.required' => 'Tahun Buat Harus di Isi',
                'th_buat.numeric' => 'Tahun Buat Harus Berupa Angka',
                'p_nomor.required' => 'Nomor Plat Mobil Harus di Isi',
                'foto.image' => 'File Harus Format jpg,jpeg,png,gif',
                'foto.max' => 'Ukuran File Maksimal 2mb',
            ]
        );

        //proses upload file
        if (!empty($request->foto)) {
            $fileName = $request->p_nomor . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/mobil'), $fileName);
        } else {
            $fileName = '';
        }

        //proses input data
        // 1. tangkap request form
        DB::table('mobil')->insert(
            [
                'merek' => $request->merek,
                'model' => $request->model,
                'th_buat' => $request->th_buat,
                'p_nomor' => $request->p_nomor,
                'foto' => $fileName,
            ]
        );

        //2. landing page
        return redirect('/mobil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //menampilkan detail
        $ar_mobil = DB::table('mobil')->where('mobil.id', $id)->get();

        return view('mobil.show', compact('ar_mobil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //mengarahkan ke halaman form edit
        $data = DB::table('mobil')->where('id', $id)->get();

        return view('mobil.form_edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //mengedit data
        // 1. proses ubah data
        DB::table('mobil')->where('id', $id)->update(
            [
                'merek' => $request->merek,
                'model' => $request->model,
                'th_buat' => $request->th_buat,
                'p_nomor' => $request->p_nomor,
                'foto' => $request->foto,
            ]
        );

        //2. landing page
        return redirect('/mobil'.'/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //menghapus data
        //1. hapus data
        DB::table('mobil')->where('id', $id)->delete();

        //2. landing page
        return redirect('/mobil');
    }

    public function PDF()
    {
        $ar_mobil = DB::table('mobil')->get();

        $pdf = PDF::loadView('mobil.PDFku', ['ar_mobil' => $ar_mobil]);

        return $pdf->download('DataMobil.pdf');
    }
}
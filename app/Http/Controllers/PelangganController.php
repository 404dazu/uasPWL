<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Pelanggan;
use Symfony\Contracts\Service\Attribute\Required;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_pelanggan = DB::table('pelanggan')->get();

        return view('pelanggan.index', compact('ar_pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mengarahkan ke form
        return view('pelanggan.form');
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
                'ktp' => 'required|numeric',
                'nama' => 'required',
                'tgl_lahir' => 'required',
                'hp' => 'required|numeric',
                'foto' => 'image|mimes:jpg,png,jpeg,gif|max:2000',
            ],

            [
                'ktp.required' => 'Nomor KTP Harus di Isi',
                'ktp.numeric' => 'Nomor KTP Harus Berupa Angka',
                'nama.required' => 'Nama Harus di Isi',
                'tgl_lahir.required' => 'Tanggal Lahir Harus di Isi',
                'hp.required' => 'Nomor HP Harus di Isi',
                'hp.numeric' => 'Nomor HP Harus Berupa Angka',
                'foto.image' => 'File Harus Format jpg,jpeg,png,gif',
                'foto.max' => 'Ukuran File Maksimal 2mb',
            ]
        );

        //proses upload file
        if (!empty($request->foto)) {
            $fileName = $request->nama . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/pelanggan'), $fileName);
        } else {
            $fileName = '';
        }

        //proses input data
        // 1. tangkap request form
        DB::table('pelanggan')->insert(
            [
                'ktp' => $request->ktp,
                'nama' => $request->nama,
                'tgl_lahir' => $request->tgl_lahir,
                'hp' => $request->hp,
                'foto' => $fileName,
            ]
        );

        //2. landing page
        return redirect('/pelanggan');
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
        $ar_pelanggan = DB::table('pelanggan')->where('pelanggan.id', $id)->get();

        return view('pelanggan.show', compact('ar_pelanggan'));
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
        $data = DB::table('pelanggan')->where('id', $id)->get();

        return view('pelanggan.form_edit', compact('data'));
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
        DB::table('pelanggan')->where('id', $id)->update(
            [
                'ktp' => $request->ktp,
                'nama' => $request->nama,
                'tgl_lahir' => $request->tgl_lahir,
                'hp' => $request->hp,
                'foto' => $request->foto,
            ]
        );

        //2. landing page
        return redirect('/pelanggan' . '/' . $id);
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
        DB::table('pelanggan')->where('id', $id)->delete();

        //2. landing page
        return redirect('/pelanggan');
    }

    public function PDF()
    {
        $ar_pelanggan = DB::table('pelanggan')->get();

        $pdf = PDF::loadView('pelanggan.PDFku', ['ar_pelanggan' => $ar_pelanggan]);

        return $pdf->download('DataPelanggan.pdf');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Rental;
use Symfony\Contracts\Service\Attribute\Required;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_rental = DB::table('rental')
            ->join('pelanggan', 'pelanggan.id', '=', 'rental.idpelanggan')
            ->join('mobil', 'mobil.id', '=', 'rental.idmobil')
            ->select('rental.*', 'pelanggan.nama AS plgn', 'mobil.merek AS car')
            ->get();

        return view('rental.index', compact('ar_rental'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mengarahkan ke form
        return view('rental.form');
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
                'idpelanggan' => 'required|numeric',
                'idmobil' => 'required|numeric',
                'tanggal_pinjam' => 'required',
                'tanggal_pulang' => 'required',
                'harga' => 'required',
                'hp' => 'required|numeric',
                'foto' => 'image|mimes:jpg,png,jpeg,gif|max:2000',
            ],

            [
                'idpelanggan.required' => 'Nama Pelanggan Harus dipilih',
                'idmobil.required' => 'Merek Mobil Harus dipilih',
                'tanggal_pinjam.required' => 'Tanggal Pinjam Harus di Isi',
                'tanggal_pulang.required' => 'Tanggal Pulang Harus di Isi',
                'harga.required' => 'Harga Harus di Isi',
                'hp.required' => 'Nomor Hp Harus di Isi',
                'hp.numeric' => 'Nomor Hp Harus Berupa Angka',
                'foto.image' => 'File Harus Format jpg,jpeg,png,gif',
                'foto.max' => 'Ukuran File Maksimal 2mb',
            ]
        );

        //proses upload file
        if (!empty($request->foto)) {
            $fileName = $request->plgn . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/rental'), $fileName);
        } else {
            $fileName = '';
        }

        //proses input data
        // 1. tangkap request form
        DB::table('rental')->insert(
            [
                'idpelanggan' => $request->idpelanggan,
                'idmobil' => $request->idmobil,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_pulang' => $request->tanggal_pulang,
                'harga' => $request->harga,
                'hp' => $request->hp,
                'foto' => $fileName,
            ]
        );

        //2. landing page
        return redirect('/rental');
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
        $ar_rental = DB::table('rental')
            ->join('pelanggan', 'pelanggan.id', '=', 'rental.idpelanggan')
            ->join('mobil', 'mobil.id', '=', 'rental.idmobil')
            ->select('rental.*', 'pelanggan.nama AS plgn', 'mobil.merek AS car')
            ->where('rental.id', $id)->get();

        return view('rental.show', compact('ar_rental'));
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
        $data = DB::table('rental')->where('id', $id)->get();

        return view('rental.form_edit', compact('data'));
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
        DB::table('rental')->where('id', $id)->update(
            [
                'idpelanggan' => $request->idpelanggan,
                'idmobil' => $request->idmobil,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_pulang' => $request->tanggal_pulang,
                'harga' => $request->harga,
                'hp' => $request->hp,
                'foto' => $request->foto,
            ]
        );

        //2. landing page
        return redirect('/rental' . '/' . $id);
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
        DB::table('rental')->where('id', $id)->delete();

        //2. landing page
        return redirect('/rental');
    }

    public function PDF()
    {
        $ar_rental = DB::table('rental')->get();

        $pdf = PDF::loadView('rental.PDFku', ['ar_rental' => $ar_rental]);

        return $pdf->download('DataRental.pdf');
    }
}
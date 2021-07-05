@extends('page.index')
@section('konten')
@php
    $ar_judul = ['No','Nama Pelanggan','Merek Mobil','Tanggal Pinjam','Tanggal Pulang','Harga','Nomor HP','Action'];
    $no = 1;
@endphp
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: 25px;">Data Rental</h3>
                    <a class="btn btn-primary" style="float: right;" href="{{ route('rental.create') }}" role="button" title="klik untuk tambah data"><i class="fas fa-plus-circle"></i> Tambah</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover text-nowrap">
                        <thead>
                            <tr>
                                @foreach ($ar_judul as $jdl)
                                <th style="text-align: center">{{ $jdl }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                            @foreach ($ar_rental as $r)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $r->plgn }}</td>
                                    <td>{{ $r->car }}</td>
                                    <td>{{ $r->tanggal_pinjam }}</td>
                                    <td>{{ $r->tanggal_pulang }}</td>
                                    <td>{{ $r->harga }}</td>
                                    <td>{{ $r->hp }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('rental.destroy',$r->id) }}">
                                            @csrf
                                            @method('delete')
                                            <a class="btn btn-info" href="{{ route('rental.show',$r->id) }}" title="klik untuk melihat secara detail"><i class="fas fa-info-circle"></i></a>
                                            <a class="btn btn-warning" href="{{ route('rental.edit',$r->id) }}" title="klik untuk mengedit data"><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-danger" onclick="return confirm('Data ini akan hilang, Anda yakin?')" title="klik untuk menghapus data"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
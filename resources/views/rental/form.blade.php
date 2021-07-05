@extends('page.index')
@section('konten')
@php
    $rs1 = App\Models\Pelanggan::all();
    $rs2 = App\Models\Mobil::all();
@endphp
    <h3 class="mt-3">Form Rental</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('rental.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Nama Pelanggan :</label>
            <select class="form-control @error('idpelanggan') is-invalid @enderror" name="idpelanggan" />
            <option value="">-- Pilih pelanggan --</option>
            @foreach ($rs1 as $p)
                <option value="{{ $p->id }}">{{ $p->nama }}</option>
            @endforeach
            </select>
            @error('idpelanggan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Merek Mobil :</label>
            <select class="form-control @error('idmobil') is-invalid @enderror" name="idmobil" />
            <option value="">-- Pilih Mobil --</option>
            @foreach ($rs2 as $m)
                <option value="{{ $m->id }}">{{ $m->merek }}</option>
            @endforeach
            </select>
            @error('idmobil')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Tanggal Pinjam :</label>
            <input type="date" name="tanggal_pinjam" class="form-control @error('tanggal_pinjam') is-invalid @enderror"/>
            @error('tanggal_pinjam')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Tanggal Pulang :</label>
            <input type="date" name="tanggal_pulang" class="form-control @error('tanggal_pulang') is-invalid @enderror"/>
            @error('tanggal_pulang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Harga :</label>
            <input type="text" name="harga" placeholder="masukan nominal harga" class="form-control @error('harga') is-invalid @enderror"/>
            @error('harga')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Nomor HP Pelanggan :</label>
            <input type="text" name="hp" placeholder="masukan nomor hp anda" class="form-control @error('hp') is-invalid @enderror" maxlength="15"/>
            @error('hp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Foto Pelanggan :</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"/>
                </div>
            </div>
            @error('foto')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" name="proses">Simpan</button>
        <button type="reset" class="btn btn-danger" name="proses">Hapus</button>
    </form>
@endsection
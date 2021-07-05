@extends('page.index')
@section('konten')
@php
    $rs1 = App\Models\Pelanggan::all();
    $rs2 = App\Models\Mobil::all();
@endphp
    <h3 class="mt-3">Form Edit Rental</h3>
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
    @foreach ($data as $rs)
        <form method="POST" action="{{ route('rental.update',$rs->id) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Nama Pelanggan :</label>
                <select class="form-control @error('idpelanggan') is-invalid @enderror" name="idpelanggan" />
                <option value="">-- Pilih pelanggan --</option>
                @foreach ($rs1 as $p)
                @php
                    $sel1 = ($p->id == $rs->idpelanggan) ? 'selected' : '';
                @endphp
                    <option value="{{ $p->id }}" {{ $sel1 }}>{{ $p->nama }}</option>
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
                @php
                    $sel2 = ($m->id == $rs->idmobil) ? 'selected' : '';
                @endphp
                    <option value="{{ $m->id }}" {{ $sel1 }}>{{ $m->merek }}</option>
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
                <input type="date" name="tanggal_pinjam" value="{{ $rs->tanggal_pinjam }}" class="form-control @error('tanggal_pinjam') is-invalid @enderror"/>
                @error('tanggal_pinjam')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Tanggal Pulang :</label>
                <input type="date" name="tanggal_pulang" value="{{ $rs->tanggal_pulang }}" class="form-control @error('tanggal_pulang') is-invalid @enderror"/>
                @error('tanggal_pulang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Harga :</label>
                <input type="text" name="harga" placeholder="masukan nominal harga" value="{{ $rs->harga }}" class="form-control @error('harga') is-invalid @enderror"/>
                @error('harga')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Nomor HP Pelanggan :</label>
                <input type="text" name="hp" placeholder="masukan nomor hp anda" value="{{ $rs->hp }}" class="form-control @error('hp') is-invalid @enderror" maxlength="15"/>
                @error('hp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Foto Pelanggan :</label>
                <input type="text" name="foto" value="{{ $rs->foto }}" class="form-control @error('foto') is-invalid @enderror"/>
                @error('foto')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary" name="proses">Ubah</button>
            <a href="{{ url('/rental') }}" class="btn btn-danger">Batal</a>
        </form>
    @endforeach
@endsection
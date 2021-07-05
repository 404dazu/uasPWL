@extends('page.index')
@section('konten')
    <h3 class="mt-3">Form Pelanggan</h3>
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
    <form method="POST" action="{{ route('pelanggan.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Nomor KTP :</label>
            <input type="text" name="ktp" placeholder="isi nomor ktp anda" class="form-control @error('ktp') is-invalid @enderror" maxlength="16"/>
            @error('ktp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Nama Pelanggan :</label>
            <input type="text" name="nama" placeholder="isi nama anda" class="form-control @error('nama') is-invalid @enderror" maxlength="45"/>
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Tanggal Lahir :</label>
            <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror"/>
            @error('tgl_lahir')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>HP :</label>
            <input type="text" name="hp" placeholder="isi nomor hp anda" class="form-control @error('hp') is-invalid @enderror" maxlength="15"/>
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
                    <input type="file" name="foto" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Masukan file foto</label>
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
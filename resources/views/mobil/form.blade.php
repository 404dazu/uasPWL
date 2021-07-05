@extends('page.index')
@section('konten')
    <h3 class="mt-3">Form Mobil</h3>
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
    <form method="POST" action="{{ route('mobil.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Merek Mobil :</label>
            <input type="text" name="merek" placeholder="isi merek mobil" class="form-control @error('merek') is-invalid @enderror" maxlength="45"/>
            @error('merek')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Model Mobil :</label>
            <input type="text" name="model" placeholder="isi model mobil" class="form-control @error('model') is-invalid @enderror" maxlength="45"/>
            @error('model')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Tahun Buat :</label>
            <input type="text" name="th_buat" placeholder="isi tahun buat" class="form-control @error('th_buat') is-invalid @enderror" maxlength="4"/>
            @error('th_buat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Plat Nomor :</label>
            <input type="text" name="p_nomor" placeholder="isi plat nomor" class="form-control @error('p_nomor') is-invalid @enderror" maxlength="11"/>
            @error('p_nomor')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Foto Mobil :</label>
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
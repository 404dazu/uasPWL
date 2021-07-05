@extends('page.index')
@section('konten')
    <h3 class="mt-3">Form Edit Mobil</h3>
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
        <form method="POST" action="{{ route('mobil.update',$rs->id) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Merek Mobil :</label>
                <input type="text" name="merek" placeholder="isi merek mobil"  value="{{ $rs->merek }}" class="form-control @error('merek') is-invalid @enderror" maxlength="45"/>
                @error('merek')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Model Mobil :</label>
                <input type="text" name="model" placeholder="isi model mobil"  value="{{ $rs->model }}" class="form-control @error('model') is-invalid @enderror" maxlength="45"/>
                @error('model')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Tahun Buat :</label>
                <input type="text" name="th_buat" placeholder="isi tahun buat"  value="{{ $rs->th_buat }}" class="form-control @error('th_buat') is-invalid @enderror" maxlength="4"/>
                @error('th_buat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Plat Nomor :</label>
                <input type="text" name="p_nomor" placeholder="isi plat nomor"  value="{{ $rs->p_nomor }}" class="form-control @error('p_nomor') is-invalid @enderror" maxlength="11"/>
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
                        <input type="text" name="foto" value="{{ $rs->foto }}" class="form-control"/>
                    </div>
                </div>
                @error('foto')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary" name="proses">Ubah</button>
            <a href="{{ url('/mobil') }}" class="btn btn-danger">Batal</a>
        </form>
    @endforeach
@endsection
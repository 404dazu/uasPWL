@extends('page.index')
@section('konten')
    <h3 class="mt-3">Detail Data Pelanggan</h3>
    @foreach ($ar_pelanggan as $p)
        <div class="card" style="width: 22rem;">
            @php
            if(!empty($p->foto)) {
            @endphp
                <img src="{{ asset('images/pelanggan')}}/{{ $p->foto }}"/>
            @php
            } else {
            @endphp
                <img src="{{ asset('images')}}/no_picture.png"/>
            @php
            }
            @endphp
            <div class="card-body">
                <h5 class="card-title" style="font-size: 24px; font-weight: 600;">{{ $p->nama }}</h5>
                <p class="card-text">
                    Nomor KTP : {{ $p->ktp }}
                    <br/>Tanggal Lahir : {{ $p->tgl_lahir }}
                    <br/>Nomor HP : {{ $p->hp }}
                </p>
                <a href="{{ url('/pelanggan') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    @endforeach
@endsection
@extends('page.index')
@section('konten')
    <h3 class="mt-3">Detail Data Mobil</h3>
    @foreach ($ar_mobil as $m)
        <div class="card" style="width: 22rem;">
            @php
            if(!empty($m->foto)) {
            @endphp
                <img src="{{ asset('images/mobil')}}/{{ $m->foto }}"/>
            @php
            } else {
            @endphp
                <img src="{{ asset('images')}}/no_picture.png"/>
            @php
            }
            @endphp
            <div class="card-body">
                <h5 class="card-title" style="font-size: 24px; font-weight: 600;">{{ $m->merek }}</h5>
                <p class="card-text">
                    Model Mobil : {{ $m->model }}
                    <br/>Tahun Buat : {{ $m->th_buat }}
                    <br/>Plat Nomor : {{ $m->p_nomor }}
                </p>
                <a href="{{ url('/mobil') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    @endforeach
@endsection
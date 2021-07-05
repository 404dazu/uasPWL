@extends('page.index')
@section('konten')
    <h3 class="mt-3">Detail Data Rental</h3>
    @foreach ($ar_rental as $r)
        <div class="card" style="width: 22rem;">
            @php
            if(!empty($r->foto)) {
            @endphp
                <img src="{{ asset('images/rental')}}/{{ $r->foto }}"/>
            @php
            } else {
            @endphp
                <img src="{{ asset('images')}}/no_picture.png"/>
            @php
            }
            @endphp
            <div class="card-body">
                <h5 class="card-title" style="font-size: 24px; font-weight: 600;">{{ $r->plgn }}</h5>
                <p class="card-text">
                    Model Mobil : {{ $r->car }}
                    <br/>Tanggal Pinjam : {{ $r->tanggal_pinjam }}
                    <br/>Tanggal Pulang : {{ $r->tanggal_pulang }}
                    <br/>Harga : {{ $r->harga }}
                    <br/>Nomor HP : {{ $r->hp }}
                </p>
                <a href="{{ url('/rental') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    @endforeach
@endsection
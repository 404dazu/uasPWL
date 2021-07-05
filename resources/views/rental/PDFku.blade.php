@php
    $ar_judul = ['No','Nama Pelanggan','Merek Mobil','Tanggal Pinjam','Tanggal Pulang','Harga','Nomor HP'];
    $no = 1;
@endphp
    <h3 align="center">Data Rental</h3>
    <table align="center" border="1" cellpadding="5">
        <thead>
            <tr>
                @foreach ($ar_judul as $jdl)
                    <th align="center">{{ $jdl }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody align="center">
            @foreach ($ar_rental as $r)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $r->plgn }}</td>
                    <td>{{ $r->car }}</td>
                    <td>{{ $r->tanggal_pinjam }}</td>
                    <td>{{ $r->tanggal_pulang }}</td>
                    <td>{{ $r->harga }}</td>
                    <td>{{ $r->hp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
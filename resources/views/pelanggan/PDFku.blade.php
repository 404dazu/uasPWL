@php
    $ar_judul = ['No','Nomor KTP','Nama Pelanggan','Tanggal Lahir','Nomor HP'];
    $no = 1;
@endphp
    <h3 align="center">Data Pelanggan</h3>
    <table align="center" border="1" cellpadding="5">
        <thead>
            <tr>
                @foreach ($ar_judul as $jdl)
                    <th align="center">{{ $jdl }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody align="center">
            @foreach ($ar_pelanggan as $p)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $p->ktp }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->tgl_lahir }}</td>
                    <td>{{ $p->hp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
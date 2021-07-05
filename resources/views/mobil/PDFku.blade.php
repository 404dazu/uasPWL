@php
    $ar_judul = ['No','Merek Mobil','Model Mobil','Tahun Buat','Nomor Plat'];
    $no = 1;
@endphp
    <h3 align="center">Data Mobil</h3>
    <table align="center" border="1" cellpadding="5">
        <thead>
            <tr>
                @foreach ($ar_judul as $jdl)
                    <th align="center">{{ $jdl }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody align="center">
            @foreach ($ar_mobil as $m)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $m->merek }}</td>
                    <td>{{ $m->model }}</td>
                    <td>{{ $m->th_buat }}</td>
                    <td>{{ $m->p_nomor }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
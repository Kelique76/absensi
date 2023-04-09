<?php
function selisih($jam_masuk, $jam_keluar)
{
    [$h, $m, $s] = explode(':', $jam_masuk);
    $dtAwal = mktime($h, $m, $s, '1', '1', '1');
    [$h, $m, $s] = explode(':', $jam_keluar);
    $dtAkhir = mktime($h, $m, $s, '1', '1', '1');
    $dtSelisih = $dtAkhir - $dtAwal;
    $totalmenit = $dtSelisih / 60;
    $jam = explode('.', $totalmenit / 60);
    $sisamenit = $totalmenit / 60 - $jam[0];
    $sisamenit2 = $sisamenit * 60;
    $jml_jam = $jam[0];
    return $jml_jam . ':' . round($sisamenit2);
}
?>

@foreach ($apps as $item)
    @php
        $jalanin = Storage::url('uploads/absensi/' . $item->foto_in);
        $jalanout = Storage::url('uploads/absensi/' . $item->foto_out);

    @endphp
    <tr>

        <td> {{ $loop->iteration }}</td>
        <td>{{ $item->nama_lengkap }}</td>
        <td>{{ $item->nik }}</td>
        <td>{{ $item->nama_dept }}</td>
        <td>{{ $item->tgl_absen }}</td>
        <td>
            <span class="badge {{ $item->jam_in > '06:00' ? 'bg-red' : 'bg-green' }}">{{ $item->jam_in }}</span>
        </td>
        <td>
            <span
                class="badge {{ $item->jam_out > '08:00' ? 'bg-green' : 'bg-red' }}">{{ $item->jam_out != null ? $item->jam_out : 'Masih Kerja' }}</span>
        </td>
        <td>
            @if ($item->foto_in != null)
                <img src="{{ url($jalanin) }}" alt="foto absen" class="avatar">
            @else
                <span class="avatar">{{ mb_substr('Alpha', 0, 1) }}</span>
            @endif
        </td>
        <td>
            @if ($item->foto_out != null)
                <img src="{{ url($jalanout) }}" alt="foto absen" class="avatar">
            @else
                <span class="badge bg-yellow">Sdg Aktif</span>
            @endif
        </td>
        <td>
            @if ($item->jam_in > '06:00')
                @php
                    $ketelatan = selisih('06:00:00', $item->jam_in);
                @endphp
                <span class="badge bg-red">Telat: {{ $ketelatan }}</span>
            @else
                <span class="badge bg-green">rajin</span>
            @endif
        </td>
        <td>
            <a href="/panel/petaabsennya/{{ $item->id }}"><span class="badge bg-green">lihat lokasi</span></a>


            {{-- <form action="/panel/petaabsennya/{{ $item->nik }}" method="POST">
                @csrf
            </form> --}}



        </td>

    </tr>
@endforeach


@push('myscript')
    <script>
        $(" .btntambah").click(function() {
            // alert('Klok');
            $("#modalnambahkry").modal("show");
        });
    </script>
@endpush

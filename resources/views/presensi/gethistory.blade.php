@if ($cekhis->isEmpty())
    <div class="alert alert-warning">
        <p>Data tidak tersedia</p>
    </div>
@endif

@foreach ($cekhis as $item)
    <ul class="listview image-listview">
        <li>
            <div class="item">
                @php
                    $jalur = Storage::url('uploads/absensi/' . $item->foto_in);
                @endphp
                <img src="{{ url($jalur) }}" alt="image" class="imaged w34 rounded" style="height: 40px; width: 40px;">
                <div class="in">
                    <div> <b>{{ date('d-m-Y', strtotime($item->tgl_absen)) }}</b>

                    </div>

                    <span
                        class="badge
            {{ $item->jam_in < '06:00' ? 'bg-success' : 'bg-danger' }}
            ">{{ $item->jam_in }}</span>
            <span
                        class="badge
            {{ $item->jam_out < '06:00' ? 'bg-success' : 'bg-danger' }}
            ">{{ $item->jam_out }}</span>
                </div>
            </div>
        </li>
    </ul>
@endforeach

<div class="appBottomMenu">
    <a href="/admin" class="item {{ request()->is('admin')? 'active': ''}}">
        <div class="col">
            <ion-icon name="prism-outline" role="img" class="md hydrated"
                aria-label="prism-outline full outline"></ion-icon>

            <strong>Omah</strong>
        </div>
    </a>
    <a href="/presensi/riwayat" class="item {{ request()->is('presensi/riwayat')? 'active': ''}}">
        <div class="col">
            <ion-icon name="document-text-outline" role="img" class="md hydrated"
            aria-label="document text outline"></ion-icon>

            <strong>Riwayat</strong>
        </div>
    </a>
    <a href="/presensi/create" class="item }}">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="/ijin" class="item {{ request()->is('ijin')? 'active': ''}}">
        <div class="col">
            <ion-icon name="person-circle-outline"></ion-icon>
            <strong>Ijin</strong>
        </div>
    </a>
    <a href="/presensi/editprof" class="item {{ request()->is('presensi/editprof')? 'active': ''}}">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
</div>

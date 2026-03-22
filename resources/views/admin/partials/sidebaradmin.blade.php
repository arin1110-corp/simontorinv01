<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('asset/image/pemprov.png') }}" alt="Pemprov Logo">
        <h2>SIMONTORIN</h2>
    </div>

    <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ route('admin.inventaris.index') }}"><i class="bi bi-box-seam"></i> Inventaris</a>
    <a href="{{ route('admin.perbaikan.index') }}"><i class="bi bi-tools"></i> Perbaikan</a>
    <a href="{{ route('admin.peminjaman.index') }}"><i class="bi bi-arrow-left-right"></i> Peminjaman</a>
    <a href="{{ route('admin.booking.index') }}"><i class="bi bi-calendar-check"></i> Booking Rapat</a>
    <a href="{{ route('admin.users.index') }}"><i class="bi bi-people"></i> Pengguna</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
</div>
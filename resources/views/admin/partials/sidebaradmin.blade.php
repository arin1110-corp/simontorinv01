<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('asset/image/pemprov.png') }}" alt="Pemprov Logo">
        <h2>SIMONTOR<span>IN</span></h2>
        <div class="selamat-datang">Selamat Datang, <p>{{ session('pegawai_nama') }}</p>
        </div>
        <div class="role">
            <button class="btn btn-outline-primary btn-sm ganti-role" data-bs-toggle="modal" data-bs-target="#roleModal">
                {{ session('active_role') }}
            </button>
        </div>
    </div>


    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('admin.inventaris.index') }}"
        class="{{ request()->routeIs('admin.inventaris.index') ? 'active' : '' }}"><i class="bi bi-box-seam"></i>
        Inventaris</a>
    <a href="{{ route('admin.kir.index') }}" class="{{ request()->routeIs('admin.kir.index') ? 'active' : '' }}"><i
            class="bi bi-archive"></i> KIR</a>
    <a href="{{ route('admin.perbaikan.index') }}"
        class="{{ request()->routeIs('admin.perbaikan.index') ? 'active' : '' }}"><i class="bi bi-tools"></i>
        Perbaikan</a>
    <a href="{{ route('admin.peminjaman.index') }}"
        class="{{ request()->routeIs('admin.peminjaman.index') ? 'active' : '' }}"><i
            class="bi bi-arrow-left-right"></i> Peminjaman</a>
    <a href="{{ route('admin.booking.index') }}"
        class="{{ request()->routeIs('admin.booking.index') ? 'active' : '' }}"><i class="bi bi-calendar-check"></i>
        Booking Rapat</a>
    <a href="{{ route('admin.users.index') }}"
        class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}"><i class="bi bi-people"></i> Pengguna</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

</div>


<div class="modal fade" id="roleModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="/set-role">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Role yang tersedia</label>

                    <select name="role" class="form-control" required>
                        <option value="">-- Pilih Role --</option>

                        @foreach ($roles as $role)
                            <option value="{{ $role }}"
                                {{ session('active_role') == $role ? 'selected' : '' }}>
                                {{ ucfirst($role) }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Ganti Role</button>
                </div>
            </div>

        </form>
    </div>
</div>

<section style="background:#0d1b2a;" class="text-white">
    <div class="container-fluid">
        <div class="row align-items-center">

            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="display-4 fw-bold">
                    Sistem Monitoring Aset Internal
                </h1>
                <p class="fs-5 mt-4">
                    SIMONTORIN merupakan sistem terintegrasi untuk
                    pengelolaan, pemantauan, dan pelaporan aset internal
                    Dinas Kebudayaan Provinsi Bali.
                </p>
            </div>

            <div class="col-lg-6">
                <div class="bg-white text-dark rounded-4 p-5 shadow-lg">
                    <h3 class="fw-bold mb-4 text-center">
                        Login Pegawai
                    </h3>

                    <form action="{{ route('login.nipnik') }}" method="POST">
                        @csrf
                        <input type="number"
                               name="nip_nik"
                               class="form-control form-control-lg mb-4"
                               placeholder="Masukkan NIP / NIK"
                               required>

                        <button class="btn btn-dark btn-lg w-100 fw-bold">
                            Masuk Sistem
                        </button>
                    </form>

                    <a href="{{ route('login.admin') }}"
                       class="btn btn-outline-secondary btn-lg w-100 mt-3">
                        Login Admin
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
<div class="tab-pane p-4 fade mt-3 rounded-2" id="verif" role="tabpanel" aria-labelledby="verif-tab"
    style="background: #EBF4FF">
    <p class="paragpraph mb-3">
        <strong>VERIF</strong> merupakan layanan JAGA untuk memverifikasi akun masing-masing user, sehingga user berhak
        mendapatkan akses
        terhadap fitur REKSA, BACA-IN, dan SIKAT.
    </p>

    <div class="row">
        <div class="col-sm-12 col-lg-6 align-items-center d-flex justify-content-center">
            <div class="d-flex flex-column align-items-center" style="width: fit-content">
                <img src="/assets/images/icons/ktp.svg" alt="ktp" height="200" class="mb-2">
                <p class="small-text opacity-60">Contoh Gambar untuk verifikasi KTP</p>
            </div>
        </div>

        <div class="col-sm-12 col-lg-6">
            <form action="/menu/verif/store" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="mb-3 d-flex flex-column">
                    <label for="input-ktp" class="small-text opacity-60 mb-2 fw-bold">
                        Foto KTP (png, jpeg, jpg)
                    </label>
                    <label for="input-ktp" class="input-ktp mb-2">
                        <i class="bi bi-folder2-open"></i>
                        <span id="label-input-ktp">Unggah Foto KTP</span>
                        <input type="file" class="form-control" id="input-ktp" name="ktp">
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Pengajuan Verifikasi Akun</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputKtp = document.getElementById('input-ktp');
            const labelInputKtp = document.getElementById('label-input-ktp');

            inputKtp.addEventListener('change', function(event) {
                const fileName = event.target.files[0] ? event.target.files[0].name : 'Unggah Foto KTP';
                labelInputKtp.innerHTML = fileName;
            });
        });
    </script>
@endpush

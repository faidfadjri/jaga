<div class="tab-pane p-3 fade rounded-2 mt-2" id="sikat" role="tabpanel" aria-labelledby="sikat-tab"
    style="background: #EBF4FF">
    <p class="paragpraph mb-3">
        <strong>SIKAT</strong> adalah layanan JAGA untuk proses pengaduan data kriminal yang ditemukan oleh user, Data
        akan diverifikasi
        oleh pihak yang berwenang. Proses pengaduan hanya bisa dilakukan oleh akun yang ter-verifikasi
    </p>

    <div class="row">
        <div class="col-12">
            <form action="">
                <div class="mb-3 d-flex flex-column">
                    <label for="kategori-kasus" class="small-text opacity-60 mb-2 fw-bold">
                        Pilih Kategori Kasus
                    </label>
                    <select name="kategori-kasus" id="kategori-kasus" class="form-control" required>
                        <option value="">Pilih Kategori Kasus</option>
                        <option value="Penipuan">Penipuan</option>
                        <option value="Narkotika">Narkotika</option>
                        <option value="Kekerasan">Kekerasan</option>
                    </select>
                </div>

                <div class="mb-3 d-flex flex-column">
                    <label for="lokasi-kejadian" class="small-text opacity-60 mb-2 fw-bold">
                        Masukan Lokasi Kejadian
                    </label>
                    <input type="text" class="form-control" id="lokasi-kejadian"
                        placeholder="Masukan Lokasi Kejadian" required>
                </div>

                <div class="mb-3 d-flex flex-column">
                    <label for="waktu-kejadian" class="small-text opacity-60 mb-2 fw-bold">
                        Waktu Kejadian
                    </label>
                    <input type="time" id="waktu-kejadian" class="form-control" placeholder="Masukan Lokasi Kejadian"
                        required>
                </div>

                <div class="mb-3 d-flex flex-column">
                    <label for="bukti-kejadian" class="small-text opacity-60 mb-2 fw-bold">
                        Unggah Bukti Kejadian ( dapat berupa foto maupun video )
                    </label>
                    <label for="bukti-kejadian" class="input-file mb-2">
                        <i class="bi bi-folder2-open"></i>
                        <span id="label-bukti-kejadian">Unggah Bukti Kejadian</span>
                        <input type="file" class="form-control" id="bukti-kejadian">
                    </label>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputKtp = document.getElementById('bukti-kejadian');
            const labelInputKtp = document.getElementById('label-bukti-kejadian');

            inputKtp.addEventListener('change', function(event) {
                const fileName = event.target.files[0] ? event.target.files[0].name : 'Unggah Foto KTP';
                labelInputKtp.innerHTML = fileName;
            });
        });

        $(document).ready(function() {
            $("#ktp-form").submit(function(e) {
                e.preventDefault();

                const inputKtp = $('#bukti-kejadian')[0].files;

                if (inputKtp.length === 0) {
                    alert('Silakan unggah bukti kejadian terlebih dahulu.');
                    return;
                }

                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            title: "Selamat!",
                            text: "Proses verifikasi KTP berhasil!",
                            icon: "success"
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: "Oops!",
                            text: xhr?.responseJSON?.message,
                            icon: "error"
                        });
                    }
                });
            });
        });
    </script>
@endpush

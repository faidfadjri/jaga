@extends('templates.index')

@push('css')
    <link rel="stylesheet" href="/css/auth/auth.css">
@endpush

@section('content')
    <section class="gradient-background d-flex align-items-center justify-content-center">
        <div class="register-box">
            <div class="heading mb-4">
                <a href="/auth/login" class="d-flex align-items-center mb-3 btn btn-link m-0 p-0">
                    <i data-feather="arrow-left" style="height: 14px"></i> Kembali ke login
                </a>
                <h2 class="headline-5 primary">Daftar Akun</h2>
                <p class="paragraph opacity-60">Silahkan lengkapi form berikut</p>
            </div>

            <form id="register-form" enctype="multipart/form-data">
                @csrf
                <div class="d-flex align-items-center gap-4 mb-4">
                    <div class="profile-image bg-secondary rounded-circle">
                        <img id="profile-image-preview" src="/assets/images/default.svg" alt="default-profile-picture"
                            width="100" height="100">
                    </div>
                    <div>
                        <p class="tiny-text mb-2 opacity-60"><span style="color: red">*</span> File yang didukung ( jpg,
                            jpeg, png ) maksimal 5mb</p>
                        <label for="profile-picture-input" id="profile-picture" class="small-text">
                            <input required type="file" id="profile-picture-input" name="avatar" accept="image/*"
                                style="display: none;" required>
                            <span id="upload-text">Unggah Foto Profil</span>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 d-flex flex-column gap-3">
                        <div class="d-flex flex-column">
                            <label for="email" class="form-label">Email</label>
                            <input required type="email" id="email" name="email"
                                class="form-control rounded-1 paragraph px-3 py-2" placeholder="Masukan email aktif">
                        </div>

                        <div class="d-flex flex-column">
                            <label for="fullName" class="form-label">Nama Lengkap</label>
                            <input required type="text" id="fullName" name="fullName"
                                class="form-control rounded-1 paragraph px-3 py-2" placeholder="Masukan nama lengkap">
                        </div>

                        <div class="d-flex flex-column">
                            <label for="phone" class="form-label">No. Telp</label>
                            <input required type="number" id="phone" name="phone"
                                class="form-control rounded-1 paragraph px-3 py-2" placeholder="Masukan nomor aktif">
                        </div>
                    </div>
                    <div class="col-6 d-flex flex-column justify-content-between gap-3">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex flex-column">
                                <label for="password" class="form-label">Kata sandi</label>
                                <input required type="password" id="password" name="password"
                                    class="form-control rounded-1 paragraph px-3 py-2" placeholder="Masukan kata sandi">
                            </div>

                            <div class="d-flex flex-column">
                                <label for="password-confirmation" class="form-label">Konfirmasi Kata sandi</label>
                                <input required type="password" id="password-confirmation" name="password_confirmation"
                                    class="form-control rounded-1 paragraph px-3 py-2" placeholder="Konfirmasi kata sandi">
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Daftar Akun</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.getElementById('profile-picture-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const label = document.getElementById('profile-picture');
            const uploadText = document.getElementById('upload-text');
            const imgPreview = document.getElementById('profile-image-preview');

            if (file) {
                // Change the text inside the span to the file name
                uploadText.textContent = file.name;

                // Update the image preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    imgPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('password-confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password-confirmation').value;

            if (password !== passwordConfirmation) {
                document.getElementById('password-confirmation').setCustomValidity('Passwords do not match');
            } else {
                document.getElementById('password-confirmation').setCustomValidity('');
            }
        });

        $(document).ready(function() {
            $("#register-form").submit(function(e) {
                e.preventDefault();

                // Create FormData object
                var formData = new FormData(this);

                $.ajax({
                    url: '/auth/verification/register', // Replace with your API endpoint
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            title: "Selamat!",
                            text: response?.message ||
                                "Proses pendaftaran akun berhasil",
                            icon: "success"
                        });
                    },
                    error: function(xhr) {
                        // Handle error
                        var errors = xhr.responseJSON.errors;
                        var errorMessages = '';
                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '\n';
                        });
                        alert('Registration failed:\n' + errorMessages);
                    }
                });
            });
        });
    </script>
@endpush

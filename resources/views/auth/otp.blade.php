@extends('templates.index')

@push('css')
    <link rel="stylesheet" href="/css/auth/auth.css">
@endpush

@section('content')
    <section class="gradient-background d-flex align-items-center justify-content-center">
        <div class="otp-box">
            <div class="heading mb-4">
                <a href="/auth/register" class="d-flex align-items-center mb-3 btn btn-link m-0 p-0">
                    <i data-feather="arrow-left" style="height: 14px"></i> Kembali ke pendaftaran
                </a>
                <h2 class="headline-5 primary">Verifikasi Email</h2>
                <p class="paragraph opacity-60">Kami telah mengirimkan email verifikasi ke {{ $email }}</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="m-0 p-0 px-3">
                        @foreach ($errors->all() as $error)
                            <li class="m-0 p-0">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="otp-form" action="/auth/verification/otp" method="POST">
                @csrf
                <div class="otp-group">
                    @for ($i = 1; $i <= 6; $i++)
                        <input type="text" class="otp headline-2" maxlength="1" pattern="[0-9]"
                            name="otp-{{ $i }}" oninput="nextInput(this)" onpaste="handlePaste(event)">
                    @endfor
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function nextInput(currentInput) {
            if (currentInput.value.length >= currentInput.maxLength) {
                var next = currentInput.nextElementSibling;
                if (next == null) return;
                next.focus();
            }
        }

        function prevInput(currentInput) {
            if (currentInput.value.length == 0) {
                var prev = currentInput.previousElementSibling;
                if (prev == null) return;
                prev.focus();
            }
        }

        function handlePaste(event) {
            var clipboardData, pastedData;
            event.stopPropagation();
            event.preventDefault();
            clipboardData = event.clipboardData || window.clipboardData;
            pastedData = clipboardData.getData('text/plain');
            var otpInputs = document.querySelectorAll('.otp');
            for (var i = 0; i < otpInputs.length && i < pastedData.length; i++) {
                otpInputs[i].value = pastedData[i];
                nextInput(otpInputs[i]);
            }
        }

        // Function to handle the backspace key press
        function handleBackspace(currentInput, event) {
            if (event.keyCode === 8 && currentInput.value.length === 0) {
                prevInput(currentInput);
            }
        }

        // Function to submit the form when Enter is pressed on the last input field
        document.querySelector('.otp-group').lastElementChild.addEventListener('keypress', function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("otp-form").submit();
            }
        });

        // Attach the handleBackspace function to each input
        document.querySelectorAll('.otp').forEach(function(input) {
            input.addEventListener('keydown', function(event) {
                handleBackspace(input, event);
            });
        });
    </script>
@endpush

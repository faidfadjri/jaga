<div class="tab-pane p-3 fade rounded-2 mt-2 px-4 py-3" id="bacain" role="tabpanel" aria-labelledby="bacain-tab"
    style="background: #EBF4FF">
    <p class="paragpraph mb-3">
        BACA-IN memungkinkan anda untuk melihat data kriminal orang lain dengan scan barcode mereka hal ini bertujuan
        untuk memastikan orang yang berhubungan sosial dengan anda tidak Menelik pengalaman / histori tindakan kriminal.
    </p>

    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="bg-white p-2" style="width: fit-content">
                <div class="barcode">
                    {!! DNS1D::getBarcodeHTML(session('user')->id, 'C39', 5, 100) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <button id="btn-scan" class="btn btn-primary">Scan Barcode</button>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div id="reader" style="width:500px;"></div>
        </div>
    </div>
</div>



<script>
    document.getElementById('btn-scan').addEventListener('click', function() {
        const html5QrCode = new Html5Qrcode("reader");
        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            // Handle the result here
            console.log(`Code scanned: ${decodedText}`);

            location.href = "/menu?userId=" + decodedText;

            // Stop scanning
            html5QrCode.stop().then((ignore) => {
                // QR Code scanning is stopped.
            }).catch((err) => {
                // Stop failed, handle it.
            });
        };
        const config = {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        };

        // If you want to prefer front camera
        html5QrCode.start({
            facingMode: "environment"
        }, config, qrCodeSuccessCallback);
    });
</script>

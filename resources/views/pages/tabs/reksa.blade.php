<div class="tab-pane p-3 fade rounded-2 mt-2 px-4 py-3" id="reksa" role="tabpanel" aria-labelledby="reksa-tab"
    style="background: #EBF4FF">
    <p class="paragpraph">
        <strong>REKSA</strong> adalah layanan JAGA yang memungkinkan kamu melihat data history kriminal kamu sendiri
        maupun orang lain
        yang menyetujuinya
    </p>

    <br>
    <p class="paragpraph">
        Data Catatan Kriminal <strong>{{ $user?->username }}</strong>
    </p>


    <div class="row mt-3">
        <div class="col-12 d-flex flex-column gap-3" id="crimes-wrapper">
            {{-- <div class="card border-0">
                <div class="card-body">
                    <h5 class="card-title headline-6 mb-2 primary">
                        KATEGORI KASUS
                    </h5>
                    <div class="d-flex align-items-center gap-3 primary">
                        <i class="bi bi-pin-map"></i>
                        <p class="paragpraph fw-medium">Lokasi Kejadian</p>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function() {
            const userId = "{{ $user?->id }}";


            $.ajax({
                type: "GET",
                url: "/detail-record",
                data: {
                    user_id: userId
                },
                dataType: "json",
                success: function(response) {
                    const crimes = response?.records.crimes;
                    console.log(crimes);
                    let crimesHTML = '';
                    crimes.forEach(record => {
                        crimesHTML += `
                         <div class="card border-0">
                            <div class="card-body">
                                <h5 class="card-title headline-6 mb-2 primary">
                                    ${record?.crimeType}
                                </h5>
                                <div class="d-flex align-items-center gap-3 primary">
                                    <i class="bi bi-pin-map"></i>
                                    <p class="paragpraph fw-medium">${record?.location}</p>
                                </div>
                            </div>
                        </div>
                    `
                    });

                    $('#crimes-wrapper').html(crimesHTML);

                },
                error: function(xhr, status, error) {
                    console.error('Error status:', status);
                    console.error('Error message:', error);
                    console.error('Response text:', xhr.responseText);
                }
            });
        });
    </script>
@endpush

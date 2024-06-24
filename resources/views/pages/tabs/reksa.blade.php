<div class="tab-pane p-3 fade rounded-2 mt-2 px-4 py-3" id="reksa" role="tabpanel" aria-labelledby="reksa-tab"
    style="background: #EBF4FF">
    <p class="paragpraph">
        <strong>REKSA</strong> adalah layanan JAGA yang memungkinkan kamu melihat data history kriminal kamu sendiri
        maupun orang lain
        yang menyetujuinya
    </p>

    <br>
    <p class="paragpraph">
        Data Catatan Kriminal <strong>{{ $username }}</strong>
    </p>

    @foreach ($records as $record)
    <div class="card px-4 py-3  mt-3">
            <h4 class="card-title fw-bold">{{$record->crimeType}}</h4>
            <h6  class="card-text opacity-50">{{$record->description}}</h6>
            <div class="toast-header">
                <i class="bi bi-geo-alt mx-2"></i>
                <p class="fw-medium">{{$record->location}}</p>
            </div>
    </div>
    @endforeach

</div>

    




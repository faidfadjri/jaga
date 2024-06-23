@extends('templates.index')

@section('content')
    @include('templates.navbar')
    <div class="container-fluid p-5">
        <div class="row">
            <div class="col-12 mb-5">
                <h2 class="headline-3 primary">Selamat datang kembali, Syamsul!</h2>
                <p class="paragraph opacity-60">Yuk siap-siap bantu <strong>Teman JAGA</strong> hari ini</p>
            </div>

            <div class="col-12" style="background: #EBF4FF;">
                @session('success')
                    <div class="alert alert-primary" role="alert">
                        {{ session('success') }}
                    </div>
                @endsession

                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="container bg-white my-3 py-4 px-4 rounded-3">
                    <div class="d-flex flex-column">
                        <h4 class="headline-4 primary">Pelaporan Kasus Kriminal</h4>
                        <p class="paragraph opacity-60">Segera verifikasi kasus tersebut</p>
                    </div>

                    <div class="d-flex justify-content-end">
                        <form class="d-flex" style="width: fit-content" method="GET">
                            <input class="form-control me-2" type="search" name="search" placeholder="Search"
                                aria-label="Search" value="{{ request('search') }}">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>

                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col" style="background: #F9FAFB;" class="p-3">No</th>
                                <th scope="col" style="background: #F9FAFB;" class="p-3">Pelapor</th>
                                <th scope="col" style="background: #F9FAFB;" class="p-3">Status</th>
                                <th scope="col" style="background: #F9FAFB;" class="p-3">Tanggal</th>
                                <th scope="col" style="background: #F9FAFB;" class="p-3">Kasus</th>
                                <th scope="col" style="background: #F9FAFB;" class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $index => $report)
                                <tr>
                                    <td class="p-3">{{ $reports->firstItem() + $index }}</td>
                                    <td class="p-3">{{ $report->pelapor->email }}</td>
                                    <td class="p-3">{{ $report->status == 0 ? 'Pending' : 'Completed' }}</td>
                                    <td class="p-3">{{ $report->created_at->format('d-m-Y') }}</td>
                                    <td class="p-3">
                                        <h5 class="headline-6">
                                            {{ $report->crimeType }}
                                        </h5>
                                        <p class="paragraph opacity-60">
                                            {{ $report->description }}
                                        </p>
                                    </td>
                                    <td class="p-3">
                                        <button class="btn btn-primary-outline px-3 action-button"
                                            data-report-id="{{ $report->id }}"
                                            data-evidence="{{ $report->news->fileName }}"
                                            data-pelapor="{{ $report->pelapor->fullName }}"
                                            data-kasus="{{ $report->crimeType }}" data-lokasi="{{ $report->location }}"
                                            style="width: fit-content">
                                            Action
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $reports->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content p-2">
                <div class="modal-header d-flex flex-column align-items-start">
                    <h5 class="headline-5 primary" id="detail-modal-label">
                        Detail Pelaporan Kasus
                    </h5>
                    <p class="paragraph opacity-60">Silahkan verifikasi data kasus berikut dengan teliti</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/report-verification" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <img id="detail-evidence" alt="evidence" height="200">
                                <input type="hidden" name="reportId" id="reportId">
                                <p class="small-text opacity-60 mb-2 mt-3">* Verifikasi status kebenaran</p>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="verification"
                                            id="verification1">
                                        <label class="form-check-label" for="verification1">
                                            Benar
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="verification"
                                            id="verification2" checked>
                                        <label class="form-check-label" for="verification2">
                                            Tidak Benar
                                        </label>
                                    </div>
                                </div>

                                <p class="small-text opacity-60 mb-2 mt-3">* Kontak Pelapor</p>
                                <a href="" id="detail-whatsapp-button" class="btn btn-primary-outline"
                                    style="width: fit-content">
                                    Hubungi melalui Whatsapp
                                </a>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="detailPelapor" class="form-label">Pelapor</label>
                                    <input type="text" id="detailPelapor" class="form-control mb-2" readonly>
                                    <p class="small-text italic">
                                        “ Dimohon untuk menjaga kerahasiaan data pelapor
                                        Pasal 5 ayat (2) UU 13/2006
                                    </p>
                                </div>

                                <div class="mb-3">
                                    <label for="detailKasus" class="form-label">Kasus</label>
                                    <input type="text" id="detailKasus" class="form-control mb-2" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="detailLokasi" class="form-label">Lokasi</label>
                                    <input type="text" id="detailLokasi" class="form-control mb-2" readonly>
                                </div>


                                <div class="mb-3">
                                    <label for="detailBeritaAcara" class="form-label">Berita Acara</label>
                                    <input type="file" id="detailBeritaAcara" name="news"
                                        class="form-control mb-2" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" style="width: fit-content" type="submit">
                            Tutup Kasus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.action-button').click(function(e) {
            e.preventDefault();

            var button = $(this);
            var report = button.data('report-id')
            var evidence = button.data('evidence');
            var lokasi = button.data('lokasi');
            var kasus = button.data('kasus');
            var pelapor = button.data('pelapor');


            $("#detailModal").modal('show');

            $("#reportId").val(report);
            $("#detailLokasi").val(lokasi);
            $("#detailPelapor").val(pelapor);
            $("#detailKasus").val(kasus);
            $("#detail-evidence").attr('src', '/assets/crime/' + evidence)
        });
        var modal = $(this)

        $('#contact-whatsapp').on('click', function() {
            // Logic to contact via WhatsApp
        })

        $('#verify-true').on('click', function() {
            // Logic for verifying the case as true
        })

        $('#verify-false').on('click', function() {
            // Logic for verifying the case as false
        })
    </script>
@endpush

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
                <div class="container bg-white my-3 py-4 px-4 rounded-3">
                    <div class="d-flex flex-column">
                        <h4 class="headline-4 primary">Catatan Kriminal</h4>
                        <p class="paragraph opacity-60">Tambahkan data catatan kriminal sesuai nama pengguna</p>
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
                                <th scope="col" style="background: #F9FAFB;" class="p-3">Nama Akun</th>
                                <th scope="col" style="background: #F9FAFB;" class="p-3">Tanggal Pendaftaran</th>
                                <th scope="col" style="background: #F9FAFB;" class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $index => $record)
                                <tr>
                                    <td class="p-3">{{ $records->firstItem() + $index }}</td>
                                    <td class="p-3">{{ $record->email }}</td>
                                    <td class="p-3">{{ $record->created_at->format('d-m-Y') }}</td>
                                    <td class="p-3">
                                        @if ($record->isNIKVerified)
                                            <button class="btn btn-primary-outline px-3 action-button"
                                                data-user-id="{{ $record->id }}" data-avatar="{{ $record->avatar }}"
                                                style="width: fit-content">
                                                Rekap
                                                Catatan
                                                Kriminal
                                            </button>
                                        @else
                                            <p class="primary px-3 py-2" style="background: #F2F2F2; width: fit-content">
                                                Persyaratan
                                                Belum Lengkap
                                            </p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $records->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detail-modal" tabindex="-1" aria-labelledby="detail-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content p-2">
                <div class="modal-header d-flex flex-column align-items-start">
                    <h5 class="headline-5 primary" id="detail-modal-label">
                        Catatan Kriminal
                    </h5>
                    <p class="paragraph opacity-60">Silahkan tambahkan catatan kriminal pengguna</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 d-flex mb-2">
                            <img id="avatar-image" style="background: #BEDCFF" class="rounded-circle" width="80"
                                height="80" alt="image">

                            <div class="ms-4">
                                <label for="detail-username" class="form-label">Nama Akun</label>
                                <input type="text" id="detail-username" class="form-control" style="background: #f2f2f2"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-12" style="background: #EBF4FF">
                            <div class="row p-3">
                                <div class="col-6 bg-white p-3">
                                    <form id="crime-submission-form">
                                        <input type="hidden" id="userId" name="user_id">
                                        <div class="mb-3">
                                            <label for="crimeCategory" class="form-label">Kategori Kasus *</label>
                                            <select id="crimeCategory" class="form-control" name="record[category]"
                                                required>
                                                <option value="Penipuan">Penipuan</option>
                                                <option value="Penganiayaan">Penganiayaan</option>
                                                <option value="Pemerkosaan">Pemerkosaan</option>
                                                <option value="Lainya">Lainya</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="crimeDescription" class="form-label">Deskripsi Kasus *</label>
                                            <input type="text" id="crimeDescription" class="form-control"
                                                placeholder="Masukan Deskripsi Kasus" name="record[description]" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="crimeLocation" class="form-label">Lokasi Kasus *</label>
                                            <input type="text" id="crimeLocation" class="form-control"
                                                placeholder="Masukan Lokasi Kasus" name="record[location]" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="crimeDate" class="form-label">Waktu Kejadian *</label>
                                            <input type="date" id="crimeDate" class="form-control"
                                                placeholder="Masukan waktu Kasus" name="record[date]" required>
                                        </div>

                                        <button class="btn btn-primary d-flex align-items-center gap-2"
                                            style="width: fit-content" type="submit">
                                            <i class="bi bi-plus"></i>
                                            Tambahkan
                                        </button>
                                    </form>
                                </div>
                                <div class="col-6 d-flex flex-column gap-3" id="crimes-wrapper">
                                    {{-- <div class="card border-0 p-2 px-3 bg-white">
                                        <p class="headline-6 primary fw-bold">KATEGORI KASUS</p>
                                        <p class="paragraph opacity-60 mb-3">NAMA KASUS</p>

                                        <div class="d-flex align-items-center gap-3 primary">
                                            <i class="bi bi-pin-fill"></i>
                                            <p class="paragraph mb-2">Lokasi Kejadian</p>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const formFields = ['crimeName', 'crimeCategory', 'crimeDescription', 'crimeLocation', 'crimeDate'];
            let currentUserId;

            $('.action-button').click(function(e) {
                const userId = $(this).data('user-id');
                currentUserId = userId;
                getDetail(userId);
            });


            $(document).on('click', '.detail-card', function(e) {
                e.preventDefault();
                const recordId = $(this).data('record-id');
                if (confirm("Yakin hapus data ini ?")) {
                    $.ajax({
                        type: "DELETE",
                        url: "/admin/delete-record/" + recordId,
                        dataType: "json",
                        success: function(response) {
                            const userId = response?.userId;
                            getDetail(userId);
                        },
                        error: function({
                            xhr,
                            response,
                            error
                        }) {
                            console.log(error);
                        }
                    });
                }
            });

            const getDetail = (userId) => {
                $.ajax({
                    type: "GET",
                    url: "/admin/detail-record",
                    data: {
                        user_id: userId
                    },
                    dataType: "json",
                    success: function(response) {
                        const records = response.records;

                        // Show the modal
                        $('#detail-modal').modal('show');

                        // Set the user details in the modal
                        $("#avatar-image").attr('src', `/assets/users/${records.avatar}`);
                        $("#detail-username").val(records.username);
                        $("#userId").val(userId);

                        // Reset form fields
                        formFields.forEach(element => {
                            $(`#${element}`).val('');
                        });


                        const crimes = records?.crimes ?? [];
                        let crimesHTML = '';
                        crimes.forEach(element => {
                            crimesHTML += `<div class="card border-0 p-2 px-3 bg-white detail-card" data-record-id="${element?.id}">
                                        <p class="headline-6 primary fw-bold">${element?.crimeType}</p>
                                        <p class="paragraph opacity-60 mb-3">${element?.description}</p>

                                        <div class="d-flex align-items-center gap-3 primary">
                                            <i class="bi bi-pin-fill"></i>
                                            <p class="paragraph mb-2">${element?.location}</p>
                                        </div>
                                    </div>`;
                        });
                        $('#crimes-wrapper').html(crimesHTML);

                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching user details:', status, error);
                    }
                });
            }

            $('#crime-submission-form').submit(function(e) {
                e.preventDefault();
                const formData = $(this).serialize() + `&user_id=${currentUserId}`;

                $.ajax({
                    type: 'POST',
                    url: '/admin/add-record',
                    data: formData,
                    success: function(response) {
                        getDetail(response?.userId);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: "error",
                            title: "Server error",
                            text: error,
                        });
                    }
                });
            });
        });
    </script>
@endpush

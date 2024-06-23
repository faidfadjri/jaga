    @extends('templates.index')

    @section('content')
        @include('templates.navbar')

        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-12 mb-5">
                    <h2 class="headline-4">Selamat datang kembali, Syamsul!</h2>
                    <p class="paragraph opacity-60">Yuk siap-siap bantu <strong>Teman JAGA</strong> hari ini</p>
                </div>

                <div class="col-12" style="background: #EBF4FF;">
                    <div class="container bg-white my-3 pb-4 pt-3 px-3 rounded-3">
                        <div class="d-flex flex-column">
                            <h4 class="headline-5">Catatan Kriminal</h4>
                            <p class="paragpraph opacity-60">Tambahkan data catatan kriminal sesuai nama pengguna</p>
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
                                            <button class="btn btn-primary-outline px-3" style="width: fit-content">Rekap
                                                Catatan
                                                Kriminal</button>
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
    @endsection

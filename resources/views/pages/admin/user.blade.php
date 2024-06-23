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
                                <th scope="col" style="background: #F9FAFB;" class="p-3">Email</th>
                                <th scope="col" style="background: #F9FAFB;" class="p-3">Ponsel</th>
                                <th scope="col" style="background: #F9FAFB;" class="p-3">Tanggal Registrasi</th>
                                <th scope="col" style="background: #F9FAFB;" class="p-3">Status</th>
                                <th scope="col" style="background: #F9FAFB;" class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td class="p-3">{{ $users->firstItem() + $index }}</td>
                                    <td class="p-3">{{ $user->email }}</td>
                                    <td class="p-3">{{ $user->phone }}</td>
                                    <td class="p-3">{{ $user->isNIKVerified == 0 ? 'Pending' : 'Verified' }}</td>
                                    <td class="p-3">{{ $user->created_at->format('d-m-Y') }}</td>
                                    <td class="p-3">
                                        <button class="btn btn-primary-outline px-3 action-button"
                                            style="width: fit-content">
                                            Action
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

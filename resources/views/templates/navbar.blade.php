<nav class="navbar navbar-expand-lg" style="z-index: 100; position: sticky; top: 0;">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="#">
            <img src="/assets/images/logo.svg" alt="JAGA">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse bg-white px-3 py-2 d-lg-flex align-items-lg-center justify-content-lg-between"
            id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 ms-5 mb-lg-0 gap-2" style="width: fit-content">

                @if (session('user')?->role != 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ session()->get('active') == 'home' ? 'active' : '' }}" aria-current="page"
                            href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ session()->get('active') == 'about' ? 'active' : '' }}"
                            href="/about">Tentang
                            Kami</a>
                    </li>

                    @session('user')
                        <li class="nav-item">
                            <a class="nav-link {{ session()->get('active') == 'menu' ? 'active' : '' }}"
                                href="/menu">Menu</a>
                        </li>
                    @endsession
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ session()->get('active') == 'record' ? 'active' : '' }}"
                            aria-current="page" href="/admin">Catatan Kriminal</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ session()->get('active') == 'report' ? 'active' : '' }}"
                            aria-current="page" href="/admin/report">Pelaporan Kasus</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ session()->get('active') == 'user' ? 'active' : '' }}" aria-current="page"
                            href="/admin/user">Users</a>
                    </li>
                @endif




            </ul>

            @if (!session()->get('user'))
                <a href="/auth/login" class="btn btn-primary-outline px-4 ms-lg-3" style="width: fit-content">Masuk /
                    Daftar</a>
            @else
                <div class="dropdown">
                    <button class="border-0 d-flex align-items-center bg-transparent gap-3 dropdown-toggle"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <p>{{ session()->get('user')->fullName }}</p>

                        <img src="/assets/users/{{ session()->get('user')->avatar }}" height="40" width="40">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="/auth/logout">Logout</a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</nav>

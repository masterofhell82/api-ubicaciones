<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

        <img class="img-fluid navbar-brand" src="{{ asset('assets/img/earthpoint.png') }}" width="50" height="50">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav d-flex w-100">
                <a class="nav-link active" aria-current="page" href="/admin/dashboard">Dashboard</a>
                <a class="nav-link active" aria-current="page" href="/users">Users</a>
                <div class="ms-auto text-white d-flex align-items-center">
                    <i class="fa-regular fa-user mx-2"></i> {{ Auth::user()->name }}
                    <a href="javascript:;" id="logout" class="nav-link mx-2" title="Logout">
                        <span class="text-white"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

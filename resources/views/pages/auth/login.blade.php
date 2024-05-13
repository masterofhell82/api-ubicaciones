@extends('layout.index')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">
    <div class="row w-100 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="col-md-4 pr-md-0 d-flex align-items-center justify-content-center">
                        <div class="auth-left-wrapper">
                            <img class="img-fluid" src="{{ asset('assets/img/earthpoint.jpg') }}" >
                        </div>
                    </div>
                    <div class="col-md-8 pl-md-0">
                        <div class="auth-form-wrapper px-4 py-5">
                            <h5 class="text-muted font-weight-normal mb-4">Bienvenido! Accede a tu cuenta.</h5>
                            <form class="forms-sample" id="loginForm" action="#">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Correo electronico </label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" autocomplete="current-password" placeholder="Contraseña" required>
                                </div>
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        <input type="checkbox" id="remember_token" name="remember_token" class="form-check-input">
                                        Remember me
                                    </label>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary mr-2 mb-2 mb-md-0" id="btnLogin">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection


@push('custom-scripts')
<script src="{{ asset('assets/src/auth/user.js') }}"></script>
@endpush

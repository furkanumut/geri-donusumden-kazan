@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="height: 90vh">
    <div class="card shadow p-3 mb-5 bg-body rounded w-50">
        <div class="card-header p-3 text-center">
            <h4><b>Kayıt Ol</b></h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Ad Soyad</label>

                    <div class="mb-2">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Adresi</label>

                    <div class="mb-2">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Parola</label>

                    <div class="mb-2">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Parolayı Doğrula</label>

                    <div class="mb-2">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary block col-md-12 p-2 mt-3">Devam Et -></button>
                <div class="mt-4">
                    <label class="col-md-12 text-end"><a href="{{ route('login') }}" style="text-decoration: none;">Zaten bir hesabın varmı?</a></label>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

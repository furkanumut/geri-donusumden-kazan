@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('partials.sidebar')

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Hesap Ayarları</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Ad Soyad</label>

                            <div class="mb-2">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

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
                                <input id="email" disabled type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Yeni Parola</label>

                            <div class="mb-2">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="iban" class="col-md-4 col-form-label text-md-right">IBAN Numarası</label>

                            <div class="mb-2">
                                <input id="iban" type="iban" class="form-control @error('iban') is-invalid @enderror" name="iban_number" value="{{ $user->iban_number }}" autocomplete="new-iban">

                                @error('iban_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary block col-md-12 p-2 mt-3 mb-4">Güncelle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

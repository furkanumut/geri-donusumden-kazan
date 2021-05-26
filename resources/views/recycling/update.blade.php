@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('partials.sidebar')

        <div class="col-md-9">
            <form action="{{ route('recycling.update', $recycling->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>2. Aşama: Çöpe attığını kanıtla!</span>
                        <button type="submit" class="btn btn-primary" id="image-upload" style="display: none;">Fotoğrafı Yükle</button>
                    </div>

                    <div class="card-body">
                        <div class="ml-2 col-md-12 justify-content-center>
                            <div id=" msg">Teşekkür ederim, elindeki geri döünüşümü bir geri dönüşüm kutusuna atabilirsin. Attığını teyit etmemiz için attıktan sonra bir fotoğrafını daha gönderince bu işlem tamamdır. Tabiki bu işlemi hemen yapmana gerek yok ama ne kadar kısa bir süre içerisinde sisteme yüklersen o kadar iyi bir iş çıkartacağınıda unutmaman lazım.
                        </div>

                        @if($errors->count() > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>
                                <div class="text-danger">{{ $error }}</div>
                            </li>
                            @endforeach
                        </ul>
                        @endif

                        <form method="post" id="image-form">
                            <input type="file" name="image" class="file @error('image') is-invalid @enderror" accept="image/*">
                            <div class="input-group my-3">
                                <input type="text" class="form-control" disabled placeholder="Geri Dönüşüm" id="file">
                                <div class="input-group-append">
                                    <button type="button" class="browse btn btn-primary">Fotoğrafını Seç...</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-12 justify-content-center d-flex">
                        <div class="ml-2 col-sm-6">
                            <img src="" id="input-preview" style="display: none;" class="img-thumbnail">
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
</div>

@endsection

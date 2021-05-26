@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('message'))
    <p class=" col-md-12 alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif

    <div class="row">
        @include('partials.sidebar')

        <div class="col-md-9">

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($recyclings as $recycling)
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <img src="{{ $recycling->recycling_photo }}" class="img-thumbnail">
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">
                                @switch($recycling->verified)
                                @case('bin_image_wait')
                                <a class="text-decoration-none" href="{{ route('recycling.edit', $recycling->id) }}">2.Fotoğrafı Yükle -></a>
                                @break
                                @case('approved_wait')
                                Yöneticilerin onayı bekleniyor.
                                @break
                                @case('not_approved')
                                Malesef onaylanmadı!
                                @break
                                @case('approved')
                                Onaylandı.
                                @break
                                @endswitch
                            </small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

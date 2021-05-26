@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('message'))
    <p class=" col-md-12 alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif

    <div class="row">
        @include('partials.sidebar')

        <div class="col-md-9">
            @if (!count($recyclings))
            <div class="card col-md-12">
                <div class="card-body">Şuanda onaylanacak bir istek bulunmamaktadır.</div>
            </div>
            @endif
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($recyclings as $recycling)
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header">{{ \Str::limit($recycling->user->name, 12) }}</div>
                        <div class="card-body">
                            <img src="{{ $recycling->recycling_photo }}" class="img-thumbnail">
                            <hr>
                            <img src="{{ $recycling->recycling_bin_photo }}" class="img-thumbnail">

                        </div>
                        <div class="card-footer d-flex justify-content-between">

                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($recycling->updated_at)->diffForHumans() }}
                            </small>
                            <div>
                                <a class="text-decoration-none" href="{{ route('recycling.confirm', ['confirm' => 'approved', 'recycling' => $recycling->id]) }}">
                                    <button class="btn btn-success">:)</button>
                                </a>
                                <a class="text-decoration-none" href="{{ route('recycling.confirm', ['confirm' => 'not_approved', 'recycling' => $recycling->id]) }}">
                                    <button class="btn btn-danger">:(</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>


        </div>
    </div>
</div>
@endsection

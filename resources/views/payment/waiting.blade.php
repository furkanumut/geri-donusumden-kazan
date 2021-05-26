@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('partials.sidebar')

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Ödeme Geçmişi</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ücret</th>
                                <th scope="col">Ödeme Türü</th>
                                <th scope="col">Ödeme Zamanı</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user_payments as $payment)
                            <tr>
                                <th scope="row">{{ $payment->is_success == 'waiting' ? 'Bekleniyor' : 'Ödeme Yapıldı' }}</th>
                                <td>{{ $payment->price }} ₺</td>
                                <td>{{ $payment->price_type == 'iban' ? 'IBAN' : 'Bağış' }}</td>
                                <td>{{ $payment->created_at == $payment->updated_at ? '' : $payment->updated_at   }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

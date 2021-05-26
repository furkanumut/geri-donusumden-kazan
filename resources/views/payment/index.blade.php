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
                                <th scope="col">Işlem Zamanı</th>
                                @if (auth()->user()->can('payment confirm'))
                                <th scope="col">Ad Soyad</th>
                                <th scope="col">IBAN</th>
                                <th scope="col">İşlem</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user_payments as $payment)
                            <tr>
                                <th scope="row">{{ $payment->is_success == 'waiting' ? 'Bekleniyor' : ($payment->is_success == 'unsuccessful' ? 'Onaylanmadı' : 'Ödeme Yapıldı') }}</th>
                                <td>{{ $payment->price }} ₺</td>
                                <td>{{ $payment->price_type == 'iban' ? 'IBAN' : 'Bağış' }}</td>
                                <td>{{ $payment->created_at == $payment->updated_at ? '' : $payment->updated_at   }}</td>
                                @if (auth()->user()->can('payment confirm'))
                                <td>
                                    {{ $payment->user->name }}
                                </td>
                                <td>
                                    {{ $payment->user->iban_number }}
                                </td>
                                <td>
                                    <a href="{{ route('payment.update', ['payment'=>$payment->id, 'operation'=>'successful']) }}"><button class="btn btn-success">:)</button></a>
                                    <a href="{{ route('payment.update', ['payment'=>$payment->id, 'operation'=>'unsuccessful']) }}"><button class="btn btn-danger">:(</button></a>
                                </td>
                                @endif
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

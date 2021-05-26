@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('partials.sidebar')

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Giriş Başarılı</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    Merhaba, sol tarafta bulunan paneli kullanarak işlem yapabilirsin. Her bir geri dönüşümün fotoğrafında yetkili kullanıcılar tarafından onaylanana kadar beklenir. Geri dönüşümün onaylandığı zaman 1 jeton kazanırsın. İstediğin zaman jetonları ödeme olarak IBAN adresine çekme talebinde bulunabilir ve ya websitemize bağış yapabilirsin.
                    <br/>
                    Yukardaki menüden "Yeni Bir Geri Dönüşüm" butonuna tıklayarak işe başlayabilirsin.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<div class="col-md-3 mb-4">
    <div class="card mb-3">
        <div class="card-header">Hoşgeldin, {{ Auth::user()->name }} ...</div>

        <div class="card-body">
            <ul class="li-without-dot list">
                <li><a class="text-decoration-none" href="{{ route('recycling.index') }}">Doğaya Yaptığın Katkılar</a></li>
                <li><a href="javascript:void(0);" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#exampleModal">Jetonlar ile Ödeme İste</a></li>
                <li><a href="{{ route('payment.index') }}" class="text-decoration-none">Ödeme Geçmişi</a></li>
                <li><a class="text-decoration-none" href="{{ route('user.edit') }}">Hesap Ayarları</a></li>
            </ul>
        </div>
    </div>

    @if(auth()->user()->hasRole('admin'))
    <div class="card mb-3">
        <div class="card-header">Yönetim</div>

        <div class="card-body">
            <ul class="li-without-dot list">
                <li><a class="text-decoration-none" href="{{ route('recycling.waiting_approved') }}">Onay Bekliyen Atıklar ({{ $waiting_recycling }})</a></li>
                <li><a class="text-decoration-none" href="{{ route('payment.waiting') }}">Ödeme İstekleri ({{ $waiting_payment }})</a></li>
            </ul>
        </div>
    </div>
    @endif

</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Jetonları Dönüştürme</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Toplam <b>{{ $total_recycling }} jetonun</b> bulunmaktadır. Her bir başarılı işlemin sonucunda bir jeton alırsın. Bu jetonları ister sisteme bağışlayabilirsin istersen iban numarana 14 iş günü içerisinde gönderebiliriz.
                <br>
                Hesap Ayarlarından IBAN numaranızı girmeyi unutmayınız!
            </div>
            <div class="modal-footer">
                <small class="me-auto">1 Jeton = 0,01 ₺</small>
                <a href="{{ $total_recycling == 0 ? '#' : route('payment.store', 'donate') }}">
                    <button {{ $total_recycling == 0 ? 'disabled' : '' }} type="button" class="btn btn-primary">BAGIS</button>
                </a>
                <a href="{{ $total_recycling == 0 ? '#' : route('payment.store', 'iban') }}">
                    <button {{ $total_recycling == 0 ? 'disabled' : '' }} type="button" class="btn btn-primary">IBAN</button>
                </a>
            </div>
        </div>
    </div>
</div>

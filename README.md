Bir süredir aklımda kodlamayı planladığım projeyi Üniversitede proje olarak belirledim ve projeyi kodlamaya başladım.

Bir birey elindeki atık maddeyi yere atmak yerine veya yerdeki bir atığı uygulama tarafından bir fotoğraf çekilerek gönderilecek. Daha sonra bu atığın türüne göre mümkünse kağıt, plastik, cam şişe gibi kategorize edilen geri dönüşüm kutularına eğer bir geri dönüşüm kutusu yoksa çevresinde bulunan çöp kutusuna attıktan sonra bir fotoğraf daha çekilir ve gönderilir. Bu işlemleri tamamlayan kullanıcı tekrardan bu işlemleri gerçekleştirebilir. İşlemlerin sonucunda her bir işlem onaya düşer, eğer onaylanırsa uygulama içi bir jeton hakkı elde eder. Bu jetonlar ile ister uygulamaya bağış yapabilir isterse jetonları paraya dönüştürerek kendi iban numarasına gönderilmesini talep edebilir.

## Kurulum Adımları

.env.example dosyasını .env olarak kopyalayalım.
```bash
cp .env.example .env
```

.env içerisinde veritabani ayarlarimizi yapalim
```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Gerekli paketleri indirelim
```bash
composer install
```

Bir app key oluşturalım
```bash
php artisan key:generate
```

Veritabanı işlemlerini yapalım

Bir app key oluşturalım
```bash
php artisan migrate --seed
```

Bir storage alanımızı publicde kısayol oluşturalım
```bash
php artisan storage:link
```

Projeyi ayağa kaldıralım.
```bash
php artisan serve
```

#### Varsayılan Giriş Bilgileri
Admin:
admin@admin.com:password

Standart Kullanıcı:
example@example.com:password

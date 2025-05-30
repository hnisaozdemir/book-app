#  Laravel Projesi Kurulum Kılavuzu

Bu proje [Laravel](https://laravel.com) PHP Framework kullanılarak geliştirilmiştir. Aşağıda yer alan adımları takip ederek projeyi lokal ortamda çalıştırabilirsiniz.

---

##  Gereksinimler

| Gereksinim | Sürüm |
|------------|--------|
| PHP        | >= 8.1 |
| Composer   | ✓      |
| Node.js    | >= 16  |
| NPM        | ✓      |
| MySQL/PostgreSQL | ✓ |
| Laravel    | 10.x   |

---

## ⚙️ Kurulum Adımları

# 1. Projeyi Klonla
git clone https://github.com/kullaniciAdi/proje-adi.git
cd proje-adi

# 2. Bağımlılıkları Yükle
composer install
npm install

# 3. Ortam Dosyasını Ayarla
cp .env.example .env

# .env dosyasını açıp aşağıdaki veritabanı ayarlarını yap
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=veritabani_adi
# DB_USERNAME=kullanici_adi
# DB_PASSWORD=sifre

# 4. Uygulama Anahtarını Oluştur
php artisan key:generate

# 5. Veritabanı Tablolarını Oluştur
php artisan migrate
php artisan db:seed

# 6. Ön Yüz Varlıklarını Derle
npm run dev
npm run build

# 7. Projeyi Başlat
php artisan serve

| Alan           | Bilgi                                                      |
| -------------- | ---------------------------------------------------------- |
| Geliştiriciler |  Hayrunnisa Özdemir                                     |
| E-posta     | [hayrunnisaozdemir6141@gmail.com](mailto:hayrunnisaozdemir6141@gmail.com)                    |



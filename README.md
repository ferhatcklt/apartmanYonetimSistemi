# Apartman Yönetim Sistemi

Bu proje, apartman yönetimini dijital ortamda kolaylaştırmak amacıyla geliştirilmiş kapsamlı bir sistemdir. Hem yönetici paneli hem de ziyaretçi (guest) tarafı bulunmaktadır. Proje; bina ayarları, aidat ödemeleri, gelir/gider yönetimi, proje yönetimi, duyurular, raporlama, temizlik planı ve daire sahipleri gibi modülleri içerir.

## Proje Amacı

Apartman yönetiminde kullanılan geleneksel yöntemlerin yerini alarak, dijital ortamda daha hızlı, hatasız ve etkili bir yönetim sağlamaktır. Yönetici paneli ile veriler girilebilir, güncellenebilir ve raporlanabilirken; ziyaretçi panelinde ise özet bilgiler ve finansal durum görüntülenir.

## Özellikler

**Yönetici Paneli:**
- **Ayarlar:**  
  Binada kaç daire olduğu, güncel aidat tutarı, ilk kasa ve log kayıtlarının girilmesi.
- **Yöneticiler:**  
  Yönetici ekleme, düzenleme ve silme işlemleri.
- **Aidat Ödemeleri:**  
  Yıllık aidat ödeme tablosu (Livewire ile dinamik güncelleme). Manuel aidat girişi yapılarak ödeme durumu (odendi veya odenmedi) veritabanına kaydedilir.
- **Gelir ve Gider Yönetimi:**  
  Gelir ve gider ekleme, düzenleme ve silme işlemleri. Gelirler isteğe bağlı olarak projeye bağlanabilir.
- **Proje Yönetimi:**  
  Projeler eklenir, düzenlenir ve silinir. Proje toplam tutarı, daire sayısına bölünerek daire başı ödeme hesaplanır.
- **Duyurular:**  
  Duyuru ekleme, düzenleme ve silme.
- **Raporlama:**  
  Seçilen ay ve yıl için bilanço, ödenmeyen daire sayısı ve güncel kasa hesaplamaları.
- **Temizlik Planı:**  
  İlk temizlik 16 Mart'ta başlar. Haftalık temizlik planı oluşturulur, her 4. hafta ödeme haftası olarak işaretlenir. Aylık bazda takvim görünümü ile plan yönetilebilir.
- **Daire Sahipleri:**  
  Daire sahibi kayıtları eklenip düzenlenir. (Admin panelinde) Guest tarafında sadece görüntüleme sağlanır.
- **Bildirimler:**  
  Eklenen, silinen veya güncellenen veriler için sabit pozisyonda toast bildirimleri gösterilir.

**Ziyaretçi (Guest) Paneli:**
- **Ana Sayfa:**  
  Toplam gelir, gider, beklenen gelir ve ödenmeyen daire sayısı özetleri; son 5 gelir ve gider kaydı; statik aidat çizelgesi.
- **Borçlular Sayfası:**  
  Her daire için ödenmemiş ay sayısı, toplam borç ve daire sahibi isimleri listelenir.
- **Daire Sahipleri:**  
  Daire sahipleri listesi, sadece görüntüleme amaçlı sunulur.

## Kullanılan Teknolojiler

- **Backend:** Laravel (8.x veya 9.x)
- **Dinamik Güncellemeler:** Livewire
- **Frontend:** Blade, Bootstrap 5, Bootstrap Icons
- **Veritabanı:** MySQL
- **Araçlar:** Composer, NPM

## Kurulum

1. **Projeyi Klonlayın:**  
   Projeyi Git üzerinden klonlayın ve proje dizinine geçin.

2. **Composer Bağımlılıklarını Yükleyin:**  
   Terminalde "composer install" komutunu çalıştırın.

3. **NPM Bağımlılıklarını Yükleyin ve Derleyin:**  
   Terminalde "npm install" ardından "npm run dev" komutlarını çalıştırın.

4. **.env Dosyasını Oluşturun ve Ayarlayın:**  
   Proje kök dizininde ".env.example" dosyasını ".env" olarak kopyalayın. Veritabanı bağlantı bilgileri, uygulama anahtarı ve diğer ayarları kendi ortamınıza göre düzenleyin.  
   "php artisan key:generate" komutunu çalıştırarak uygulama anahtarını oluşturun.

5. **Veritabanı Migration İşlemlerini Gerçekleştirin:**  
   Terminalde "php artisan migrate" komutunu çalıştırın.

6. **Sunucuyu Başlatın:**  
   Terminalde "php artisan serve" komutunu çalıştırın. Proje genellikle "http://127.0.0.1:8000" adresinde erişilebilir hale gelir.

## Kullanım

Yönetici paneline giriş yaptıktan sonra, üst menüde yer alan modüllerden işlemlerinizi gerçekleştirebilirsiniz. Örneğin, aidat ödemeleri, gelir/gider yönetimi, proje yönetimi, temizlik planı, daire sahipleri ve raporlama gibi modüller admin tarafından düzenlenebilir. Ziyaretçi panelinde ise özet bilgiler ve detaylı listeler görüntülenir.

## Katkıda Bulunma

Projeye katkıda bulunmak, hata bildirimleri yapmak veya yeni özellikler önermek için lütfen pull request açın veya GitHub üzerinden iletişime geçin.

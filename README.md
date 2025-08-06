<div align="center">  
  <a href="README.md"   >   TR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/TR.png" alt="TR" height="20" /></a>  
  <a href="README-EN.md"> | EN <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/US.png" alt="EN" height="20" /></a>  
  <a href="README-AZ.md"> | AZ <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/AZ.png" alt="AZ" height="20" /></a>  
  <a href="README-DE.md"> | DE <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/DE.png" alt="DE" height="20" /></a>  
  <a href="README-FR.md"> | FR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/FR.png" alt="FR" height="20" /></a>  
  <a href="README-AR.md"> | AR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/AR.png" alt="AR" height="20" /></a>  
  <a href="README-NL.md"> | NL <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/NL.png" alt="NL" height="20" /></a>  
</div>

# FOSSBilling DomainNameApi Modülü

Bu modül, FOSSBilling için geliştirilmiş resmi DomainNameApi entegrasyonudur. Alan adı kaydı, transferi, yenileme ve yönetim işlemlerini FOSSBilling panelinizden kolayca yapabilirsiniz.

## Gereksinimler

- FOSSBilling 1.0 veya üzeri
- PHP 8.0 veya üzeri
- PHP SOAP eklentisi etkin olmalı

## Kurulum

1. `library/Registrar/Adapter/` dizinine bu modül klasörünü yükleyin.
2. FOSSBilling yönetim paneline giriş yapın.
3. Ayarlar > Alan Adı Kayıt Modülleri bölümünden "DomainNameApi" modülünü etkinleştirin.
4. DomainNameApi API kullanıcı adı ve şifrenizi girin.
5. Kaydedin ve modülü kullanmaya başlayın.

## Güncelleme

- Yeni sürümü indirip mevcut dosyaların üzerine yazmanız yeterlidir.
- Ayarlarınız korunur, sadece kod güncellenir.

## Özellikler

- Alan adı kaydı, transferi ve yenileme
- Nameserver (DNS) yönetimi
- Whois/Contact bilgisi güncelleme
- Domain kilitleme/açma (Registrar Lock)
- Whois gizliliği (Privacy Protection)
- .TR uzantılı alan adları için tam destek
- Hata ve işlem loglama
- Türkçe ve çoklu dil desteği

## Sık Karşılaşılan Hata Kodları

| Kod  | Açıklama                                        | Detay                                                                                   |
|------|-------------------------------------------------|-----------------------------------------------------------------------------------------|
| 1000 | İşlem başarılı                                  | Komut başarıyla tamamlandı                                                             |
| 1001 | İşlem başarılı; işlem beklemede                 | Komut başarılı, ancak işlem kuyruğa alındı                                              |
| 2003 | Gerekli parametre eksik                        | Örneğin: İletişim bilgisinde telefon numarası eksik                                    |
| 2105 | Domain yenilemeye uygun değil                   | Domain güncellemeye kapalı, "clientupdateprohibited" olmamalı                          |
| 2200 | Kimlik doğrulama hatası                         | API kullanıcı adı/şifre hatalı veya domain başka bir kayıt operatöründe                |
| 2302 | Kayıt zaten mevcut                              | Domain veya nameserver zaten kayıtlı                                                   |
| 2303 | Kayıt bulunamadı                                | Domain veya nameserver bulunamadı, yeni kayıt gerekli                                  |
| 2304 | Domain durumu işleme izin vermiyor              | Domain güncellemeye kapalı, "clientupdateprohibited" olmamalı                          |

## Destek & Katkı

- [FOSSBilling Resmi Sitesi](https://fossbilling.org/)
- [DomainNameApi](https://www.domainnameapi.com/)
- Destek: support@domainnameapi.com

---

> Diğer diller için üstteki bayraklara tıklayın. Her dilde içerik ve teknik detaylar günceldir.




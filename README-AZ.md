<div align="center">  
  <a href="README.md"   >   TR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/TR.png" alt="TR" height="20" /></a>  
  <a href="README-EN.md"> | EN <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/US.png" alt="EN" height="20" /></a>  
  <a href="README-AZ.md"> | AZ <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/AZ.png" alt="AZ" height="20" /></a>  
  <a href="README-DE.md"> | DE <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/DE.png" alt="DE" height="20" /></a>  
  <a href="README-FR.md"> | FR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/FR.png" alt="FR" height="20" /></a>  
  <a href="README-AR.md"> | AR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/AR.png" alt="AR" height="20" /></a>  
  <a href="README-NL.md"> | NL <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/NL.png" alt="NL" height="20" /></a>  
</div>

# FOSSBilling DomainNameApi Modulu

Bu modul, FOSSBilling üçün rəsmi DomainNameApi inteqrasiyasıdır. Paneldən domen qeydiyyatı, transferi, yenilənməsi və idarəetməsi üçün istifadə olunur.

## Tələblər

- FOSSBilling 1.0 və ya yuxarı
- PHP 8.0 və ya yuxarı
- PHP SOAP əlavəsi aktiv olmalıdır

## Quraşdırma

1. Modul qovluğunu `library/Registrar/Adapter/` içərisinə yerləşdirin.
2. FOSSBilling admin panelinə daxil olun.
3. Ayarlar > Domain Qeydiyyat Modulları bölməsindən "DomainNameApi" modulunu aktiv edin.
4. DomainNameApi API istifadəçi adı və şifrənizi daxil edin.
5. Yadda saxlayın və istifadə etməyə başlayın.

## Yenilənmə

- Son versiyanı yükləyib mövcud faylların üzərinə yazın.
- Parametrləriniz qorunacaq, yalnız kod yenilənəcək.

## Xüsusiyyətlər

- Domen qeydiyyatı, transferi və yenilənməsi
- Nameserver (DNS) idarəetməsi
- Whois/contact məlumatlarının yenilənməsi
- Domen kilidləmə/açma (Registrar Lock)
- Whois məxfiliyi (Privacy Protection)
- .TR domenləri üçün tam dəstək
- Hata və əməliyyat logları
- Çoxdilli dəstək (AZ daxil)

## Tez-tez rast gəlinən səhv kodları

| Kod  | Açıqlama                                        | Təfərrüat                                                                                 |
|------|-------------------------------------------------|-------------------------------------------------------------------------------------------|
| 1000 | Əməliyyat uğurla tamamlandı                      | Komanda uğurla icra olundu                                                               |
| 1001 | Əməliyyat uğurla tamamlandı; əməliyyat gözləyir  | Komanda uğurla icra olundu, lakin əməliyyat növbəyə alınıb                               |
| 2003 | Tələb olunan parametr yoxdur                     | Məsələn: Əlaqə məlumatlarında telefon nömrəsi yoxdur                                     |
| 2105 | Domen yenilənməyə uyğun deyil                    | Domen yeniləməyə bağlıdır, status "clientupdateprohibited" olmamalıdır                  |
| 2200 | Doğrulama xətası                                 | API istifadəçi adı/şifrəsi səhvdir və ya domen başqa qeydiyyat şirkətindədir             |
| 2302 | Qeyd artıq mövcuddur                             | Domen və ya nameserver artıq bazada mövcuddur                                            |
| 2303 | Qeyd tapılmadı                                   | Domen və ya nameserver tapılmadı, yeni qeydiyyat lazımdır                                |
| 2304 | Domen statusu əməliyyata icazə vermir            | Domen yeniləməyə bağlıdır, status "clientupdateprohibited" olmamalıdır                  |

## Dəstək və İştirak

- [FOSSBilling Rəsmi Saytı](https://fossbilling.org/)
- [DomainNameApi](https://www.domainnameapi.com/)
- Dəstək: support@domainnameapi.com

---

> Digər dillər üçün yuxarıdakı bayraqlara klikləyin. Hər dildə məzmun və texniki detallar güncəldir.

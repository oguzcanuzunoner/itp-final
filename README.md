# itp-final
Bu projenin amacı PHP, MySQL, Medoo kütüphanesi ve PhpMailer kütüphanesi kullanarak, kullanıcıya ait “Panel” sayfası üzerinden, veri tabanında var olan 2 tabloya veri ekleme, silme, güncelleme işlemleri yaptırmak. Session işlemi ile, kullanıcı giriş yapmadığı sürece panele erişim sağlayamayacak. Bunların dışında bir tablodaki kaydı seçip, diğer tabloda ilgili kayıtları listeleme (Master-Detail) uygulaması gerçekleştirmek. İlişkisel olarak bağımlı olan tabloya veri eklerken, ilişki olan alana eklenecek veri, dropdown ile bağımlı olunan tablonun Primary-Key alanı aktarılacak, fakat kullanıcı Dropdown’da anlamlı bir isim görüntüleyecek. 	

sifremi_unuttum.php ve file/php/mail.php dosyaları içinde mail smtp ayarlarını yapmayı unutmayınız.
sql klasörü içerisinde MySQL için direkt içe aktar yaparsanız, veri tabanı ve tablolar otomatik oluşacaktır.

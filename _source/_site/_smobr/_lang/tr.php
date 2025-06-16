<?php if(isset($this)) { if(!is_object($this)) { Header("Location: ../"); exit(); } } else { Header("Location: ../"); exit(); }
#		 ____  __  __  ___  ____  ____  ___  _   _ 
#		(  _ \(  )(  )/ __)( ___)(_  _)/ __)( )_( )
#		 ) _ < )(__)(( (_-. )__)  _)(_ \__ \ ) _ ( 
#		(____/(______)\___/(__)  (____)(___/(_) (_) www.bugfish.eu
#				 ___ _   _ ___ _____ ___ ___ ___ ___ _  _ 
#				/ __| | | |_ _|_   _| __| __|_ _/ __| || |
#				\__ \ |_| || |  | | | _|| _| | |\__ \ __ |
#				|___/\___/|___| |_| |___|_| |___|___/_||_|
#		Copyright (C) 2024 Jan Maurice Dahlmanns [Bugfish]
#
#		This program is free software: you can redistribute it and/or modify
#		it under the terms of the GNU General Public License as published by
#		the Free Software Foundation, either version 3 of the License, or
#		(at your option) any later version.
#
#		This program is distributed in the hope that it will be useful,
#		but WITHOUT ANY WARRANTY; without even the implied warranty of
#		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#		GNU General Public License for more details.
#
#		You should have received a copy of the GNU General Public License
#		along with this program.  If not, see <https://www.gnu.org/licenses/>. ?>



## Hata
be_404_2=Hata 404
be_404_1=İstenilen içerik mevcut değil!
be_401_2=Erişim Engellendi
be_401_1=Bu alana erişiminiz yok!
b_permissions=İzinler

## Pop-up'lar
be_edit_abort=İşlemi iptal etmek için buraya tıklayın!
be_list_h_exec_flush=Bu tablodaki tüm öğeler silindi!
be_list_h_btn_flush=Bu tabloyu temizlemek istediğinize emin misiniz? Bu işlem, ilgili veritabanı tablosunu yeniden başlatacak ve tüm eski kayıtları silecektir!
be_list_h_btn_flush=Tebloyu Temizle
be_cbanner_1=Bu web sitesi oturum çerezleri kullanmaktadır!
be_cbanner_2=Kabul Ediyorum
be_pp_hide=Bu öğeyi halka açık kitap listesinde gizlemek istediğinize emin misiniz?
be_pp_unhide=Bu öğeyi halka açık kitap listesinde göstermek istediğinize emin misiniz?
be_pp_delbook=Bu kitabı silmek istediğinize emin misiniz? Bu işlem, ilgili tüm bilgileri ve kaydı silecektir.
be_pp_errimage=Lütfen geçerli bir jpg dosyası seçin!
be_pp_errimage1=Hiç dosya yüklenmedi veya yükleme sırasında hata oluştu.
be_pp_errimage2=Yüklenen dosya taşınırken hata oluştu.
be_pp_errimage3=Geçersiz dosya türü. Sadece JPG dosyalarına izin verilmektedir.
be_pp_sapi=Bu işlem, mevcut kitap bilgilerini openLibrary'den alınan bilgilerle üzerine yazacaktır. Kapak resmi de değiştirilecektir!
be_pp_sapierr=openLibrary API'siyle iletişim kurmaya çalışırken hata oluştu!
be_pp_sr1=Bu kitap öğesini silmek istediğinize emin misiniz?
be_pp_sr2=Bu kitap stokta geri döndü mü ve iade edildi mi?
be_pp_sr3=openLibrary API'siyle iletişim kurmaya çalışırken hata oluştu!

## İzinler
be_tperm_page_deadlines=Tarihleri Yönet
be_dperm_page_deadlines=Kullanıcılara kitap kiralayabilir ve tarihleri yönetebilirsiniz.
be_tperm_page_books=Kitapları Yönet
be_dperm_page_books=Kitap Sayfasına erişebilir ve üzerinde işlemler yapabilir, kitap oluşturabilir, düzenleyebilir ve silebilirsiniz.
be_tperm_page_tag=Etiketleri Yönet
be_dperm_page_tag=Kitap Etiketleri Sayfasına erişebilir ve üzerinde işlemler yapabilir, etiket oluşturabilir, düzenleyebilir ve silebilirsiniz.
be_tperm_page_user=Kullanıcıları Yönet
be_dperm_page_user=Kullanıcılar Sayfasına erişebilir ve üzerinde işlemler yapabilir, kullanıcı oluşturabilir ve tüm kullanıcıları görüntüleyip yönetebilirsiniz.
be_tperm_page_blacklist=Kara Listeyi Yönet
be_dperm_page_blacklist=IP Kara Liste Sayfasına erişebilir ve üzerinde işlemler yapabilirsiniz.
be_tperm_page_logging=Kayıtları Yönet
be_dperm_page_logging=Kayıtlar Sayfasına erişebilir ve üzerinde işlemler yapabilirsiniz.
be_tperm_page_settings=Ayarları Yönet
be_dperm_page_settings=Ayarlar Sayfasına erişebilir ve üzerinde işlemler yapabilirsiniz.

## Olaylar
be_list_exec_idel=Öğe silindi!
be_list_exec_iedit=Öğe değiştirildi!
be_usr_ad_herem=Gerekli verileri doldurmanız gerekiyor!
be_usr_ad_hmailex=Bu mail adresine sahip başka bir kullanıcı mevcut! Lütfen bu kullanıcı için başka bir mail adresi seçin.
be_usr_ad_hmaok=Kullanıcı oluşturuldu!
be_str_item_created=Öğe oluşturuldu!





############################################################################################################################################1

## Liste Başlıkları
be_list_h_date=Tarih
be_list_h_id=ID
be_list_h_ttype=Tür
be_list_h_ref=Referans
be_list_h_detail=Ayrıntılar
be_list_h_ar=Gelişler
be_list_h_url=URL
be_list_h_site=Site
be_list_h_err=Hata
be_list_h_rece=Alıcı
be_list_h_content=İçerik
be_list_h_time=Zaman
be_list_h_ip=IP
be_list_h_fails=Başarısızlıklar
be_list_h_delete=Sil
be_user_area_adr=Adres
be_user_area_mail=E-Posta
be_usr_ad_hmail=E-Posta

## Navigasyon
be_deadlines=Süreler
be_profile=Profil
be_logout=Çıkış
be_tag=Etiketler
be_books=Kitaplar
be_privacy=Gizlilik
be_impressum=Hakkımızda
be_settings=Ayarlar
be_blacklist=Kara Liste
be_logging=Kayıtlar
be_user=Kullanıcılar
be_myprofile=Benim Profilim
be_login=Giriş

## Etiket Alanı
be_tag_raw=Etiketler
be_tag_rawn=Etiket Adı
be_tag_add=Etiket Ekle
be_tag_edit=Etiket Düzenle
be_tag_chdele=Bu etiketi gerçekten silmek istiyor musunuz?
be_tag_exp=Burada etiketleri yönetebilirsiniz, etiketler kitaplara atanabilir.

## Kara Liste Alanı
be_exp_blacklist=Burada engellenmiş IP'ler görülebilir. Bu IP'ler bu siteye giriş yapamayacak veya doğrulama işlemleri gerçekleştiremeyecektir.

## Kayıtlar Alanı
be_exp_logging=Burada bu sistemdeki etkinliklerin bir protokolünü görebilirsiniz.


############################################################################################################################################2

## Book Area
be_book_add=Kitap Ekle
be_booked_isbn=ISBN
be_booked_title=Başlık
be_booked_autor=Yazar
be_booked_descr=Açıklama
be_booked_lang=Dil
be_booked_released=Yayımlanma Tarihi
be_booked_type=Tür
be_booked_pub=Yayınevi
be_vb_header_log=Log
be_vb_header_rentc=Miktar
be_vb_header_ima=Kapak
be_vb_header_det=Detaylar

## Deadline Area
be_deadline_raw=Son Tarihler
be_deadline_exp=Burada açık son tarihler ve kitap geri teslim sürelerini görebilirsiniz.
be_table_header_book=Kitap
be_table_header_barcode=Barkod
be_table_header_duedate=Teslim Tarihi

# Profile Area
b_prof_pwinfo=Buradan giriş yapmak için şifrenizi değiştirebilirsiniz.
b_prof_mailinfo=Buradan giriş yapmak için E-Postanızı değiştirebilirsiniz.

## User Area
be_password_filter_setup=Şifre aşağıdaki kriterlere uygun olmalıdır:<br />- En az 10 karakter<br />- En az 1 büyük harf<br />- En az 1 küçük harf<br />- En az bir rakam


############################################################################################################################################3

be_yes=Evet
be_no=Hayır
b_in_time=Zamanında
b_overdue=Zaman Aşımı
b_today_return=Bugün İade Et
b_view=Görünüm
be_table_header_returndate=İade Tarihi
b_active=Aktif
b_inactive=Pasif
b_edit=Düzenle
b_action=İşlem
b_delete=Sil
be_close=Kapat
be_cancel=İptal
b_description=Açıklama
be_list=Liste
be_none=Hiçbiri
be_help=Yardım
be_explanation=Açıklama
b_nosslval=SSL Doğrulaması Yok
b_sslval=SSL Doğrulaması Zorunlu
b_low=Düşük
b_medium=Orta
b_high=Yüksek
b_apirequest=API ile Senkronize Et
b_barcode=Barkod
b_add=Ekle
b_nolistcurrent=Şu anda bu listede öğe yok!
b_backtolist=Listeye Geri Dön
b_hide=Gizle
b_unhide=Aç
be_profile=Profil
b_creation=Oluşum
b_lastmodification=Son Değişiklik
b_firstname=Ad
b_lastname=Soyad
b_street=Sokak
b_postcode=Posta Kodu
b_country=Ülke
b_changeimage=Resmi Değiştir
b_password=Şifre
b_change_password=Şifreyi Değiştir
b_email=E-Posta
b_change_email=E-Postayı Değiştir
b_status=Durum
b_id=ID
b_tags=Etiketler
b_thisitemcurhiddenlist=Bu öğe şu anda halka açık listede gizli!
b_nobooktitlelist=Bilinmeyen Başlık
b_hidden=Gizli
b_lend=Ödünç Ver
b_return=İade Et
b_hardback=Ciltli
b_paperback=Karton Kapak
b_softcover=Yumuşak Kapak
b_bookcurrentlyrented=Bu kitap şu anda başka bir kullanıcı tarafından rezerve edilmiştir ve yakında kullanılabilir olacak!
b_available=Mevcut
b_reserved=Rezerve Edilmiş
b_user=Kullanıcı
b_until=Kadar
b_returndate=İade Tarihi
b_note=Not
b_lendtouser=Kullanıcıya Ödünç Ver
b_changefavicon=Favicon Değiştir
b_settings_exp_string=Bu sayfada, web sitesinin işlevselliğini kontrol edebilirsiniz.
b_tel=Telefon
be_pp_sr1ssd=Kitap iade edildi mi?
be_error_booknoexists=Bakmaya çalıştığınız kitap mevcut değil!
be_error_usernoexists=Bakmaya çalıştığınız kullanıcı mevcut değil!
be_puser_chdele3=Kullanıcıyı Etkinleştir
b_prof_pwinfoadd=Yönetici olarak kullanıcı e-postalarını etkinleştirmeden değiştirebilirsiniz.


############################################################################################################################################4

be_about_core_info=CMS Sürümü
be_about_fw_info=Framework Sürümü
be_about_site_info=Modül Sürümü
be_set_header_general=Genel Ayarlar
be_set_header_mail=E-Posta Ayarları
be_set_header_trans=Çeviri Ayarları
be_set_header_about=Sistem Bilgisi
be_string_key=Anahtar
be_string_language=Dil
be_string_translation=Çeviri
be_trans_current_active=Varsayılan Çeviriler
be_trans_current_ovr=Çeviri Üzerine Yazmalar
be_trans_button_create=Çeviri Oluştur
be_trans_button_edit=Çeviri Düzenle
be_trans_dlrly=Bu çeviriyi silmek istediğinizden emin misiniz?
be_eexps_hivetitle=Bu web sitesinin başlığı.
be_eexps_imp=İzlenebilirlik Metniniz
be_eexps_pry=Gizlilik Metniniz
be_eexps_expiretoken=E-Posta Token'ı belirli bir süre sonra süresi dolar.
be_eexps_expireip=IP Engelleme Limiti
be_eexps_expirecsrf=CSRF Anahtarlarının geçerliliği için süre (saniye cinsinden).
be_eexps_expireact=Kullanıcıların şifre kurtarma/mail değiştirme talepleri arasında beklemeleri gereken süre (dakika cinsinden).
be_eexps_upgc=Yerel güncelleyiciyi bir erişim kodu ile güvence altına al.
be_eexps_actmc=Kullanıcıların E-Postalarını değiştirmelerine izin ver.
be_eexps_actrec=Kullanıcıların şifrelerini kurtarmalarına izin ver.
be_eexps_actreg=Misafirlerin bu web sitesine kayıt olmalarına izin ver.
be_eexps_actdeflang=Misafirler için varsayılan dil, eğer kendi dillerini ayarlamamışlarsa.
be_eexps_trapage=Bu bölümde varsayılan çevirileri görebilir ve gerekirse bunları geçersiz kılabilirsiniz.
be_eexpm_user=E-Posta Sunucusu İçin Kullanıcı Adı
be_eexpm_pass=E-Posta Sunucusu İçin Şifre
be_eexpm_host=SMTP Sunucusu Adı
be_eexpm_port=SMTP Bağlantı Noktası
be_eexpm_auth=SMTP Kimlik Doğrulama Yöntemi
be_eexpm_sm=Çıkış E-Postaları İçin Gönderen E-Posta
be_eexpm_sn=Çıkış E-Postaları İçin Gönderen Adı
be_eexpm_mh=Varsayılan E-Posta Başlığı
be_eexpm_debug=E-posta gönderimi sırasında sorunlar oluşursa, hata ayıklamayı burada etkinleştirebilirsiniz - bu durumda, her gönderim işleminde hata ayıklama bilgileri ekrana gösterilecektir - başarılı olsa bile.
be_eexpm_ins=Güvensiz SMTP Bağlantılarına İzin Ver
be_eexpm_mf=Varsayılan E-Posta Altbilgisi
obr_inp_title=Başlık
obr_inp_autor=Yazar
obr_inp_publisher=Yayınevi
obr_inp_isbn=ISBN
obr_inp_lang=Dil
obr_inp_tags=Etiketler
be_obr_li_id=Kitap ID
be_obr_li_book_title=Başlık
be_obr_li_book_autor=Yazar
be_obr_li_book_type=Kitap Türü
be_obr_li_book_publisher=Yayınevi
be_obr_li_book_isbn=ISBN
be_obr_li_book_lang=Dil
be_obr_li_book_tag_array=Bağlı Kategoriler
be_obr_li_book_creation=Oluşturulma Tarihi
be_obr_li_book_modification=Değiştirilme Tarihi
be_obr_update_book=Kitap Verilerini ISBN ile Getir
be_obr_delete_book=Kitap Sil
be_obr_add_stock=Kiralanabilir Ürünler
obr_book_item_list=Kiralanabilir Ürünler Listesi
be_op_usr_622=Kullanıcı düzenlendi.


############################################################################################################################################5

string_add=Ekle
be_exp_usrlst=Burada kullanıcıları yönetebilir ve oluşturabilirsiniz.
be_user_area_usrname=Ad
be_opok=Bu siteyi, aktivasyon talebinde bulunduğunuz için görüyorsunuz.<br/>Detaylar için sağ üst köşedeki etkinlik kutusuna bakın.
be_operr=Hata
be_str_item_createderr=API Token oluşturulamadı, bu genellikle ilgili site modülü için zaten mevcut bir token olduğunda olur!
be_mail_template_edit=Mail Şablonunu Düzenle
be_mail_exp_recover=Kayıtlı kullanıcıları geri yüklemek için mail şablonu. Bu şablon, kullanıcılar 'şifremi unuttum' fonksiyonu ile yeni şifre talep ettiğinde gönderilir. Bir yer değiştirme, kullanıcıya bir bağlantı sağlamak için ayarlanır. Kolay Yer Değiştirme _ACTION_URL_.
be_mail_exp_mchange=Kayıtlı kullanıcı e-posta değişiklikleri için mail şablonu. Bu şablon, kullanıcı kendi birincil e-postasını değiştirdiğinde veya genel olarak değiştirildiğinde gönderilir. Bir yer değiştirme, kullanıcıya yeni e-postayı aktifleştirmek ve onaylamak için bir bağlantı sağlar. Kolay Yer Değiştirme _ACTION_URL_ ile aktivasyon bağlantısı.
be_mail_exp_acti=Kayıtlı kullanıcıları aktifleştirmek için mail şablonu. Bu şablon, kullanıcılar veya şirket çalışanları oluşturulduğunda gönderilir. Bir yer değiştirme, kullanıcıya yeni hesabı aktifleştirmek için bir bağlantı sağlar. Kullanıcı ayrıca hesabı aktifleştirmek için şifreyi geri alabilir.
be_se_key_mch=Mail Aktivasyon Anahtarı
b_permission=İzinler
be_user_area_name=Kullanıcı Yönetimi
be_user_area_create=Kullanıcı Ekle
be_usr_ad_errgm=Kullanıcı oluşturulmuş ancak aktivasyon maili gönderilirken bir hata oluştu!
be_noti_user_crea=Lütfen unutmayın, eğer bir kullanıcı hesabını onaylamamışsa ve başka bir kullanıcı aynı mail ile kayıt olmaya çalışırsa, ilk onaylanmamış kullanıcı silinebilir. Bu, veri kaybına yol açabilir. Yani, sistemin onları silmesini istemiyorsanız her zaman onaylı kullanıcılarla çalıştığınızdan emin olun. Kullanıcıları onaysız hale getirme fonksiyonlarını asla kullanmayın, çünkü bu da veri kaybına yol açabilir.
be_usr_ad_errg=Kullanıcı oluşturulurken bir hata oluştu.
be_usr_ad_hpasserem=Seçilen şifre tavsiyelere uymuyor!
be_usr_ad_hpass=Şifre
be_usr_ad_h=Aktivasyon Prosedürü
be_usr_ad_rec=Mail ile aktivasyon isteği ve kullanıcının kendi şifresini belirlemesi
be_usr_ad_act=Sadece Mail ile aktivasyon isteği
be_usr_ad_ok=Bu kullanıcıyı herhangi bir aktivasyon prosedürü olmadan aktifleştir
be_puser_noview=Bu kullanıcı mevcut değil!
be_puser_cpass=Şifreyi Değiştir
be_puser_cpass1=Şifreyi Onayla
be_puser_cpass2=Yeni Şifre
be_puser_cper=İzinleri Değiştir
be_puser_chmm=Kullanıcı Mailini Değiştir
be_puser_chmm1=Yeni Mail
be_puser_chdele=Kullanıcıyı Sil
be_puser_chdele1=Kullanıcı İşlemleri
be_puser_chdele7=Bu kullanıcı şu anda mail ile onaylanmamış!
be_puser_chdele8=Bu kullanıcı şu anda engellenmiş!
be_puser_chdele9=Bu kullanıcı şu anda devre dışı bırakılmış!
be_puser_chdele10=Bu, başlangıç süper yönetici hesabıdır! Her zaman bu yönetici paneline tam erişimi vardır!
be_puser_chdele11=Bu profil başka bir kullanıcıya aittir! Ayarları değiştirirken dikkatli olun, çünkü değişiklikler kullanıcı deneyimini etkileyebilir!
be_puser_chdele12=Yeni mail aktivasyonu bekleniyor:
be_puser_chdele13=İşlemi iptal etmek için buraya tıklayın.
be_puser_chdele14=Mail boş olamaz!
be_puser_chdele15=Bilinmeyen Hata
be_puser_chdele16=Bu kullanıcı için mail değiştirme fonksiyonu şu anda devre dışı bırakılmıştır!
be_puser_chdele17=Bu kullanıcının mailini değiştirmek yasaktır.
be_puser_chdele18=Bu mail ile zaten aktif bir kullanıcı var! Kullanıcılar arasında aynı maili kullanmak mümkün değildir.
be_puser_chdele19=Mail değiştirme talepleri arasında belirli bir süre beklemeniz gerekiyor: 
be_puser_chdele20=dakika
be_puser_chdele21=Yeni maili aktifleştirmek için yeni mail kutunuzu kontrol edin!
be_puser_chdele22=Aktivasyon maili gönderilirken bir hata oluştu!
be_puser_chdele23=Mail Değiştirme talebi iptal edildi!
be_op_usr_1=Şifrenizde bir sayı, bir küçük ve bir büyük harf bulunmalıdır! En az 10 karakter olmalıdır.
be_op_usr_2=Şifreler boş olamaz!
be_op_usr_3=Şifreler uyuşmuyor!
be_op_usr_4=Şifre değiştirildi!
be_op_usr_6=Kullanıcı izinleri değiştirildi!
be_op_usr_11=Kullanıcı onaylandı ve şimdi giriş yapabilir!
be_op_usr_12=Kullanıcı silindi!
be_book_area_create=Kitap Oluştur

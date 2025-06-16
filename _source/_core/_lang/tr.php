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
##########################################################################################
## Backend Default Language Overrides for Login Scripts
##########################################################################################

# Strings - General
string_email=E-Posta
string_password=Şifre
string_login=Giriş Yap
string_register=Kayıt Ol
string_close=Kapat
string_error=Hata

# Page - Actions
hive_login_changelanguage=Dili değiştirebilirsiniz
hive_login_changelanguage_here=buradan.
hive_login_lostpass=Şifremi unuttum?
hive_login_notregistered=Kayıtlı Değil Misiniz?
hive_login_rememberme=Çerezleri Kullan?
hive_login_recoveraccount=Hesap Kurtarma
hive_login_haveaccount=Zaten Hesabınız Var Mı?
hive_login_password_confirm=Şifreyi Doğrula
hive_login_mc_change_mail=E-Posta Değiştir
hive_login_mc_backtohome=Ana Sayfaya Dön
hive_login_title_accactivation=Hesap Aktivasyonu
hive_cannotenterwhilenologin=Giriş yapmadıysanız bu sayfaya giremezsiniz!
hive_cannotenterwhilelogin=Giriş yaptıysanız bu sayfaya giremezsiniz!
hive_cannotoperatesiteerror=Bu site modülünde kritik bir hata var, bu yüzden şu anda işlem yapamazsınız!
hive_login_backtologin=Giriş Sayfasına Geri Dön
hive_login_change_Lang=Dili Değiştir
hive_login_language_changed=Dil değiştirildi!

# Login Events - General
hive_login_msg_l_wrong=Yanlış Şifre/E-Posta kombinasyonu.
hive_login_msg_csrf=Form süresi dolmuş, lütfen tekrar deneyin.
hive_login_msg_empty=Lütfen gerekli verileri girin!
hive_login_msg_ipban=IP'niz şu anda engellenmiş; lütfen daha sonra tekrar deneyin.
hive_login_msg_logout=Çıkış yaptınız!
hive_login_msg_nomatchpass=Şifre doğrulaması girilen şifreyle uyuşmuyor.
hive_login_doremember=Şifrenizi hatırlamak istiyor musunuz?

# Login Events - Login
hive_login_msg_l_ok=Giriş başarılı.
hive_login_msg_l_blocked=Hesabınız engellendiği için giriş yapamazsınız.
hive_login_msg_l_inactive=Hesabınız henüz aktif edilmemiştir! Hesabınızı etkinleştirmek için şifrenizi kurtarın veya aldığınız aktivasyon E-Postasındaki URL'yi tıklayın!
hive_login_msg_l_blockedpwf=Çok fazla yanlış şifre girdiniz ve hesabınız engellendi!
hive_login_msg_l_disabled=Hesabınız devre dışı bırakıldı!
hive_login_mail_serror=E-Posta gönderme sırasında hata oluştu. Bu, araştırılması gereken dahili bir hatadır ve web sitemizin personeline bildirilmelidir.
hive_login_msg_register_ok=Yeni hesabınızı etkinleştirmek için lütfen E-Posta gelen kutunuzu kontrol edin!
hive_login_msg_passfiltererror=Girilen şifre, şifre kurallarına uymuyor!
hive_login_msg_mailexist=Zaten mevcut bir E-Posta ile hesap kaydettirmeye çalışıyorsunuz!
hive_login_password_rules=Şifre Kuralları
hive_login_password_sign=Gerekli Karakterler:
hive_login_password_cap=Gerekli Büyük Harfler:
hive_login_password_small=Gerekli Küçük Harfler:
hive_login_password_special=Gerekli Özel Karakterler:
hive_login_password_numeric=Gerekli Sayısal Karakterler:

# Login Events - Mail Change
hive_login_msg_m_ok=Yeni E-Postanızı başarıyla etkinleştirdiniz!
hive_login_msg_m_er=Yeni E-Posta adresini etkinleştirme sırasında hata oluştu; lütfen tekrar deneyin.
hive_login_msg_m_exp=E-Posta etkinleştirme kodu süresi dolmuş! Lütfen E-Postanızı değiştirmeyi tekrar deneyin!
hive_login_msg_m_res=Etkinleştirmeye çalıştığınız E-Posta şu anda başka bir hesapta kullanılmakta, bu yüzden hesabınıza bağlanamaz!
hive_login_msg_m_block=Hesabınız E-Posta değişikliklerine engellenmiş!
hive_login_msg_m_noadr=İstek başarısız oldu. Lütfen daha sonra tekrar deneyin.
hive_login_mc_cmailtext=Mevcut E-Postanız:
hive_login_msg_rec_ok=Yeni E-Posta adresinizi etkinleştirmek için lütfen yeni E-Posta gelen kutusunu kontrol edin.
hive_login_msg_rec_err=E-Posta adresini değiştirme sırasında hata oluştu.
hive_login_msg_rec_wait=E-Posta değişiklikleri arasında 120 dakika beklemeniz gerekiyor!
hive_login_msg_rec_exist=Değiştirmeye çalıştığınız E-Posta, başka bir kullanıcı hesabı tarafından kullanılmakta!
hive_login_msg_rec_block=Hesabınız E-Posta değişikliklerinden engellenmiş!
hive_login_msg_rec_disable=Devre dışı bırakılmış bir hesabın E-Postasını değiştiremezsiniz!

# Login Mails
hive_login_mail_pre_change=Yeni E-Postanızı burada etkinleştirin: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_change=Yeni E-Postanızı Etkinleştirin
hive_login_mail_title_register=Yeni Hesabınızı Etkinleştirin
hive_login_mail_pre_register=Hesabınızı etkinleştirmek için aşağıdaki bağlantıya tıklayın: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_rec=Hesabınızı Kurtarın
hive_login_mail_pre_rec=Hesap şifrenizi kurtarmak için aşağıdaki bağlantıya tıklayın: <a href="SF_ACTION_URL">SF_ACTION_URL</a>

# Login - Activation
hive_login_msg_a_ok=Hesabınızı başarıyla etkinleştirdiniz! Şimdi bu web sitesindeki giriş sayfalarımızdan giriş yapabilirsiniz.
hive_login_msg_a_er=Hesap etkinleştirilirken hata oluştu. Lütfen hesabınızın şifresini kurtarmayı deneyin veya yeni bir hesap kaydedin.
hive_login_msg_a_exp=Aktivasyon token'ı geçersiz. Hesabınızı etkinleştirmek için giriş sayfasında hesabınızı kurtarın!
hive_login_msg_a_block=Hesabınızın aktivasyonu devre dışı bırakıldı; lütfen daha sonra tekrar deneyin!

# Login - Recover Request
hive_login_msg_rr_recnewunk=Verilen E-Posta kayıtlı değil.
hive_login_msg_rr_recnope=Hesabınızın şifre kurtarma izni yok!
hive_login_msg_rr_recnopede=Hesabınız devre dışı bırakıldı ve yeni istekler yapamaz!
hive_login_msg_rr_recwait=Yeni bir şifre kurtarma isteği başlatmadan önce 120 dakika beklemeniz gerekiyor!
hive_login_msg_rr_recnok=Şifre sıfırlama E-Postasını gelen kutunuzda kontrol edin. Bu E-Posta, şifrenizi kurtarmak için bir bağlantı içerir.
hive_login_msg_recfr_ok=Şifre kurtarma bağlantısı almak için lütfen E-Posta gelen kutunuzu kontrol edin!

# Login - Recover Execute
hive_login_msg_pwtexp=Bu Şifre Kurtarma Token'ı süresi dolmuş! Hesabınızı kurtarmayı tekrar deneyin.
hive_login_msg_recexecerror=Şifrenizi kurtarma sırasında hata oluştu. Hesabınızı kurtarmayı tekrar deneyin.
hive_login_msg_recexecok=Şifrenizi başarıyla kurtardınız ve şimdi yeni şifrenizle giriş yapabilirsiniz.

##########################################################################################
## Setupable Constant Explanations
##########################################################################################

hive_var_exp_1=Tema: Dinamik Tema Renkleri için Varsayılan Renk
hive_var_exp_2=Tema: Geçerli Temalarla Seri Halinde Dizi
hive_var_exp_3=Tema: Kullanılan Varsayılan Tema
hive_var_exp_4=Dil: Geçerli Dillerle Seri Halinde Dizi
hive_var_exp_5=Dil: Varsayılan Dil ile Dizi
hive_var_exp_6=İşlemler: Genel Kayıt Formu Aktif mi? (1=aktif/0=pasif)
hive_var_exp_7=Henüz Açıklama Yok.
hive_var_exp_8=İşlemler: Genel Kurtarma Formu Aktif mi? (1=aktif/0=pasif)
hive_var_exp_9=İşlemler: Genel Aktivasyon Formu Aktif mi? (1=aktif/0=pasif)
hive_var_exp_10=Genel Giriş Formu Aktif mi? (1=aktif/0=pasif)
hive_var_exp_11=TinyMCE: Eklenti Yapılandırma Dizesi
hive_var_exp_12=TinyMCE: Menü Çubuğu Yapılandırma Dizesi
hive_var_exp_13=TinyMCE: Araç Çubuğu Yapılandırma Dizesi
hive_var_exp_14=Kullanıcı Yapılandırması: Oturumlar/Kekler için Geçerlilik Süresi (Gün Olarak)
hive_var_exp_15=Kullanıcı Yapılandırması: Aktivasyon Maillerinde Token’ın Geçerlilik Süresi (Dakika Cinsinden)
hive_var_exp_16=Kullanıcı Yapılandırması: X Hatalı Girişten Sonra Kullanıcıyı Engelle (0, devre dışı bırakmak için)
hive_var_exp_17=Kullanıcı Yapılandırması: Kullanıcıların Talepler Arasında Beklemesi Gereken Süre (Anti Flood, Dakika Cinsinden)
hive_var_exp_18=Kullanıcı Yapılandırması: Eski Oturumları Kaydet? (Girişler, Kurtarmalar, Aktivasyonlar, Mail Değişiklikleri) (1=aktif/0=pasif)
hive_var_exp_19=Kullanıcı Yapılandırması: Kullanıcı IP'lerini Veritabanında Kaydet (1=aktif/0=pasif)
hive_var_exp_20=Kullanıcı Yapılandırması: 1 - Kurtarma Anahtarlarını Kullanıcı Başarıyla Giriş Yaptıktan Sonra Kaldır | 0 - Anahtarları Koru
hive_var_exp_21=Kullanıcı Yapılandırması: 1 - Çoklu Girişi İzin Ver | 0 - Çoklu Girişi Devre Dışı Bırak
hive_var_exp_22=Şifre Filtreleme: Minimum Karakter Sayısı
hive_var_exp_23=Şifre Filtreleme: Minimum Büyük Harf Sayısı
hive_var_exp_24=Şifre Filtreleme: Minimum Küçük Harf Sayısı
hive_var_exp_25=Şifre Filtreleme: Minimum Özel Karakter Sayısı
hive_var_exp_26=Şifre Filtreleme: Minimum Sayısal Karakter Sayısı
hive_var_exp_27=Başlangıçta Oluşturulan Kullanıcı Adı
hive_var_exp_28=Başlangıçta Oluşturulan Kullanıcı Şifresi
hive_var_exp_29=Captcha: Görüntü Yüksekliği
hive_var_exp_30=Captcha: Görüntü Genişliği
hive_var_exp_31=Captcha: Captcha için Renkler (Opsiyonel, 0 olabilir)
hive_var_exp_32=Captcha: Yazı Tipi (0 ise Varsayılan Yazı Tipi Kullanılır)
hive_var_exp_33=Redis: Aktif mi? 1/0
hive_var_exp_34=Redis: Ana Makine
hive_var_exp_35=Redis: Port
hive_var_exp_36=Yükseltici: Bu Site İçin Yükseltici Başlığı
hive_var_exp_37=Yükseltici: Güncelleme için Kod Gerekiyor mu? (0 ise devre dışı bırakılır)
hive_var_exp_38=Ayarlar: CURL Sınıfı Taleplerini Günlükle? (1/0)
hive_var_exp_39=Ayarlar: X Hatalı Girişten Sonra IP'leri Engelle? (0 ise devre dışı bırakılır)
hive_var_exp_40=Ayarlar: Referansları Günlükle? (1/0)
hive_var_exp_41=Ayarlar: Varsayılan CSRF Kodu Geçerlilik Süresi (Saniye Cinsinden)
hive_var_exp_42=Ayarlar: 1 - Sadece Cronjob Komut Satırından Çalıştır | 0 - Cronjob'u Tarayıcıda Çalıştırmaya İzin Ver
hive_var_exp_43=Ayarlar: Javascript Hata Ayıklama Günlüklemeyi Aktif Et (1/0)
hive_var_exp_44=Ayarlar: Web Sitesi Başlığı (Sekmeler ve Daha Fazlası için)
hive_var_exp_45=Ayarlar: Tarayıcı Sekmeleri İçin Başlık Boşlukları
hive_var_exp_46=Ayarlar: Web Sitesinde PHP Hatalarını Göster? (1/0)
hive_var_exp_47=Ayarlar: Gereken PHP Modülleriyle Seri Halinde Dizi, Eğer Yoksa Hata Gösterilir (Örnek: array("mysqli", "mbstring", "gd"))
hive_var_exp_48=Ayarlar: MySQL Hatalarını Sayfada Durdur ve Göster? (Her Zaman x_log_mysql Tablosuna Kaydedilecektir!) (1/0)
hive_var_exp_49=Ayarlar: 1 - SEO URL'leri Kullan | 0 - SEO URL'leri Kullanma
hive_var_exp_50=Ayarlar: Sadece _HIVE_URL_SEO_ == false ise Gereklidir [Get Konum Değişkenleri için Seri Halinde Dizi Adı]
hive_var_exp_51=Mail Yapılandırması: SMTP Şifresi
hive_var_exp_52=Mail Yapılandırması: SMTP Kullanıcı Adı
hive_var_exp_53=Mail Yapılandırması: SMTP Kimlik Doğrulama (ssl/tls/false)
hive_var_exp_54=Mail Yapılandırması: SMTP Portu
hive_var_exp_55=Mail Yapılandırması: SMTP Sunucusu
hive_var_exp_56=Mail Yapılandırması: Mail Hata Ayıklama Modu (0, 1, 2, 3) - Üretim için 0 kullanın, bu site üzerinde Hata Ayıklama Çıktısı Alınır!
hive_var_exp_57=Mail Yapılandırması: Güvensiz SSL Bağlantılarına İzin Verilsin mi? (1/0)
hive_var_exp_58=Mail Yapılandırması: Tüm Mailler HTML Olarak Gönderilsin mi? (1/0)
hive_var_exp_59=Mail Yapılandırması: Varsayılan Gönderen Mail Adı
hive_var_exp_60=Mail Yapılandırması: Varsayılan Gönderen Mail Adresi
hive_var_exp_61=Mail Yapılandırması: Varsayılan Mail Altbilgisi
hive_var_exp_62=Mail Yapılandırması: Varsayılan Mail Üstbilgisi

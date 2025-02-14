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


## Fehler
be_404_2=Fehler 404
be_404_1=Der angeforderte Inhalt existiert nicht!
be_401_2=Zugriff verweigert
be_401_1=Sie haben keinen Zugriff auf diesen Bereich!
b_permissions=Berechtigungen

## Popups
be_edit_abort=Klicken Sie hier, um den Vorgang abzubrechen!
be_list_h_exec_flush=Alle Elemente in dieser Tabelle wurden gelöscht!
be_list_h_btn_flush_rly=Möchten Sie diese Tabelle wirklich leeren? Dadurch wird diese zugehörige Datenbanktabelle neu initialisiert und alle alten Einträge darin gelöscht!
be_list_h_btn_flush=Tabelle leeren
be_cbanner_1=Diese Website verwendet Sitzungs-Cookies!
be_cbanner_2=Ich stimme zu
be_pp_hide=Möchten Sie dieses Element wirklich in der öffentlichen Buchliste ausblenden?
be_pp_unhide=Möchten Sie dieses Element wirklich in der öffentlichen Buchliste anzeigen?
be_pp_delbook=Möchten Sie dieses Buch wirklich löschen? Dadurch werden alle zugehörigen Informationen und das Log dafür gelöscht.
be_pp_errimage=Bitte wählen Sie eine gültige JPG-Datei aus!
be_pp_errimage1=Es wurde keine Datei hochgeladen oder es gab einen Fehler während des Uploads.
be_pp_errimage2=Fehler beim Verschieben der hochgeladenen Datei.
be_pp_errimage3=Ungültiger Dateityp. Nur JPG-Dateien sind erlaubt.
be_pp_sapi=Dies wird die aktuellen Buchinformationen mit Informationen von openLibrary überschreiben. Das Coverbild wird ebenfalls ersetzt!
be_pp_sapierr=Fehler beim Versuch, mit der openLibrary-API zu kommunizieren!
be_pp_sr1=Möchten Sie diesen Bucheintrag wirklich löschen?
be_pp_sr2=Wurde dieses Buch wieder auf Lager und zurückgegeben?
be_pp_sr3=Fehler beim Versuch, mit der openLibrary-API zu kommunizieren!

## Berechtigungen
be_tperm_page_deadlines=Fristen verwalten
be_dperm_page_deadlines=Kann Bücher an Benutzer verleihen und Fristen verwalten.
be_tperm_page_books=Bücher verwalten
be_dperm_page_books=Zugriff auf die Seite für Bücher und deren Funktionen, kann Bücher erstellen, bearbeiten und löschen.
be_tperm_page_tag=Tags verwalten
be_dperm_page_tag=Zugriff auf die Seite für Buch-Tags und deren Funktionen, kann Tags erstellen, bearbeiten und löschen.
be_tperm_page_user=Benutzer verwalten
be_dperm_page_user=Zugriff auf die Seite für Benutzer und deren Funktionen, kann Benutzer erstellen und alle Benutzer anzeigen/verwenden.
be_tperm_page_blacklist=Blacklist verwalten
be_dperm_page_blacklist=Zugriff auf die Seite für die IP-Blacklist und deren Funktionen.
be_tperm_page_logging=Protokolle verwalten
be_dperm_page_logging=Zugriff auf die Seite für Protokolle und deren Funktionen.
be_tperm_page_settings=Einstellungen verwalten
be_dperm_page_settings=Zugriff auf die Seite für Einstellungen und deren Funktionen.

## Ereignisse
be_list_exec_idel=Das Element wurde gelöscht!
be_list_exec_iedit=Das Element wurde geändert!
be_usr_ad_herem=Sie müssen die erforderlichen Daten ausfüllen!
be_usr_ad_hmailex=Ein anderer Benutzer mit dieser E-Mail existiert bereits! Bitte wählen Sie eine andere E-Mail für diesen Benutzer.
be_usr_ad_hmaok=Der Benutzer wurde erstellt!
be_str_item_created=Das Element wurde erstellt!

############################################################################################################################################1


## List Headers 
be_list_h_date=Datum
be_list_h_id=ID
be_list_h_ttype=Typ
be_list_h_ref=Referenz
be_list_h_detail=Details
be_list_h_ar=Ankünfte
be_list_h_url=URL
be_list_h_site=Website
be_list_h_err=Fehler
be_list_h_rece=Empfänger
be_list_h_content=Inhalt
be_list_h_time=Zeit
be_list_h_ip=IP
be_list_h_fails=Fehler
be_list_h_delete=Löschen
be_user_area_adr=Adresse
be_user_area_mail=E-Mail
be_usr_ad_hmail=E-Mail

## Navigation
be_deadlines=Fristen
be_profile=Profil
be_logout=Abmelden
be_tag=Tags
be_books=Bücher
be_privacy=Datenschutz
be_impressum=Impressum
be_settings=Einstellungen
be_blacklist=Schwarze Liste
be_logging=Protokollierung
be_user=Benutzer
be_myprofile=Mein Profil
be_login=Login

## Tag Area
be_tag_raw=Tags
be_tag_rawn=Tag Name
be_tag_add=Tag hinzufügen
be_tag_edit=Tag bearbeiten
be_tag_chdele=Möchten Sie diesen Tag wirklich löschen?
be_tag_exp=Hier können Sie Tags verwalten, Tags können Büchern zugewiesen werden.

## Blacklist Area
be_exp_blacklist=Gesperrte IPs können hier eingesehen werden. Diese IPs können sich nicht auf dieser Website anmelden oder authentifizierte Operationen durchführen.

## Logging Area
be_exp_logging=Hier können Sie ein Protokoll der Aktivitäten in diesem System einsehen.

############################################################################################################################################2

## Book Area
be_book_add=Buch hinzufügen
be_booked_isbn=ISBN
be_booked_title=Titel
be_booked_autor=Autor
be_booked_descr=Beschreibung
be_booked_lang=Sprache
be_booked_released=Veröffentlichungsdatum
be_booked_type=Typ
be_booked_pub=Verlag
be_vb_header_log=Protokoll
be_vb_header_rentc=Menge
be_vb_header_ima=Cover
be_vb_header_det=Details

## Deadline Area
be_deadline_raw=Fristen
be_deadline_exp=Hier können Sie offene Fristen und Rückgabetermine für Bücher einsehen.
be_table_header_book=Buch
be_table_header_barcode=Barcode
be_table_header_duedate=Fälligkeitsdatum

# Profile Area
b_prof_pwinfo=Hier können Sie das Passwort zum Einloggen ändern.
b_prof_mailinfo=Hier können Sie die E-Mail zum Einloggen ändern.

## User Area
be_password_filter_setup=Das Passwort muss folgende Kriterien erfüllen:<br />- Mindestens 10 Zeichen<br />- Mindestens 1 Großbuchstabe<br />- Mindestens 1 Kleinbuchstabe<br />- Mindestens eine Zahl




############################################################################################################################################3

be_yes=Ja
be_no=Nein
b_in_time=Rechtzeitig
b_overdue=Zeit überschritten
b_today_return=Heute zurückgeben
b_view=Ansicht
be_table_header_returndate=Rückgabedatum
b_active=Aktiv
b_inactive=Inaktiv
b_edit=Bearbeiten
b_action=Aktion
b_delete=Löschen
be_close=Schließen
be_cancel=Abbrechen
b_description=Beschreibung
be_list=Liste
be_none=Keiner
be_help=Hilfe
be_explanation=Erklärung
b_nosslval=Keine SSL-Validierung
b_sslval=SSL-Validierung erzwingt
b_low=Low
b_medium=Mittel
b_high=Hoch
b_apirequest=Mit API synchronisieren
b_barcode=Barcode
b_add=Hinzufügen
b_nolistcurrent=Zurzeit sind keine Elemente in dieser Liste!
b_backtolist=Zurück zur Liste
b_hide=Verstecken
b_unhide=Einblenden
be_profile=Profil
b_creation=Erstellung
b_lastmodification=Letzte Änderung
b_firstname=Vorname
b_lastname=Nachname
b_street=Straße
b_postcode=Postleitzahl
b_country=Land
b_changeimage=Bild ändern
b_password=Passwort
b_change_password=Passwort ändern
b_email=E-Mail
b_change_email=E-Mail ändern
b_status=Status
b_id=ID
b_tags=Tags
b_thisitemcurhiddenlist=Dieses Element ist derzeit in der öffentlichen Liste verborgen!
b_nobooktitlelist=Unbekannter Titel
b_hidden=Versteckt
b_lend=Verleihen
b_return=Zurückgeben
b_hardback=Gebundene Ausgabe
b_paperback=Taschenbuch
b_softcover=Softcover
b_bookcurrentlyrented=Dieses Buch ist derzeit von einem anderen Benutzer reserviert und wird bald verfügbar sein!
b_available=Verfügbar
b_reserved=Reserviert
b_user=Benutzer
b_until=Bis
b_returndate=Rückgabedatum
b_note=Notiz
b_lendtouser=An Benutzer verleihen
b_changefavicon=Favicon ändern
b_settings_exp_string=Auf dieser Seite können Sie die Funktionen der Website steuern.
b_tel=Telefon
be_pp_sr1ssd=Wurde das Buch zurückgegeben?
be_error_booknoexists=Das Buch, das Sie ansehen wollten, existiert nicht!
be_error_usernoexists=Der Benutzer, den Sie ansehen wollten, existiert nicht!
be_puser_chdele3=Benutzer aktivieren
b_prof_pwinfoadd=Als Administrator können Sie Benutzer-E-Mails ohne Aktivierung ändern.



############################################################################################################################################4

be_about_core_info=CMS Version
be_about_fw_info=Framework Version
be_about_site_info=Modul Version
be_set_header_general=Allgemeine Einstellungen
be_set_header_mail=E-Mail Einstellungen
be_set_header_trans=Übersetzungs Einstellungen
be_set_header_about=Systeminformationen
be_string_key=Schlüssel
be_string_language=Sprache
be_string_translation=Übersetzung
be_trans_current_active=Standardübersetzungen
be_trans_current_ovr=Übersetzungsüberschreibungen
be_trans_button_create=Übersetzung erstellen
be_trans_button_edit=Übersetzung bearbeiten
be_trans_dlrly=Möchten Sie diese Übersetzung wirklich löschen?
be_eexps_hivetitle=Titel dieser Website.
be_eexps_imp=Ihr Impressum Text
be_eexps_pry=Ihr Datenschutz Text
be_eexps_expiretoken=E-Mail Token läuft nach einer bestimmten Anzahl von Minuten ab.
be_eexps_expireip=IP-Fehlergrenze vor der Blacklistung.
be_eexps_expirecsrf=Zeit in Sekunden, wie lange CSRF-Schlüssel gültig sind, bevor sie ablaufen.
be_eexps_expireact=Zeit in Minuten, die Benutzer zwischen Passwort-Wiederherstellungs-/E-Mail-Änderungsanfragen warten müssen.
be_eexps_upgc=Schützen Sie den Onsite-Updater mit einem Zugangscode.
be_eexps_actmc=Erlauben Sie Benutzern, ihre E-Mail-Adresse zu ändern.
be_eexps_actrec=Erlauben Sie Benutzern, ihr Passwort wiederherzustellen.
be_eexps_actreg=Erlauben Sie Gästen, sich auf dieser Website zu registrieren.
be_eexps_actdeflang=Standardsprache für Gäste, wenn sie keine eigene Sprache festgelegt haben.
be_eexps_trapage=In diesem Abschnitt können Sie Standardübersetzungen sehen und bei Bedarf überschreiben.
be_eexpm_user=Benutzername für den E-Mail-Server
be_eexpm_pass=Passwort für den E-Mail-Server
be_eexpm_host=SMTP Hostname
be_eexpm_port=SMTP Port
be_eexpm_auth=SMTP Authentifizierungsmethode
be_eexpm_sm=Absender-E-Mail für ausgehende Mails
be_eexpm_sn=Absendername für ausgehende Mails
be_eexpm_mh=Standard E-Mail Kopfzeile
be_eexpm_debug=Wenn Probleme beim Senden von E-Mails auftreten, können Sie das Debugging hier aktivieren - in diesem Fall werden bei jeder Sendeoperation Debug-Informationen auf dem Bildschirm angezeigt, auch wenn die Sendung erfolgreich war.
be_eexpm_ins=Erlaube unsichere SMTP-Verbindungen
be_eexpm_mf=Standard E-Mail Fußzeile
obr_inp_title=Titel
obr_inp_autor=Autor
obr_inp_publisher=Verlag
obr_inp_isbn=ISBN
obr_inp_lang=Sprache
obr_inp_tags=Schlagwörter
be_obr_li_id=Buch-ID
be_obr_li_book_title=Titel
be_obr_li_book_autor=Autor
be_obr_li_book_type=Buchart
be_obr_li_book_publisher=Verlag
be_obr_li_book_isbn=ISBN
be_obr_li_book_lang=Sprache
be_obr_li_book_tag_array=Verbundene Kategorien
be_obr_li_book_creation=Erstellungsdatum
be_obr_li_book_modification=Änderungsdatum
be_obr_update_book=Buchdaten über ISBN abrufen
be_obr_delete_book=Buch löschen
be_obr_add_stock=Verleihbare Exemplare
obr_book_item_list=Liste der verleihbaren Exemplare
be_op_usr_622=Der Benutzer wurde bearbeitet.



############################################################################################################################################5

string_add=Hinzufügen
be_exp_usrlst=Hier können Sie Benutzer verwalten und erstellen.
be_user_area_usrname=Name
be_opok=Sie sehen diese Seite, weil Sie eine Aktivierung angefordert haben.<br/>Siehe das Ereignisfeld in der oberen rechten Ecke für Details.
be_operr=Fehler
be_str_item_createderr=API-Token konnte nicht erstellt werden, dies tritt meistens auf, wenn dieses Token bereits für das zugehörige Site-Modul existiert!
be_mail_template_edit=E-Mail-Vorlage bearbeiten
be_mail_exp_recover=E-Mail-Vorlage zur Wiederherstellung registrierter Benutzer. Diese Vorlage wird gesendet, wenn Benutzer ein neues Passwort über die Funktion 'Passwort vergessen' anfordern. Eine Ersetzung wird bereitgestellt, um dem Benutzer einen Link zu geben. Mit einfacher Ersetzung _ACTION_URL_.
be_mail_exp_mchange=E-Mail-Vorlage für Änderungen der registrierten Benutzer-E-Mails. Diese Vorlage wird gesendet, wenn der Benutzer seine primäre E-Mail ändert oder wenn sie allgemein geändert wird. Eine Ersetzung wird bereitgestellt, um dem Benutzer einen Link zur Aktivierung und Bestätigung der neuen E-Mail zu geben. Mit einfacher Ersetzung _ACTION_URL_ für die Aktivierungs-URL.
be_mail_exp_acti=E-Mail-Vorlage zur Aktivierung registrierter Benutzer. Diese Vorlage wird gesendet, wenn Benutzer oder Firmenmitarbeiter erstellt werden. Eine Ersetzung wird bereitgestellt, um dem Benutzer einen Link zu geben. Mit einfacher Ersetzung _ACTION_URL_ zur Aktivierung des neuen Kontos. Der Benutzer kann auch das Passwort wiederherstellen, um das Konto zu aktivieren.
be_se_key_mch=Mail Aktivierungsschlüssel
b_permission=Berechtigungen
be_user_area_name=Benutzerverwaltung
be_user_area_create=Benutzer hinzufügen
be_usr_ad_errgm=Der Benutzer wurde erstellt, aber beim Versuch, die Aktivierungs-E-Mail zu senden, trat ein Fehler auf!
be_noti_user_crea=Bitte beachten Sie, dass wenn ein Benutzer sein Konto nicht bestätigt hat und ein anderer Benutzer versucht, sich mit derselben E-Mail anzumelden, der ursprüngliche unbestätigte Benutzer gelöscht werden kann. Dies kann zu Datenverlust führen. Stellen Sie sicher, dass Sie immer mit bestätigten Benutzern arbeiten, wenn Sie nicht möchten, dass das System sie löscht. Verwenden Sie niemals Funktionen, um Benutzer zu entbestätigen, da dies ebenfalls zu Datenverlust führen kann.
be_usr_ad_errg=Fehler beim Versuch, den Benutzer zu erstellen.
be_usr_ad_hpasserem=Das gewählte Passwort entspricht nicht den Empfehlungen!
be_usr_ad_hpass=Passwort
be_usr_ad_h=Aktivierungsverfahren
be_usr_ad_rec=Anfordern der E-Mail-Aktivierung und des Benutzers zur Festlegung eines eigenen Passworts
be_usr_ad_act=Nur Aktivierung per E-Mail anfordern
be_usr_ad_ok=Diesen Benutzer ohne Aktivierungsverfahren aktivieren
be_puser_noview=Diesen Benutzer gibt es nicht!
be_puser_cpass=Passwort ändern
be_puser_cpass1=Passwort bestätigen
be_puser_cpass2=Neues Passwort
be_puser_cper=Berechtigungen ändern
be_puser_chmm=Benutzer-E-Mail ändern
be_puser_chmm1=Neue E-Mail
be_puser_chdele=Benutzer löschen
be_puser_chdele1=Benutzeroperationen
be_puser_chdele7=Dieser Benutzer ist derzeit nicht per E-Mail bestätigt!
be_puser_chdele8=Dieser Benutzer ist derzeit blockiert!
be_puser_chdele9=Dieser Benutzer ist derzeit deaktiviert!
be_puser_chdele10=Dies ist das ursprüngliche Super-Admin-Konto! Es hat immer vollen Zugriff auf dieses Admin-Panel!
be_puser_chdele11=Dieses Profil gehört zu einem anderen Benutzer als Sie! Seien Sie vorsichtig beim Ändern von Einstellungen, da Änderungen Auswirkungen auf die Benutzererfahrung haben!
be_puser_chdele12=Warten auf neue E-Mail-Aktivierung für:
be_puser_chdele13=Klicken Sie hier, um den Vorgang abzubrechen.
be_puser_chdele14=Die E-Mail darf nicht leer sein!
be_puser_chdele15=Unbekannter Fehler
be_puser_chdele16=Die Funktion zur Änderung der E-Mail ist für diesen Benutzer derzeit deaktiviert!
be_puser_chdele17=Es ist nicht erlaubt, die E-Mail dieses Benutzers zu ändern.
be_puser_chdele18=Es gibt bereits einen aktiven Benutzer mit dieser E-Mail! Doppelte E-Mails bei Benutzern sind nicht möglich.
be_puser_chdele19=Sie müssen eine bestimmte Zeit zwischen E-Mail-Änderungsanforderungen warten: 
be_puser_chdele20=Minuten
be_puser_chdele21=Bitte überprüfen Sie Ihr neues E-Mail-Postfach, um die neue E-Mail zu aktivieren!
be_puser_chdele22=Beim Senden der Aktivierungs-E-Mail ist ein Fehler aufgetreten!
be_puser_chdele23=Die E-Mail-Änderungsanforderung wurde abgebrochen!
be_op_usr_1=Das Passwort muss mindestens eine Zahl, einen Kleinbuchstaben und einen Großbuchstaben enthalten! Mindestens 10 Zeichen sind erforderlich.
be_op_usr_2=Passwörter dürfen nicht leer sein!
be_op_usr_3=Die Passwörter stimmen nicht überein!
be_op_usr_4=Das Passwort wurde geändert!
be_op_usr_6=Die Benutzerberechtigungen wurden geändert!
be_op_usr_11=Der Benutzer wurde bestätigt und kann sich nun anmelden!
be_op_usr_12=Der Benutzer wurde gelöscht!
be_book_area_create=Buch erstellen


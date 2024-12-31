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

# Strings - Allgemein
string_email=E-Mail
string_password=Passwort
string_login=Anmelden
string_register=Registrieren
string_close=Schließen
string_error=Fehler

# Seite - Aktionen
hive_login_changelanguage=Sie können die Sprache ändern
hive_login_changelanguage_here=hier.
hive_login_lostpass=Passwort vergessen?
hive_login_notregistered=Nicht registriert?
hive_login_rememberme=Cookies verwenden?
hive_login_recoveraccount=Konto wiederherstellen
hive_login_haveaccount=Bereits ein Konto?
hive_login_password_confirm=Passwort bestätigen
hive_login_mc_change_mail=E-Mail ändern
hive_login_mc_backtohome=Zurück zur Startseite
hive_login_title_accactivation=Kontenaktivierung
hive_cannotenterwhilenologin=Sie können diese Seite nicht betreten, wenn Sie nicht eingeloggt sind!
hive_cannotenterwhilelogin=Sie können diese Seite nicht betreten, wenn Sie eingeloggt sind!
hive_cannotoperatesiteerror=Es liegt ein kritischer Fehler im Modul dieser Seite vor, daher können Sie derzeit keine Aktionen ausführen!
hive_login_backtologin=Zurück zum Login
hive_login_change_Lang=Sprache ändern
hive_login_language_changed=Die Sprache wurde geändert!

# Login-Ereignisse - Allgemein
hive_login_msg_l_wrong=Falsche Passwort/E-Mail-Kombination.
hive_login_msg_csrf=Formular abgelaufen, bitte erneut versuchen.
hive_login_msg_empty=Bitte geben Sie die erforderlichen Daten ein!
hive_login_msg_ipban=Ihre IP ist derzeit gesperrt; bitte versuchen Sie es später erneut.
hive_login_msg_logout=Sie wurden ausgeloggt!
hive_login_msg_nomatchpass=Die Passwortbestätigung stimmt nicht mit dem eingegebenen Passwort überein.
hive_login_doremember=Möchten Sie Ihr Passwort speichern?

# Login-Ereignisse - Login
hive_login_msg_l_ok=Login erfolgreich.
hive_login_msg_l_blocked=Sie können sich nicht einloggen, da Ihr Konto gesperrt ist.
hive_login_msg_l_inactive=Ihr Benutzerkonto ist noch nicht aktiviert! Stellen Sie Ihr Passwort wieder her, um Ihr Konto zu aktivieren, oder klicken Sie auf die URL in der Aktivierungs-E-Mail, die Sie erhalten haben!
hive_login_msg_l_blockedpwf=Sie haben zu oft ein falsches Passwort eingegeben, und Ihr Konto wurde gesperrt!
hive_login_msg_l_disabled=Ihr Benutzerkonto wurde deaktiviert!
hive_login_mail_serror=Fehler beim Versuch, eine E-Mail zu senden. Dies ist ein interner Fehler, der untersucht werden muss und dem Personal unserer Website gemeldet werden sollte.
hive_login_msg_register_ok=Bitte überprüfen Sie Ihren E-Mail-Posteingang, um Ihr neues Konto zu aktivieren!
hive_login_msg_passfiltererror=Das eingegebene Passwort erfüllt nicht die Passwortregeln!
hive_login_msg_mailexist=Sie versuchen, ein Konto mit einer bereits existierenden E-Mail zu registrieren!
hive_login_password_rules=Passwortregeln
hive_login_password_sign=Erforderliche Zeichen:
hive_login_password_cap=Erforderliche Großbuchstaben:
hive_login_password_small=Erforderliche Kleinbuchstaben:
hive_login_password_special=Erforderliche Sonderzeichen:
hive_login_password_numeric=Erforderliche Zahlen:

# Login-Ereignisse - E-Mail-Änderung
hive_login_msg_m_ok=Sie haben Ihre neue E-Mail erfolgreich aktiviert!
hive_login_msg_m_er=Fehler beim Aktivieren der neuen E-Mail-Adresse; bitte versuchen Sie es erneut.
hive_login_msg_m_exp=Der Aktivierungscode für die E-Mail ist abgelaufen! Bitte versuchen Sie erneut, Ihre E-Mail zu ändern!
hive_login_msg_m_res=Die E-Mail, die Sie aktivieren wollten, wird jetzt von einem anderen Konto verwendet und kann daher nicht mit Ihrem Konto verknüpft werden!
hive_login_msg_m_block=Ihr Konto ist für E-Mail-Änderungen gesperrt!
hive_login_msg_m_noadr=Die Anfrage ist fehlgeschlagen. Bitte versuchen Sie es später erneut.
hive_login_mc_cmailtext=Ihre aktuelle E-Mail ist:
hive_login_msg_rec_ok=Bitte überprüfen Sie den Posteingang der neuen E-Mail, um die neue E-Mail-Adresse zu aktivieren.
hive_login_msg_rec_err=Fehler beim Versuch, die E-Mail-Adresse zu ändern.
hive_login_msg_rec_wait=Sie müssen 120 Minuten zwischen E-Mail-Änderungen warten!
hive_login_msg_rec_exist=Die E-Mail, die Sie ändern möchten, wird bereits von einem anderen Benutzerkonto verwendet!
hive_login_msg_rec_block=Ihr Konto ist für E-Mail-Änderungen gesperrt!
hive_login_msg_rec_disable=Sie können die E-Mail eines deaktivierten Kontos nicht ändern!

# Login-Mails
hive_login_mail_pre_change=Aktivieren Sie Ihre neue E-Mail hier: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_change=Aktivieren Sie Ihre neue E-Mail
hive_login_mail_title_register=Aktivieren Sie Ihr neues Konto
hive_login_mail_pre_register=Klicken Sie auf den folgenden Link, um Ihr Konto zu aktivieren: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_rec=Stellen Sie Ihr Konto wieder her
hive_login_mail_pre_rec=Klicken Sie auf den folgenden Link, um Ihr Passwort wiederherzustellen: <a href="SF_ACTION_URL">SF_ACTION_URL</a>

# Login - Aktivierung
hive_login_msg_a_ok=Sie haben Ihr Konto erfolgreich aktiviert! Sie können sich jetzt auf dieser Website einloggen.
hive_login_msg_a_er=Fehler beim Versuch, das Benutzerkonto zu aktivieren. Bitte versuchen Sie, Ihr Passwort wiederherzustellen oder ein neues Konto zu registrieren.
hive_login_msg_a_exp=Das Aktivierungstoken ist ungültig. Bitte stellen Sie Ihr Konto auf der Login-Seite wieder her, um Ihr Konto zu aktivieren!
hive_login_msg_a_block=Die Aktivierung für Ihr Konto wurde deaktiviert; bitte versuchen Sie es später erneut!

# Login - Wiederherstellungsanfrage
hive_login_msg_rr_recnewunk=Die angegebene E-Mail ist nicht registriert.
hive_login_msg_rr_recnope=Ihr Konto hat keine Berechtigung, das Passwort wiederherzustellen!
hive_login_msg_rr_recnopede=Ihr Konto wurde deaktiviert und kann keine neuen Anfragen stellen!
hive_login_msg_rr_recwait=Sie müssen 120 Minuten warten, bevor Sie eine neue Wiederherstellungsanfrage starten!
hive_login_msg_rr_recnok=Bitte überprüfen Sie Ihren Posteingang auf eine Passwort-Reset-E-Mail. Diese E-Mail enthält einen Link zur Wiederherstellung Ihres Passworts.
hive_login_msg_recfr_ok=Bitte überprüfen Sie Ihren E-Mail-Posteingang, um einen Link zur Passwortwiederherstellung zu erhalten!

# Login - Wiederherstellung ausführen
hive_login_msg_pwtexpire=Dieses Passwort-Wiederherstellungs-Token ist abgelaufen! Bitte versuchen Sie erneut, Ihr Konto wiederherzustellen.
hive_login_msg_recexecerror=Fehler beim Versuch, Ihr Passwort wiederherzustellen. Bitte versuchen Sie erneut, Ihr Konto wiederherzustellen.
hive_login_msg_recexecok=Sie haben Ihr Passwort erfolgreich wiederhergestellt und können sich jetzt mit Ihrem neuen Passwort einloggen.

##########################################################################################
## Setupable Constant Explanations
##########################################################################################

hive_var_exp_1=Thema: Standardfarbe für dynamische Themenfarben
hive_var_exp_2=Thema: Serialisiertes Array mit gültigen Themen
hive_var_exp_3=Thema: Standardmäßig verwendetes Thema
hive_var_exp_4=Sprache: Serialisiertes Array mit gültigen Sprachen
hive_var_exp_5=Sprache: Array mit Standardsprache
hive_var_exp_6=Aktionen: Allgemeines Registrierungsformular aktiv? (1=ein/0=aus)
hive_var_exp_7=Keine Erklärung verfügbar.
hive_var_exp_8=Aktionen: Allgemeines Wiederherstellungsformular aktiv? (1=ein/0=aus)
hive_var_exp_9=Aktionen: Allgemeines Aktivierungsformular aktiv? (1=ein/0=aus)
hive_var_exp_10=Allgemeines Login-Formular aktiv? (1=ein/0=aus)
hive_var_exp_11=TinyMCE: Plugin-Konfigurations-String
hive_var_exp_12=TinyMCE: Menüleisten-Konfigurations-String
hive_var_exp_13=TinyMCE: Werkzeugleisten-Konfigurations-String
hive_var_exp_14=Benutzerkonfiguration: Maximale Tage, in denen Sitzungen/Cookies gültig sind
hive_var_exp_15=Benutzerkonfiguration: Zeit in Minuten, die Token aus Aktivierungsmails gültig sind
hive_var_exp_16=Benutzerkonfiguration: Benutzer nach X fehlgeschlagenen Logins sperren (0 zum Deaktivieren)
hive_var_exp_17=Benutzerkonfiguration: Zeit in Minuten, die ein Benutzer zwischen Anfragen warten muss (Anti-Flood)
hive_var_exp_18=Benutzerkonfiguration: Alte Sitzungen protokollieren? (Logins, Wiederherstellungen, Aktivierungen, Mailänderungen) (1=ein/0=aus)
hive_var_exp_19=Benutzerkonfiguration: Benutzer-IP-Adressen in der Datenbank protokollieren (1=ein/0=aus)
hive_var_exp_20=Benutzerkonfiguration: 1 - Wiederherstellungsschlüssel nach erfolgreichem Login entfernen | 0 - Schlüssel behalten
hive_var_exp_21=Benutzerkonfiguration: 1 - Multi-Login erlauben | 0 - Multi-Login deaktivieren
hive_var_exp_22=Passwortfilter: Mindestanzahl an Zeichen
hive_var_exp_23=Passwortfilter: Mindestanzahl an Großbuchstaben
hive_var_exp_24=Passwortfilter: Mindestanzahl an Kleinbuchstaben
hive_var_exp_25=Passwortfilter: Mindestanzahl an Sonderzeichen
hive_var_exp_26=Passwortfilter: Mindestanzahl an Zahlen
hive_var_exp_27=Initial erstellter Benutzername
hive_var_exp_28=Initial erstelltes Benutzerpasswort
hive_var_exp_29=Captcha: Höhe des Bildes
hive_var_exp_30=Captcha: Breite des Bildes
hive_var_exp_31=Captcha: Farben für Captcha (Optional, kann 0 sein)
hive_var_exp_32=Captcha: Schriftart (Wenn 0, wird Standardschriftart verwendet)
hive_var_exp_33=Redis: Aktiviert? 1/0
hive_var_exp_34=Redis: Host
hive_var_exp_35=Redis: Port
hive_var_exp_36=Updater: Titel des Updaters auf dieser Seite
hive_var_exp_37=Updater: Code erforderlich für Update? (0 zum Deaktivieren)
hive_var_exp_38=Einstellungen: CURL-Klassenanfragen protokollieren? (1/0)
hive_var_exp_39=Einstellungen: IPs nach X Fehlern blockieren (0 zum Deaktivieren)
hive_var_exp_40=Einstellungen: Referer protokollieren? (1/0)
hive_var_exp_41=Einstellungen: Standardgültigkeitszeit des CSRF-Codes in Sekunden
hive_var_exp_42=Einstellungen: 1 - Cronjob-Ausführung nur über Kommandozeile | 0 - Cronjob-Ausführung im Browser erlauben
hive_var_exp_43=Einstellungen: JavaScript-Debugging-Fehlerprotokollierung aktivieren (1/0)
hive_var_exp_44=Einstellungen: Website-Titel für Tabs und mehr
hive_var_exp_45=Einstellungen: Titeltrennzeichen für Tabs im Browser
hive_var_exp_46=Einstellungen: PHP-Fehler auf der Website anzeigen? (1/0)
hive_var_exp_47=Einstellungen: Serialisiertes Array mit benötigten PHP-Modulen, falls nicht vorhanden, wird ein Fehler angezeigt (Beispiel: array("mysqli", "mbstring", "gd"))
hive_var_exp_48=Einstellungen: MySQL-Fehler auf der Seite anzeigen und stoppen, falls sie auftreten? (Wird immer in der x_log_mysql-Tabelle protokolliert) (1/0)
hive_var_exp_49=Einstellungen: 1 - SEO-URLs verwenden | 0 - Keine SEO-URLs verwenden
hive_var_exp_50=Einstellungen: Nur erforderlich, wenn _HIVE_URL_SEO_ == false [Name für GET-Location-Variablen im serialisierten Array]
hive_var_exp_51=Mail-Konfiguration: SMTP-Passwort
hive_var_exp_52=Mail-Konfiguration: SMTP-Benutzername
hive_var_exp_53=Mail-Konfiguration: SMTP-Auth (ssl/tls/false)
hive_var_exp_54=Mail-Konfiguration: SMTP-Port
hive_var_exp_55=Mail-Konfiguration: SMTP-Host
hive_var_exp_56=Mail-Konfiguration: Mail-Debug-Modus (0, 1, 2, 3) - Verwenden Sie 0 für die Produktion, da dies Debug-Ausgaben auf der Seite zur Folge hat!
hive_var_exp_57=Mail-Konfiguration: Unsichere SSL-Verbindungen erlauben? (1/0)
hive_var_exp_58=Mail-Konfiguration: Alle Mails als HTML versenden? (1/0)
hive_var_exp_59=Mail-Konfiguration: Standard-Absender-Name
hive_var_exp_60=Mail-Konfiguration: Standard-Absender-Adresse
hive_var_exp_61=Mail-Konfiguration: Standard-Footer für Mails
hive_var_exp_62=Mail-Konfiguration: Standard-Header für Mails

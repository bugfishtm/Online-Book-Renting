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

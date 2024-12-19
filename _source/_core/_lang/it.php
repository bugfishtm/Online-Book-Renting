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
string_email=E-Mail
string_password=Password
string_login=Accesso
string_register=Registrati
string_close=Chiudi
string_error=Errore

# Page - Actions
hive_login_changelanguage=Puoi cambiare la lingua
hive_login_changelanguage_here=qui.
hive_login_lostpass=Password Dimenticata?
hive_login_notregistered=Non Sei Registrato?
hive_login_rememberme=Usare i Cookie?
hive_login_recoveraccount=Recupera Account
hive_login_haveaccount=Hai già un Account?
hive_login_password_confirm=Conferma Password
hive_login_mc_change_mail=Cambia E-Mail
hive_login_mc_backtohome=Ritorna alla Home
hive_login_title_accactivation=Attivazione Account
hive_cannotenterwhilenologin=Non puoi accedere a questa pagina se non sei loggato!
hive_cannotenterwhilelogin=Non puoi accedere a questa pagina se sei già loggato!
hive_cannotoperatesiteerror=C'è un errore critico in questo modulo del sito, quindi attualmente non puoi eseguire alcuna operazione!
hive_login_backtologin=Ritorna al Login
hive_login_change_Lang=Cambia Lingua
hive_login_language_changed=La lingua è stata cambiata!

# Login Events - General
hive_login_msg_l_wrong=Combinazione di Password/E-Mail errata.
hive_login_msg_csrf=Modulo scaduto, riprova.
hive_login_msg_empty=Inserisci i dati richiesti!
hive_login_msg_ipban=Il tuo IP è attualmente bloccato; riprova più tardi.
hive_login_msg_logout=Sei stato disconnesso!
hive_login_msg_nomatchpass=La conferma della password non corrisponde alla password inserita.
hive_login_doremember=Vuoi ricordare la tua password?

# Login Events - Login
hive_login_msg_l_ok=Accesso riuscito.
hive_login_msg_l_blocked=Non puoi accedere perché il tuo account è bloccato.
hive_login_msg_l_inactive=Il tuo account utente non è ancora attivato! Recupera la tua password per attivare il tuo account o clicca il link nell'E-Mail di attivazione che hai ricevuto!
hive_login_msg_l_blockedpwf=Hai inserito troppe volte la password sbagliata e il tuo account è stato bloccato!
hive_login_msg_l_disabled=Il tuo account utente è stato disabilitato!
hive_login_mail_serror=Errore durante il tentativo di inviare l'E-Mail. Questo è un errore interno che deve essere indagato e segnalato al personale del nostro sito web.
hive_login_msg_register_ok=Controlla la tua casella di posta elettronica per attivare il tuo nuovo account!
hive_login_msg_passfiltererror=La password inserita non soddisfa le regole per le password!
hive_login_msg_mailexist=Stai tentando di registrare un account con un'E-Mail già esistente!
hive_login_password_rules=Regole per la Password
hive_login_password_sign=Caratteri Richiesti:
hive_login_password_cap=Lettere Maiuscole Richieste:
hive_login_password_small=Lettere Minuscole Richieste:
hive_login_password_special=Caratteri Speciali Richiesti:
hive_login_password_numeric=Caratteri Numerici Richiesti:

# Login Events - Mail Change
hive_login_msg_m_ok=Hai attivato con successo la tua nuova E-Mail!
hive_login_msg_m_er=Errore durante l'attivazione del nuovo indirizzo E-Mail; riprova.
hive_login_msg_m_exp=Il codice di attivazione E-Mail è scaduto! Riprova a cambiare la tua E-Mail!
hive_login_msg_m_res=L'E-Mail che hai provato ad attivare è ora utilizzata da un altro account, quindi non può essere associata al tuo account!
hive_login_msg_m_block=Il tuo account è bloccato per i cambiamenti di E-Mail!
hive_login_msg_m_noadr=La richiesta è fallita. Riprova più tardi.
hive_login_mc_cmailtext=La tua E-Mail attuale è:
hive_login_msg_rec_ok=Controlla la nuova casella di posta elettronica per attivare il nuovo indirizzo E-Mail.
hive_login_msg_rec_err=Errore durante il tentativo di cambiare l'indirizzo E-Mail.
hive_login_msg_rec_wait=Devi attendere 120 minuti tra i cambiamenti di E-Mail!
hive_login_msg_rec_exist=L'E-Mail che stai tentando di cambiare è già utilizzata da un altro account!
hive_login_msg_rec_block=Il tuo account è bloccato per i cambiamenti di E-Mail!
hive_login_msg_rec_disable=Non puoi cambiare l'E-Mail di un account disabilitato!

# Login Mails
hive_login_mail_pre_change=Attiva la tua nuova mail qui: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_change=Attiva la Tua Nuova E-Mail
hive_login_mail_title_register=Attiva il Tuo Nuovo Account
hive_login_mail_pre_register=Clicca il seguente link per attivare il tuo account: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_rec=Recupera il Tuo Account
hive_login_mail_pre_rec=Clicca il seguente link per recuperare la password del tuo account: <a href="SF_ACTION_URL">SF_ACTION_URL</a>

# Login - Activation
hive_login_msg_a_ok=Hai attivato con successo il tuo account! Ora puoi accedere alle nostre pagine di login su questo sito.
hive_login_msg_a_er=Errore durante il tentativo di attivare l'account utente. Prova a recuperare la password del tuo account o registrane uno nuovo.
hive_login_msg_a_exp=Il token di attivazione non è valido. Recupera il tuo account nella pagina di login per attivare il tuo account!
hive_login_msg_a_block=L'attivazione per il tuo account è stata disabilitata; riprova più tardi!

# Login - Recover Request
hive_login_msg_rr_recnewunk=L'E-Mail fornita non è registrata.
hive_login_msg_rr_recnope=Il tuo account non ha il permesso di recuperare la password!
hive_login_msg_rr_recnopede=Il tuo account è stato disattivato e non può effettuare nuove richieste!
hive_login_msg_rr_recwait=Devi attendere 120 minuti prima di iniziare una nuova richiesta di recupero!
hive_login_msg_rr_recnok=Controlla la tua casella di posta per un'E-Mail di reset della password. Questa mail contiene un link per recuperare la tua password.
hive_login_msg_recfr_ok=Controlla la tua casella di posta elettronica per ottenere un link per il recupero della password!

# Login - Recover Execute
hive_login_msg_pwtexpire=Questo Token per il Recupero della Password è scaduto! Riprova a recuperare il tuo account.
hive_login_msg_recexecerror=Errore durante il tentativo di recuperare la password. Prova di nuovo a recuperare il tuo account.
hive_login_msg_recexecok=Hai recuperato con successo la tua password e ora puoi accedere con la tua nuova password.

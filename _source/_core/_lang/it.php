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

##########################################################################################
## Setupable Constant Explanations
##########################################################################################

hive_var_exp_1=Tema: Colore predefinito per colori del tema dinamico
hive_var_exp_2=Tema: Array serializzato con temi validi
hive_var_exp_3=Tema: Tema predefinito utilizzato
hive_var_exp_4=Lingua: Array serializzato con lingue valide
hive_var_exp_5=Lingua: Array con lingua predefinita
hive_var_exp_6=Azioni: Modulo di registrazione generale attivo? (1=attivo/0=disattivo)
hive_var_exp_7=Nessuna spiegazione disponibile.
hive_var_exp_8=Azioni: Modulo di recupero generale attivo? (1=attivo/0=disattivo)
hive_var_exp_9=Azioni: Modulo di attivazione generale attivo? (1=attivo/0=disattivo)
hive_var_exp_10=Modulo di login generale attivo? (1=attivo/0=disattivo)
hive_var_exp_11=TinyMCE: Stringa di configurazione dei plugin
hive_var_exp_12=TinyMCE: Stringa di configurazione della barra del menu
hive_var_exp_13=TinyMCE: Stringa di configurazione della barra degli strumenti
hive_var_exp_14=Configurazione utente: Massimo giorni di validità delle sessioni/cookie
hive_var_exp_15=Configurazione utente: Tempo in minuti di validità dei token delle email di attivazione
hive_var_exp_16=Configurazione utente: Blocca utenti dopo X tentativi di login falliti (può essere 0 per disabilitare)
hive_var_exp_17=Configurazione utente: Tempo in minuti che un utente deve aspettare tra le richieste (antiflood)
hive_var_exp_18=Configurazione utente: Registrare vecchie sessioni? (Login, Recuperi, Attivazioni, Cambi email) (1=attivo/0=disattivo)
hive_var_exp_19=Configurazione utente: Registrare gli indirizzi IP degli utenti nel database (1=attivo/0=disattivo)
hive_var_exp_20=Configurazione utente: 1 - Rimuovere le chiavi di recupero dopo il login riuscito | 0 - Conservare le chiavi
hive_var_exp_21=Configurazione utente: 1 - Consentire multi-login | 0 - Disabilitare multi-login
hive_var_exp_22=Filtro password: Minimo segni
hive_var_exp_23=Filtro password: Minimo segni maiuscoli
hive_var_exp_24=Filtro password: Minimo segni minuscoli
hive_var_exp_25=Filtro password: Minimo segni speciali
hive_var_exp_26=Filtro password: Minimo segni numerici
hive_var_exp_27=Nome utente creato inizialmente
hive_var_exp_28=Password utente creata inizialmente
hive_var_exp_29=Captcha: Altezza immagine
hive_var_exp_30=Captcha: Larghezza immagine
hive_var_exp_31=Captcha: Colori per il Captcha (opzionale, può essere 0)
hive_var_exp_32=Captcha: Font (Se 0 verrà utilizzato il font predefinito)
hive_var_exp_33=Redis: Attivato? (1/0)
hive_var_exp_34=Redis: Host
hive_var_exp_35=Redis: Porta
hive_var_exp_36=Aggiornamenti: Titolo per l'aggiornamento su questo sito
hive_var_exp_37=Aggiornamenti: Codice richiesto per l'aggiornamento? (può essere 0 per disabilitare)
hive_var_exp_38=Impostazioni: Registrare richieste della classe CURL? (1/0)
hive_var_exp_39=Impostazioni: Bloccare IP dopo X errori (può essere 0 per disabilitare)
hive_var_exp_40=Impostazioni: Registrare i referer? (1/0)
hive_var_exp_41=Impostazioni: Tempo predefinito di validità del codice CSRF in secondi
hive_var_exp_42=Impostazioni: 1 - Consentire esecuzione cronjob solo da linea di comando | 0 - Consentire esecuzione cronjob da browser
hive_var_exp_43=Impostazioni: Attivare il logging degli errori di debug di Javascript (1/0)
hive_var_exp_44=Impostazioni: Titolo del sito web per schede e altro
hive_var_exp_45=Impostazioni: Separatore del titolo per schede nel browser
hive_var_exp_46=Impostazioni: Mostrare errori PHP sul sito web? (1/0)
hive_var_exp_47=Impostazioni: Array serializzato con i moduli PHP richiesti; se mancanti viene mostrato un errore (esempio: array("mysqli", "mbstring", "gd"))
hive_var_exp_48=Impostazioni: Interrompere e mostrare errori MySQL sulla pagina se accadono? (Saranno sempre registrati nella tabella x_log_mysql) (1/0)
hive_var_exp_49=Impostazioni: 1 - Utilizzare URL SEO | 0 - Non utilizzare URL SEO
hive_var_exp_50=Impostazioni: Necessario solo se _HIVE_URL_SEO_ == falso [Nome per le variabili di localizzazione Get in array serializzato]
hive_var_exp_51=Configurazione email: Password SMTP
hive_var_exp_52=Configurazione email: Nome utente SMTP
hive_var_exp_53=Configurazione email: Autenticazione SMTP (ssl/tls/falso)
hive_var_exp_54=Configurazione email: Porta SMTP
hive_var_exp_55=Configurazione email: Host SMTP
hive_var_exp_56=Configurazione email: Modalità debug email (0, 1, 2, 3) - Usare 0 in produzione perché produce output di debug sul sito!
hive_var_exp_57=Configurazione email: Consentire connessioni SSL non sicure? (1/0)
hive_var_exp_58=Configurazione email: Inviare tutte le email in formato HTML? (1/0)
hive_var_exp_59=Configurazione email: Nome mittente predefinito
hive_var_exp_60=Configurazione email: Indirizzo mittente predefinito
hive_var_exp_61=Configurazione email: Footer predefinito per le email
hive_var_exp_62=Configurazione email: Header predefinito per le email

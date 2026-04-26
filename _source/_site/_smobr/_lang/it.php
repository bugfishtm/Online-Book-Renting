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

## Error
be_404_2=Errore 404
be_404_1=Il contenuto richiesto non esiste!
be_401_2=Accesso Negato
be_401_1=Non hai accesso a quest'area!
b_permissions=Permessi

## Popups
be_edit_abort=Clicca qui per interrompere l'operazione!
be_list_h_exec_flush=Tutti gli elementi in questa tabella sono stati eliminati!
be_list_h_btn_flush_rly=Vuoi davvero svuotare questa tabella? Questo reinizializzerà la relativa tabella del database e cancellerà tutte le vecchie voci in essa!
be_list_h_btn_flush=Svuota Tabella
be_cbanner_1=Questo sito web utilizza i cookie di sessione!
be_cbanner_2=Accetto
be_pp_hide=Vuoi davvero nascondere questo elemento nella lista pubblica dei libri?
be_pp_unhide=Vuoi davvero mostrare questo elemento nella lista pubblica dei libri?
be_pp_delbook=Vuoi davvero eliminare questo libro? Questo cancellerà tutte le informazioni correlate e il registro associato.
be_pp_errimage=Seleziona un file jpg valido!
be_pp_errimage1=Nessun file caricato o si è verificato un errore durante il caricamento.
be_pp_errimage2=Errore durante lo spostamento del file caricato.
be_pp_errimage3=Tipo di file non valido. Sono consentiti solo file JPG.
be_pp_sapi=Questo sovrascriverà le informazioni attuali del libro con le informazioni recuperate da openLibrary. Anche l'immagine di copertina verrà sostituita!
be_pp_sapierr=Errore durante il tentativo di comunicare con l'API di openLibrary!
be_pp_sr1=Vuoi davvero eliminare questo elemento libro?
be_pp_sr2=Questo libro è tornato disponibile ed è stato restituito?
be_pp_sr3=Errore durante il tentativo di comunicare con l'API di openLibrary!

## Permissions
be_tperm_page_deadlines=Gestisci Scadenze
be_dperm_page_deadlines=Può noleggiare libri agli utenti e gestire le scadenze.
be_tperm_page_books=Gestisci Libri
be_dperm_page_books=Accesso alla Pagina per Libri e relative funzioni, può creare, modificare ed eliminare libri.
be_tperm_page_tag=Gestisci Tag
be_dperm_page_tag=Accesso alla Pagina per Tag dei Libri e relative funzioni, può creare, modificare ed eliminare tag.
be_tperm_page_user=Gestisci Utenti
be_dperm_page_user=Accesso alla Pagina per Utenti e relative funzioni, può creare utenti e visualizzare/gestire tutti gli utenti.
be_tperm_page_blacklist=Gestisci Lista Nera
be_dperm_page_blacklist=Accesso alla Pagina per Lista Nera IP e relative funzioni.
be_tperm_page_logging=Gestisci Registrazione
be_dperm_page_logging=Accesso alla Pagina per Registrazione e relative funzioni.
be_tperm_page_settings=Gestisci Impostazioni
be_dperm_page_settings=Accesso alla Pagina per Impostazioni e relative funzioni.

## Events 
be_list_exec_idel=L'elemento è stato eliminato!
be_list_exec_iedit=L'elemento è stato modificato!
be_usr_ad_herem=Devi inserire i dati necessari!
be_usr_ad_hmailex=Esiste già un altro utente con quella email! Scegli un'altra email per questo utente.
be_usr_ad_hmaok=L'utente è stato creato!
be_str_item_created=L'elemento è stato creato


############################################################################################################################################1

## List Headers 
be_list_h_date=Data
be_list_h_id=ID
be_list_h_ttype=Tipo
be_list_h_ref=Riferimento
be_list_h_detail=Dettagli
be_list_h_ar=Arrivi
be_list_h_url=URL
be_list_h_site=Sito
be_list_h_err=Errore
be_list_h_rece=Destinatario
be_list_h_content=Contenuto
be_list_h_time=Ora
be_list_h_ip=IP
be_list_h_fails=Fallimenti
be_list_h_delete=Elimina
be_user_area_adr=Indirizzo
be_user_area_mail=E-Mail
be_usr_ad_hmail=Mail

## Navigation
be_deadlines=Scadenze
be_profile=Profilo
be_logout=Esci
be_tag=Tag
be_books=Libri
be_privacy=Privacy
be_impressum=Note legali
be_settings=Impostazioni
be_blacklist=Lista nera
be_logging=Registrazione
be_user=Utenti
be_myprofile=Il mio profilo
be_login=Accedi

## Tag Area
be_tag_raw=Tag
be_tag_rawn=Nome del tag
be_tag_add=Aggiungi tag
be_tag_edit=Modifica tag
be_tag_chdele=Vuoi davvero eliminare questo tag?
be_tag_exp=Qui puoi gestire i tag, i tag possono essere assegnati ai libri.

## Blacklist Area
be_exp_blacklist=Qui puoi vedere gli IP bloccati. Questi IP non potranno accedere a questo sito web o eseguire operazioni autenticate.

## Logging Area
be_exp_logging=Qui puoi vedere un protocollo delle attività in questo sistema.

############################################################################################################################################2

## Book Area
be_book_add=Aggiungi libro
be_booked_isbn=ISBN
be_booked_title=Titolo
be_booked_autor=Autore
be_booked_descr=Descrizione
be_booked_lang=Lingua
be_booked_released=Data di pubblicazione
be_booked_type=Tipo
be_booked_pub=Editore
be_vb_header_log=Registro
be_vb_header_rentc=Quantità
be_vb_header_ima=Copertina
be_vb_header_det=Dettagli

## Deadline Area
be_deadline_raw=Scadenze
be_deadline_exp=Qui puoi vedere le scadenze aperte e le date di restituzione dei libri.
be_table_header_book=Libro
be_table_header_barcode=Codice a barre
be_table_header_duedate=Data di scadenza

# Profile Area
b_prof_pwinfo=Qui puoi cambiare la password per accedere.
b_prof_mailinfo=Qui puoi cambiare l'E-Mail per accedere.

## User Area
be_password_filter_setup=La password deve soddisfare i seguenti criteri:<br />- Almeno 10 caratteri<br />- Almeno 1 lettera maiuscola<br />- Almeno 1 lettera minuscola<br />- Almeno un numero


############################################################################################################################################3

be_yes=Sì
be_no=No
b_in_time=In tempo
b_overdue=Tempo superato
b_today_return=Restituire oggi
b_view=Visualizza
be_table_header_returndate=Data di restituzione
b_active=Attivo
b_inactive=Inattivo
b_edit=Modifica
b_action=Azione
b_delete=Elimina
be_close=Chiudi
be_cancel=Annulla
b_description=Descrizione
be_list=Elenco
be_none=Nessuno
be_help=Aiuto
be_explanation=Spiegazione
b_nosslval=Nessuna validazione SSL
b_sslval=Validazione SSL forzata
b_low=Basso
b_medium=Medio
b_high=Alto
b_apirequest=Sincronizza con API
b_barcode=Codice a barre
b_add=Aggiungi
b_nolistcurrent=Al momento non ci sono elementi in questo elenco!
b_backtolist=Torna all'elenco
b_hide=Nascondi
b_unhide=Mostra
be_profile=Profilo
b_creation=Creazione
b_lastmodification=Ultima modifica
b_firstname=Nome
b_lastname=Cognome
b_street=Via
b_postcode=Codice postale
b_country=Paese
b_changeimage=Cambia immagine
b_password=Password
b_change_password=Cambia password
b_email=E-Mail
b_change_email=Cambia E-Mail
b_status=Stato
b_id=ID
b_tags=Tag
b_thisitemcurhiddenlist=Questo elemento è attualmente nascosto nell'elenco pubblico!
b_nobooktitlelist=Titolo sconosciuto
b_hidden=Nascosto
b_lend=Presta
b_return=Restituisci
b_hardback=Copertina rigida
b_paperback=Brossura
b_softcover=Copertina morbida
b_bookcurrentlyrented=Questo libro è attualmente prenotato da un altro utente e sarà disponibile a breve!
b_available=Disponibile
b_reserved=Prenotato
b_user=Utente
b_until=Fino a
b_returndate=Data di restituzione
b_note=Nota
b_lendtouser=Presta all'utente
b_changefavicon=Cambia favicon
b_settings_exp_string=In questa pagina puoi controllare le funzionalità del sito web.
b_tel=Telefono
be_pp_sr1ssd=Il libro è stato restituito?
be_error_booknoexists=Il libro che hai cercato di visualizzare non esiste!
be_error_usernoexists=L'utente che hai cercato di visualizzare non esiste!
be_puser_chdele3=Abilita utente
b_prof_pwinfoadd=Come amministratore puoi modificare le e-mail degli utenti senza attivazione


############################################################################################################################################4

be_about_core_info=Versione CMS
be_about_fw_info=Versione Framework
be_about_site_info=Versione Modulo
be_set_header_general=Impostazioni Generali
be_set_header_mail=Impostazioni E-Mail
be_set_header_trans=Impostazioni di Traduzione
be_set_header_about=Informazioni di Sistema
be_string_key=Chiave
be_string_language=Lingua
be_string_translation=Traduzione
be_trans_current_active=Traduzioni Predefinite
be_trans_current_ovr=Sostituzioni di Traduzione
be_trans_button_create=Crea Traduzione
be_trans_button_edit=Modifica Traduzione
be_trans_dlrly=Vuoi davvero eliminare questa traduzione?
be_eexps_hivetitle=Titolo di questo sito web.
be_eexps_imp=Il tuo testo dell'Impronta
be_eexps_pry=Il tuo testo sulla Privacy
be_eexps_expiretoken=Il token E-Mail scade dopo un numero specifico di minuti.
be_eexps_expireip=Limite di tentativi falliti IP prima del Blacklisting.
be_eexps_expirecsrf=Tempo in secondi di validità delle chiavi CSRF prima della scadenza.
be_eexps_expireact=Tempo in minuti che gli utenti devono attendere tra le richieste di recupero/modifica mail.
be_eexps_upgc=Proteggi l'aggiornamento in loco con un codice di accesso.
be_eexps_actmc=Consenti agli utenti di modificare la propria E-Mail.
be_eexps_actrec=Consenti agli utenti di recuperare la propria password.
be_eexps_actreg=Consenti agli ospiti di registrarsi su questo sito web.
be_eexps_actdeflang=Lingua predefinita per gli ospiti se non hanno impostato una propria lingua.
be_eexps_trapage=In questa sezione puoi vedere le traduzioni predefinite e sovrascriverle se utile.
be_eexpm_user=Nome utente per il server E-Mail
be_eexpm_pass=Password per il server E-Mail
be_eexpm_host=Hostname SMTP
be_eexpm_port=Porta SMTP
be_eexpm_auth=Metodo di autenticazione SMTP
be_eexpm_sm=Mail del mittente per le mail in uscita
be_eexpm_sn=Nome del mittente per le mail in uscita
be_eexpm_mh=Intestazione mail predefinita
be_eexpm_debug=Se si verificano problemi durante l'invio della mail, puoi attivare il debug qui - in questo caso, ad ogni operazione di invio verranno mostrate informazioni di debug sullo schermo - anche se l'invio ha avuto successo.
be_eexpm_ins=Consenti connessioni SMTP non sicure
be_eexpm_mf=Piè di pagina mail predefinito
obr_inp_title=Titolo
obr_inp_autor=Autore
obr_inp_publisher=Editore
obr_inp_isbn=ISBN
obr_inp_lang=Lingua
obr_inp_tags=Tag
be_obr_li_id=ID Libro
be_obr_li_book_title=Titolo
be_obr_li_book_autor=Autore
be_obr_li_book_type=Tipo di Libro
be_obr_li_book_publisher=Editore
be_obr_li_book_isbn=ISBN
be_obr_li_book_lang=Lingua
be_obr_li_book_tag_array=Categorie Collegate
be_obr_li_book_creation=Data di Creazione
be_obr_li_book_modification=Data di Modifica
be_obr_update_book=Recupera Dati Libro per ISBN
be_obr_delete_book=Elimina Libro
be_obr_add_stock=Articoli Noleggiabili
obr_book_item_list=Lista Articoli Noleggiabili
be_op_usr_622=L'utente è stato modificato


############################################################################################################################################5

string_add=Aggiungi
be_exp_usrlst=Qui puoi gestire e creare utenti.
be_user_area_usrname=Nome
be_opok=Stai visualizzando questa pagina perché hai richiesto un'attivazione.<br/>Controlla il riquadro degli eventi nell'angolo in alto a destra per i dettagli.
be_operr=Errore
be_str_item_createderr=Impossibile creare il token API, questo accade solitamente se il token esiste già per il modulo del sito correlato!
be_mail_template_edit=Modifica Template Email
be_mail_exp_recover=Template email per il recupero degli utenti registrati. Questo template viene inviato quando gli utenti richiedono una nuova password tramite la funzione 'password dimenticata'. Viene impostata una sostituzione per fornire all'utente un link. Con la facile sostituzione _ACTION_URL_.
be_mail_exp_mchange=Template email per le modifiche alle email degli utenti registrati. Questo template viene inviato quando l'utente cambia la sua email principale o quando viene modificata in generale. Viene impostata una sostituzione per fornire all'utente un link per attivare e confermare la nuova email. Con la facile sostituzione _ACTION_URL_ per l'URL di attivazione.
be_mail_exp_acti=Template email per l'attivazione degli utenti registrati. Questo template viene inviato quando vengono creati utenti o dipendenti aziendali. Viene impostata una sostituzione per fornire all'utente un link. Con la facile sostituzione _ACTION_URL_ per attivare il nuovo account. L'utente può anche recuperare la password per attivare l'account.
be_se_key_mch=Chiave di Attivazione Email
b_permission=Permessi
be_user_area_name=Gestione Utenti
be_user_area_create=Aggiungi Utente
be_usr_ad_errgm=L'utente è stato creato, ma si è verificato un errore durante l'invio dell'email di attivazione!
be_noti_user_crea=Si prega di notare che se un utente non ha confermato il suo account e un altro utente tenta di registrarsi con la stessa email, l'utente iniziale non confermato potrebbe essere eliminato. Ciò può portare alla perdita di dati. Quindi assicurati di lavorare sempre con utenti confermati se non vuoi che il sistema li elimini. Non utilizzare mai funzionalità per annullare la conferma degli utenti, poiché anche questo può portare alla perdita di dati.
be_usr_ad_errg=Errore durante il tentativo di creare l'utente.
be_usr_ad_hpasserem=La password scelta non soddisfa le raccomandazioni!
be_usr_ad_hpass=Password
be_usr_ad_h=Procedura di Attivazione
be_usr_ad_rec=Richiedi attivazione via email e l'utente imposta la propria password
be_usr_ad_act=Richiedi solo attivazione via Email
be_usr_ad_ok=Attiva questo utente senza alcuna procedura di attivazione
be_puser_noview=Questo utente non esiste!
be_puser_cpass=Cambia Password
be_puser_cpass1=Conferma Password
be_puser_cpass2=Nuova Password
be_puser_cper=Cambia Permessi
be_puser_chmm=Cambia Email Utente
be_puser_chmm1=Nuova Email
be_puser_chdele=Elimina Utente
be_puser_chdele1=Operazioni Utente
be_puser_chdele7=Questo utente non è attualmente confermato via email!
be_puser_chdele8=Questo utente è attualmente bloccato!
be_puser_chdele9=Questo utente è attualmente disabilitato!
be_puser_chdele10=Questo è l'account super-admin iniziale! Ha sempre pieno accesso a questo pannello di amministrazione!
be_puser_chdele11=Questo profilo appartiene a un altro utente! Fai attenzione quando modifichi le impostazioni, poiché le modifiche avranno un impatto sull'esperienza dell'utente!
be_puser_chdele12=In attesa di attivazione della nuova email per:
be_puser_chdele13=Clicca qui per interrompere l'operazione.
be_puser_chdele14=L'email non può essere vuota!
be_puser_chdele15=Errore Sconosciuto
be_puser_chdele16=La funzionalità per cambiare l'email è attualmente disabilitata per questo utente!
be_puser_chdele17=Non è consentito modificare l'email di questo utente.
be_puser_chdele18=Esiste già un utente attivo con quella email! Non sono possibili email duplicate per gli utenti.
be_puser_chdele19=Devi attendere un periodo di tempo specifico tra le richieste di cambio email: 
be_puser_chdele20=minuti
be_puser_chdele21=Controlla la casella di posta della tua nuova email per attivare la nuova email!
be_puser_chdele22=Si è verificato un errore durante l'invio dell'email di attivazione!
be_puser_chdele23=La richiesta di cambio email è stata annullata!
be_op_usr_1=La password deve contenere un numero, una lettera minuscola e una maiuscola! Deve avere almeno 10 caratteri.
be_op_usr_2=Le password non possono essere vuote!
be_op_usr_3=Le password non corrispondono!
be_op_usr_4=La password è stata modificata!
be_op_usr_6=I permessi dell'utente sono stati modificati!
be_op_usr_11=L'utente è stato confermato e ora può accedere!
be_op_usr_12=L'utente è stato eliminato!
be_book_area_create=Crea Libro

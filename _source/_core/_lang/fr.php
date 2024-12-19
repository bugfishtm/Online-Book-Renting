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
string_password=Mot de passe
string_login=Connexion
string_register=Inscription
string_close=Fermer
string_error=Erreur

# Page - Actions
hive_login_changelanguage=Vous pouvez changer la langue
hive_login_changelanguage_here=ici.
hive_login_lostpass=Mot de passe oublié ?
hive_login_notregistered=Pas encore inscrit ?
hive_login_rememberme=Utiliser les cookies ?
hive_login_recoveraccount=Récupérer le compte
hive_login_haveaccount=Déjà un compte ?
hive_login_password_confirm=Confirmer le mot de passe
hive_login_mc_change_mail=Changer d'E-Mail
hive_login_mc_backtohome=Retour à l'accueil
hive_login_title_accactivation=Activation du compte
hive_cannotenterwhilenologin=Vous ne pouvez pas accéder à cette page si vous n'êtes pas connecté !
hive_cannotenterwhilelogin=Vous ne pouvez pas accéder à cette page si vous êtes connecté !
hive_cannotoperatesiteerror=Il y a une erreur critique sur ce module du site, vous ne pouvez actuellement effectuer aucune opération !
hive_login_backtologin=Retour à la connexion
hive_login_change_Lang=Changer la langue
hive_login_language_changed=La langue a été changée !

# Login Events - General
hive_login_msg_l_wrong=Combinaison E-Mail/Mot de passe incorrecte.
hive_login_msg_csrf=Formulaire expiré, veuillez réessayer.
hive_login_msg_empty=Veuillez entrer les données requises !
hive_login_msg_ipban=Votre IP est actuellement bloquée ; veuillez réessayer plus tard.
hive_login_msg_logout=Vous avez été déconnecté !
hive_login_msg_nomatchpass=La confirmation du mot de passe ne correspond pas au mot de passe entré.
hive_login_doremember=Voulez-vous vous souvenir de votre mot de passe ?

# Login Events - Login
hive_login_msg_l_ok=Connexion réussie.
hive_login_msg_l_blocked=Vous ne pouvez pas vous connecter car votre compte est bloqué.
hive_login_msg_l_inactive=Votre compte utilisateur n'est pas encore activé ! Récupérez votre mot de passe pour activer votre compte ou cliquez sur le lien dans l'E-Mail d'activation que vous avez reçu !
hive_login_msg_l_blockedpwf=Vous avez entré trop de fois un mauvais mot de passe, et votre compte a été bloqué !
hive_login_msg_l_disabled=Votre compte utilisateur a été désactivé !
hive_login_mail_serror=Erreur lors de l'envoi de l'E-Mail. C'est une erreur interne qui doit être signalée à l'équipe de notre site.
hive_login_msg_register_ok=Veuillez vérifier votre boîte E-Mail pour activer votre nouveau compte !
hive_login_msg_passfiltererror=Le mot de passe entré ne respecte pas les règles de mot de passe !
hive_login_msg_mailexist=Vous essayez d'enregistrer un compte avec un E-Mail qui existe déjà !
hive_login_password_rules=Règles de mot de passe
hive_login_password_sign=Caractères requis :
hive_login_password_cap=Lettres majuscules requises :
hive_login_password_small=Lettres minuscules requises :
hive_login_password_special=Caractères spéciaux requis :
hive_login_password_numeric=Caractères numériques requis :

# Login Events - Mail Change
hive_login_msg_m_ok=Vous avez activé votre nouvelle adresse E-Mail avec succès !
hive_login_msg_m_er=Erreur lors de l'activation de la nouvelle adresse E-Mail ; veuillez réessayer.
hive_login_msg_m_exp=Le code d'activation de l'E-Mail a expiré ! Veuillez réessayer de changer votre E-Mail !
hive_login_msg_m_res=L'E-Mail que vous avez essayé d'activer est maintenant utilisé sur un autre compte, il ne peut donc pas être associé à votre compte !
hive_login_msg_m_block=Votre compte est bloqué pour les changements d'E-Mail !
hive_login_msg_m_noadr=La demande a échoué. Veuillez réessayer plus tard.
hive_login_mc_cmailtext=Votre E-Mail actuel est :
hive_login_msg_rec_ok=Veuillez vérifier la boîte de réception de votre nouvel E-Mail pour activer la nouvelle adresse E-Mail.
hive_login_msg_rec_err=Erreur lors de la tentative de changement d'adresse E-Mail.
hive_login_msg_rec_wait=Vous devez attendre 120 minutes entre les changements d'adresse E-Mail !
hive_login_msg_rec_exist=L'adresse E-Mail que vous essayez de changer est déjà utilisée par un autre compte utilisateur !
hive_login_msg_rec_block=Votre compte est bloqué pour les changements d'adresse E-Mail !
hive_login_msg_rec_disable=Vous ne pouvez pas changer l'adresse E-Mail d'un compte désactivé !

# Login Mails
hive_login_mail_pre_change=Activez votre nouvelle adresse mail ici : <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_change=Activez votre nouvelle adresse E-Mail
hive_login_mail_title_register=Activez votre nouveau compte
hive_login_mail_pre_register=Cliquez sur le lien suivant pour activer votre compte : <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_rec=Récupérez votre compte
hive_login_mail_pre_rec=Cliquez sur le lien suivant pour récupérer le mot de passe de votre compte : <a href="SF_ACTION_URL">SF_ACTION_URL</a>

# Login - Activation
hive_login_msg_a_ok=Vous avez activé votre compte avec succès ! Vous pouvez maintenant vous connecter sur nos pages de connexion sur ce site.
hive_login_msg_a_er=Erreur lors de la tentative d'activation du compte utilisateur. Veuillez essayer de récupérer votre mot de passe ou enregistrer un nouveau compte.
hive_login_msg_a_exp=Le jeton d'activation est invalide. Veuillez récupérer votre compte sur la page de connexion pour activer votre compte !
hive_login_msg_a_block=L'activation de votre compte a été désactivée ; veuillez réessayer plus tard !

# Login - Recover Request
hive_login_msg_rr_recnewunk=L'E-Mail fourni n'est pas enregistré.
hive_login_msg_rr_recnope=Votre compte n'a pas la permission de récupérer le mot de passe !
hive_login_msg_rr_recnopede=Votre compte a été désactivé et ne peut pas effectuer de nouvelles demandes !
hive_login_msg_rr_recwait=Vous devez attendre 120 minutes avant de commencer une nouvelle demande de récupération !
hive_login_msg_rr_recnok=Veuillez vérifier votre boîte de réception pour un E-Mail de réinitialisation de mot de passe. Cet E-Mail contient un lien pour récupérer votre mot de passe.
hive_login_msg_recfr_ok=Veuillez vérifier votre boîte E-Mail pour obtenir un lien de récupération de mot de passe !

# Login - Recover Execute
hive_login_msg_pwtexpire=Ce jeton de récupération de mot de passe a expiré ! Veuillez réessayer de récupérer votre compte.
hive_login_msg_recexecerror=Erreur lors de la tentative de récupération de votre mot de passe. Veuillez réessayer de récupérer votre compte.
hive_login_msg_recexecok=Vous avez récupéré votre mot de passe avec succès et pouvez maintenant vous connecter avec votre nouveau mot de passe.
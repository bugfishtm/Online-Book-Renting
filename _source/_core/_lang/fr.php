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

##########################################################################################
## Setupable Constant Explanations
##########################################################################################

hive_var_exp_1=Thème: Couleur par défaut pour les couleurs dynamiques du thème
hive_var_exp_2=Thème: Tableau sérialisé avec des thèmes valides
hive_var_exp_3=Thème: Thème utilisé par défaut
hive_var_exp_4=Langue: Tableau sérialisé avec des langues valides
hive_var_exp_5=Langue: Tableau avec la langue par défaut
hive_var_exp_6=Actions: Formulaire d'inscription général activé ? (1=activé/0=désactivé)
hive_var_exp_7=Aucune explication pour le moment.
hive_var_exp_8=Actions: Formulaire de récupération général activé ? (1=activé/0=désactivé)
hive_var_exp_9=Actions: Formulaire d'activation général activé ? (1=activé/0=désactivé)
hive_var_exp_10=Formulaire de connexion général activé ? (1=activé/0=désactivé)
hive_var_exp_11=TinyMCE: Configuration des plugins
hive_var_exp_12=TinyMCE: Configuration de la barre de menu
hive_var_exp_13=TinyMCE: Configuration de la barre d'outils
hive_var_exp_14=Configuration utilisateur: Nombre maximum de jours de validité des sessions/cookies
hive_var_exp_15=Configuration utilisateur: Temps en minutes de validité des jetons des mails d'activation
hive_var_exp_16=Configuration utilisateur: Bloquer les utilisateurs après X échecs de connexion (0 pour désactiver)
hive_var_exp_17=Configuration utilisateur: Temps en minutes d'attente entre les requêtes pour l'utilisateur (anti-flood)
hive_var_exp_18=Configuration utilisateur: Journaliser les anciennes sessions ? (Connexions, récupérations, activations, changements d'email) (1=activé/0=désactivé)
hive_var_exp_19=Configuration utilisateur: Journaliser les adresses IP des utilisateurs dans la base de données (1=activé/0=désactivé)
hive_var_exp_20=Configuration utilisateur: 1 - Supprimer les clés de récupération après une connexion réussie | 0 - Conserver les clés
hive_var_exp_21=Configuration utilisateur: 1 - Autoriser les connexions multiples | 0 - Désactiver les connexions multiples
hive_var_exp_22=Filtre de mot de passe: Nombre minimum de caractères
hive_var_exp_23=Filtre de mot de passe: Nombre minimum de majuscules
hive_var_exp_24=Filtre de mot de passe: Nombre minimum de minuscules
hive_var_exp_25=Filtre de mot de passe: Nombre minimum de caractères spéciaux
hive_var_exp_26=Filtre de mot de passe: Nombre minimum de chiffres
hive_var_exp_27=Nom d'utilisateur initial créé
hive_var_exp_28=Mot de passe utilisateur initial créé
hive_var_exp_29=Captcha: Hauteur de l'image
hive_var_exp_30=Captcha: Largeur de l'image
hive_var_exp_31=Captcha: Couleurs pour le captcha (facultatif, peut être 0)
hive_var_exp_32=Captcha: Police (si 0, la police par défaut sera utilisée)
hive_var_exp_33=Redis: Activé ? (1/0)
hive_var_exp_34=Redis: Hôte
hive_var_exp_35=Redis: Port
hive_var_exp_36=Mise à jour: Titre pour le mise à jour sur ce site
hive_var_exp_37=Mise à jour: Code requis pour la mise à jour ? (peut être 0 pour désactiver)
hive_var_exp_38=Paramètres: Journaliser les requêtes de la classe CURL ? (1/0)
hive_var_exp_39=Paramètres: Bloquer les IP après X échecs (peut être 0 pour désactiver)
hive_var_exp_40=Paramètres: Journaliser les référents ? (1/0)
hive_var_exp_41=Paramètres: Temps de validité par défaut du code CSRF en secondes
hive_var_exp_42=Paramètres: 1 - Exécution de Cronjob uniquement en ligne de commande | 0 - Autoriser l'exécution de Cronjob dans le navigateur
hive_var_exp_43=Paramètres: Activer le journal des erreurs de débogage Javascript (1/0)
hive_var_exp_44=Paramètres: Titre du site Web pour les onglets et plus
hive_var_exp_45=Paramètres: Espaceur de titre pour les onglets dans le navigateur
hive_var_exp_46=Paramètres: Afficher les erreurs PHP sur le site Web ? (1/0)
hive_var_exp_47=Paramètres: Tableau sérialisé avec les modules PHP nécessaires, si inexistants, une erreur s'affiche (exemple : array("mysqli", "mbstring", "gd"))
hive_var_exp_48=Paramètres: Arrêter et afficher les erreurs MySQL sur la page en cas de problème ? (Seront toujours journalisées dans la table x_log_mysql) (1/0)
hive_var_exp_49=Paramètres: 1 - Utiliser des URLs SEO | 0 - Ne pas utiliser d'URLs SEO
hive_var_exp_50=Paramètres: Nécessaire uniquement si _HIVE_URL_SEO_ == false [Nom pour les variables de localisation GET dans un tableau sérialisé]
hive_var_exp_51=Configuration de mail: Mot de passe SMTP
hive_var_exp_52=Configuration de mail: Nom d'utilisateur SMTP
hive_var_exp_53=Configuration de mail: Authentification SMTP (ssl/tls/false)
hive_var_exp_54=Configuration de mail: Port SMTP
hive_var_exp_55=Configuration de mail: Hôte SMTP
hive_var_exp_56=Configuration de mail: Mode de débogage de mail (0, 1, 2, 3) - Utilisez 0 pour la production car cela affichera le débogage sur le site !
hive_var_exp_57=Configuration de mail: Autoriser les connexions SSL non sécurisées ? (1/0)
hive_var_exp_58=Configuration de mail: Tous les mails envoyés en HTML ? (1/0)
hive_var_exp_59=Configuration de mail: Nom de l'expéditeur par défaut
hive_var_exp_60=Configuration de mail: Adresse mail de l'expéditeur par défaut
hive_var_exp_61=Configuration de mail: Pied de page par défaut pour les mails
hive_var_exp_62=Configuration de mail: En-tête par défaut pour les mails

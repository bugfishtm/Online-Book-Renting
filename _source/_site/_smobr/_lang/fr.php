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
be_404_2=Erreur 404
be_404_1=Le contenu demandé n'existe pas !
be_401_2=Accès refusé
be_401_1=Vous n'avez pas accès à cette zone !
b_permissions=Autorisations

## Popups
be_edit_abort=Cliquez ici pour annuler l'opération !
be_list_h_exec_flush=Tous les éléments de ce tableau ont été supprimés !
be_list_h_btn_flush_rly=Voulez-vous vraiment vider ce tableau ? Cela réinitialisera la table de base de données associée et supprimera toutes les anciennes entrées !
be_list_h_btn_flush=Vider le tableau
be_cbanner_1=Ce site web utilise des cookies de session !
be_cbanner_2=J'accepte
be_pp_hide=Voulez-vous vraiment masquer cet élément dans la liste publique des livres ?
be_pp_unhide=Voulez-vous vraiment afficher cet élément dans la liste publique des livres ?
be_pp_delbook=Voulez-vous vraiment supprimer ce livre ? Cela supprimera toutes les informations associées et le journal correspondant.
be_pp_errimage=Veuillez sélectionner un fichier jpg valide !
be_pp_errimage1=Aucun fichier téléchargé ou une erreur s'est produite lors du téléchargement.
be_pp_errimage2=Erreur lors du déplacement du fichier téléchargé.
be_pp_errimage3=Type de fichier invalide. Seuls les fichiers JPG sont autorisés.
be_pp_sapi=Cela écrasera les informations actuelles du livre avec les informations récupérées d'openLibrary. L'image de couverture sera également remplacée !
be_pp_sapierr=Erreur lors de la communication avec l'API openLibrary !
be_pp_sr1=Voulez-vous vraiment supprimer cet élément de livre ?
be_pp_sr2=Ce livre est-il de retour en stock et a-t-il été rendu ?
be_pp_sr3=Erreur lors de la communication avec l'API openLibrary !

## Permissions
be_tperm_page_deadlines=Gérer les échéances
be_dperm_page_deadlines=Peut prêter des livres aux utilisateurs et gérer les échéances.
be_tperm_page_books=Gérer les livres
be_dperm_page_books=Accès à la page des livres et à ses fonctions, peut créer, modifier et supprimer des livres.
be_tperm_page_tag=Gérer les étiquettes
be_dperm_page_tag=Accès à la page des étiquettes de livres et à ses fonctions, peut créer, modifier et supprimer des étiquettes.
be_tperm_page_user=Gérer les utilisateurs
be_dperm_page_user=Accès à la page des utilisateurs et à ses fonctions, peut créer des utilisateurs et voir/gérer tous les utilisateurs.
be_tperm_page_blacklist=Gérer la liste noire
be_dperm_page_blacklist=Accès à la page de la liste noire IP et à ses fonctions.
be_tperm_page_logging=Gérer la journalisation
be_dperm_page_logging=Accès à la page de journalisation et à ses fonctions.
be_tperm_page_settings=Gérer les paramètres
be_dperm_page_settings=Accès à la page des paramètres et à ses fonctions.

## Events 
be_list_exec_idel=L'élément a été supprimé !
be_list_exec_iedit=L'élément a été modifié !
be_usr_ad_herem=Vous devez remplir les données nécessaires !
be_usr_ad_hmailex=Un autre utilisateur avec cette adresse e-mail existe déjà ! Veuillez choisir une autre adresse e-mail pour cet utilisateur.
be_usr_ad_hmaok=L'utilisateur a été créé !
be_str_item_created=L'élément a été créé


############################################################################################################################################1

## List Headers 
be_list_h_date=Date
be_list_h_id=ID
be_list_h_ttype=Type
be_list_h_ref=Référence
be_list_h_detail=Détails
be_list_h_ar=Arrivées
be_list_h_url=URL
be_list_h_site=Site
be_list_h_err=Erreur
be_list_h_rece=Destinataire
be_list_h_content=Contenu
be_list_h_time=Heure
be_list_h_ip=IP
be_list_h_fails=Échecs
be_list_h_delete=Supprimer
be_user_area_adr=Adresse
be_user_area_mail=E-mail
be_usr_ad_hmail=Mail

## Navigation
be_deadlines=Échéances
be_profile=Profil
be_logout=Déconnexion
be_tag=Étiquettes
be_books=Livres
be_privacy=Confidentialité
be_impressum=Mentions légales
be_settings=Paramètres
be_blacklist=Liste noire
be_logging=Journalisation
be_user=Utilisateurs
be_myprofile=Mon profil
be_login=Connexion

## Tag Area
be_tag_raw=Étiquettes
be_tag_rawn=Nom de l'étiquette
be_tag_add=Ajouter une étiquette
be_tag_edit=Modifier l'étiquette
be_tag_chdele=Voulez-vous vraiment supprimer cette étiquette ?
be_tag_exp=Ici, vous pouvez gérer les étiquettes, les étiquettes peuvent être attribuées aux livres.

## Blacklist Area
be_exp_blacklist=Les adresses IP bloquées peuvent être vues ici. Ces adresses IP ne pourront pas se connecter à ce site web ni effectuer des opérations authentifiées.

## Logging Area
be_exp_logging=Ici, vous pouvez voir un protocole des activités dans ce système.

############################################################################################################################################2

## Book Area
be_book_add=Ajouter un livre
be_booked_isbn=ISBN
be_booked_title=Titre
be_booked_autor=Auteur
be_booked_descr=Description
be_booked_lang=Langue
be_booked_released=Date de sortie
be_booked_type=Type
be_booked_pub=Éditeur
be_vb_header_log=Journal
be_vb_header_rentc=Quantité
be_vb_header_ima=Couverture
be_vb_header_det=Détails

## Deadline Area
be_deadline_raw=Échéances
be_deadline_exp=Ici, vous pouvez voir les échéances ouvertes et les dates de retour des livres.
be_table_header_book=Livre
be_table_header_barcode=Code-barres
be_table_header_duedate=Date d'échéance

# Profile Area
b_prof_pwinfo=Ici, vous pouvez changer le mot de passe pour vous connecter.
b_prof_mailinfo=Ici, vous pouvez changer l'adresse e-mail pour vous connecter.

## User Area
be_password_filter_setup=Le mot de passe doit répondre aux critères suivants :<br />- Au moins 10 caractères<br />- Au moins 1 lettre majuscule<br />- Au moins 1 lettre minuscule<br />- Au moins un chiffre


############################################################################################################################################3
be_yes=Oui
be_no=Non
b_in_time=À temps
b_overdue=Délai dépassé
b_today_return=Retour aujourd'hui
b_view=Voir
be_table_header_returndate=Date de retour
b_active=Actif
b_inactive=Inactif
b_edit=Modifier
b_action=Action
b_delete=Supprimer
be_close=Fermer
be_cancel=Annuler
b_description=Description
be_list=Liste
be_none=Aucun
be_help=Aide
be_explanation=Explication
b_nosslval=Pas de validation SSL
b_sslval=Validation SSL forcée
b_low=Bas
b_medium=Moyen
b_high=Élevé
b_apirequest=Synchroniser avec l'API
b_barcode=Code-barres
b_add=Ajouter
b_nolistcurrent=Il n'y a actuellement aucun élément dans cette liste !
b_backtolist=Retour à la liste
b_hide=Masquer
b_unhide=Afficher
be_profile=Profil
b_creation=Création
b_lastmodification=Dernière modification
b_firstname=Prénom
b_lastname=Nom
b_street=Rue
b_postcode=Code postal
b_country=Pays
b_changeimage=Changer l'image
b_password=Mot de passe
b_change_password=Changer le mot de passe
b_email=E-mail
b_change_email=Changer l'e-mail
b_status=Statut
b_id=ID
b_tags=Étiquettes
b_thisitemcurhiddenlist=Cet élément est actuellement masqué dans la liste publique !
b_nobooktitlelist=Titre inconnu
b_hidden=Masqué
b_lend=Prêter
b_return=Retourner
b_hardback=Couverture rigide
b_paperback=Livre de poche
b_softcover=Couverture souple
b_bookcurrentlyrented=Ce livre est actuellement réservé par un autre utilisateur et sera bientôt disponible !
b_available=Disponible
b_reserved=Réservé
b_user=Utilisateur
b_until=Jusqu'au
b_returndate=Date de retour
b_note=Note
b_lendtouser=Prêter à l'utilisateur
b_changefavicon=Changer le favicon
b_settings_exp_string=Sur cette page, vous pouvez contrôler les fonctionnalités du site web.
b_tel=Téléphone
be_pp_sr1ssd=Le livre a-t-il été retourné ?
be_error_booknoexists=Le livre que vous avez essayé de consulter n'existe pas !
be_error_usernoexists=L'utilisateur que vous avez essayé de consulter n'existe pas !
be_puser_chdele3=Activer l'utilisateur
b_prof_pwinfoadd=En tant qu'administrateur, vous pouvez modifier les e-mails des utilisateurs sans activation


############################################################################################################################################4

be_about_core_info=Version CMS
be_about_fw_info=Version du Framework
be_about_site_info=Version du Module
be_set_header_general=Paramètres Généraux
be_set_header_mail=Paramètres E-Mail
be_set_header_trans=Paramètres de Traduction
be_set_header_about=Informations Système
be_string_key=Clé
be_string_language=Langue
be_string_translation=Traduction
be_trans_current_active=Traductions par Défaut
be_trans_current_ovr=Remplacements de Traduction
be_trans_button_create=Créer une Traduction
be_trans_button_edit=Modifier la Traduction
be_trans_dlrly=Voulez-vous vraiment supprimer cette traduction ?
be_eexps_hivetitle=Titre de ce site web.
be_eexps_imp=Votre Texte de Mentions Légales
be_eexps_pry=Votre Texte de Confidentialité
be_eexps_expiretoken=Expiration du Jeton E-Mail après un nombre spécifique de minutes.
be_eexps_expireip=Limite d'échecs IP avant la mise sur liste noire.
be_eexps_expirecsrf=Temps en secondes pendant lequel les clés CSRF sont valides avant d'expirer.
be_eexps_expireact=Temps en minutes que les utilisateurs doivent attendre entre les demandes de récupération/changement d'e-mail.
be_eexps_upgc=Sécuriser le programme de mise à jour sur site avec un code d'accès.
be_eexps_actmc=Autoriser les utilisateurs à changer leur E-Mail.
be_eexps_actrec=Autoriser les utilisateurs à récupérer leur mot de passe.
be_eexps_actreg=Autoriser les invités à s'inscrire sur ce site web.
be_eexps_actdeflang=Langue par défaut pour les invités s'ils n'ont pas défini leur propre langue.
be_eexps_trapage=Dans cette section, vous pouvez voir les traductions par défaut et les remplacer si nécessaire.
be_eexpm_user=Nom d'utilisateur pour le Serveur E-Mail
be_eexpm_pass=Mot de passe pour le Serveur E-Mail
be_eexpm_host=Nom d'hôte SMTP
be_eexpm_port=Port SMTP
be_eexpm_auth=Méthode d'Authentification SMTP
be_eexpm_sm=E-Mail de l'Expéditeur pour les Mails Sortants
be_eexpm_sn=Nom de l'Expéditeur pour les Mails Sortants
be_eexpm_mh=En-tête de Mail par Défaut
be_eexpm_debug=En cas de problèmes lors de l'envoi de mail, vous pouvez activer le débogage ici - dans ce cas, des informations de débogage seront affichées à l'écran pour chaque opération d'envoi - même en cas de succès.
be_eexpm_ins=Autoriser les Connexions SMTP non sécurisées
be_eexpm_mf=Pied de Page de Mail par Défaut
obr_inp_title=Titre
obr_inp_autor=Auteur
obr_inp_publisher=Éditeur
obr_inp_isbn=ISBN
obr_inp_lang=Langue
obr_inp_tags=Étiquettes
be_obr_li_id=ID du Livre
be_obr_li_book_title=Titre
be_obr_li_book_autor=Auteur
be_obr_li_book_type=Type de Livre
be_obr_li_book_publisher=Éditeur
be_obr_li_book_isbn=ISBN
be_obr_li_book_lang=Langue
be_obr_li_book_tag_array=Catégories Liées
be_obr_li_book_creation=Date de Création
be_obr_li_book_modification=Date de Modification
be_obr_update_book=Récupérer les Données du Livre par ISBN
be_obr_delete_book=Supprimer le Livre
be_obr_add_stock=Articles Louables
obr_book_item_list=Liste des Articles Louables
be_op_usr_622=L'utilisateur a été modifié


############################################################################################################################################5

string_add=Ajouter
be_exp_usrlst=Ici, vous pouvez gérer et créer des utilisateurs.
be_user_area_usrname=Nom
be_opok=Vous voyez cette page car vous avez demandé une activation.<br/>Consultez la boîte d'événements en haut à droite pour plus de détails.
be_operr=Erreur
be_str_item_createderr=Le jeton API n'a pas pu être créé, c'est généralement le cas si ce jeton existe déjà pour le module de site associé !
be_mail_template_edit=Modifier le modèle de courriel
be_mail_exp_recover=Modèle de courriel pour la récupération des utilisateurs enregistrés. Ce modèle est envoyé lorsque les utilisateurs demandent un nouveau mot de passe via la fonction 'mot de passe oublié'. Une substitution est définie pour fournir à l'utilisateur un lien. Avec la substitution facile _ACTION_URL_.
be_mail_exp_mchange=Modèle de courriel pour les changements d'adresse électronique des utilisateurs enregistrés. Ce modèle est envoyé lorsque l'utilisateur change son adresse électronique principale ou lorsqu'elle est modifiée en général. Une substitution est définie pour fournir à l'utilisateur un lien pour activer et confirmer la nouvelle adresse. Avec la substitution facile _ACTION_URL_ pour l'URL d'activation.
be_mail_exp_acti=Modèle de courriel pour l'activation des utilisateurs enregistrés. Ce modèle est envoyé lors de la création d'utilisateurs ou d'employés d'entreprise. Une substitution est définie pour fournir à l'utilisateur un lien. Avec la substitution facile _ACTION_URL_ pour activer le nouveau compte. L'utilisateur peut également récupérer le mot de passe pour activer le compte.
be_se_key_mch=Clé d'activation par courriel
b_permission=Permissions
be_user_area_name=Gestion des utilisateurs
be_user_area_create=Ajouter un utilisateur
be_usr_ad_errgm=L'utilisateur a été créé, mais une erreur s'est produite lors de l'envoi du courriel d'activation !
be_noti_user_crea=Veuillez noter que si un utilisateur n'a pas confirmé son compte et qu'un autre utilisateur essaie de s'inscrire avec la même adresse électronique, l'utilisateur initial non confirmé peut être supprimé. Cela peut entraîner une perte de données. Assurez-vous donc de toujours travailler avec des utilisateurs confirmés si vous ne voulez pas que le système les supprime. N'utilisez jamais de fonctionnalités pour annuler la confirmation des utilisateurs, car cela peut également entraîner une perte de données.
be_usr_ad_errg=Erreur lors de la création de l'utilisateur.
be_usr_ad_hpasserem=Le mot de passe choisi ne correspond pas aux recommandations !
be_usr_ad_hpass=Mot de passe
be_usr_ad_h=Procédure d'activation
be_usr_ad_rec=Demander l'activation par courriel et l'utilisateur pour définir son propre mot de passe
be_usr_ad_act=Demander uniquement l'activation par courriel
be_usr_ad_ok=Activer cet utilisateur sans aucune procédure d'activation
be_puser_noview=Cet utilisateur n'existe pas !
be_puser_cpass=Changer le mot de passe
be_puser_cpass1=Confirmer le mot de passe
be_puser_cpass2=Nouveau mot de passe
be_puser_cper=Modifier les permissions
be_puser_chmm=Changer l'adresse électronique de l'utilisateur
be_puser_chmm1=Nouvelle adresse électronique
be_puser_chdele=Supprimer l'utilisateur
be_puser_chdele1=Opérations utilisateur
be_puser_chdele7=Cet utilisateur n'est actuellement pas confirmé par courriel !
be_puser_chdele8=Cet utilisateur est actuellement bloqué !
be_puser_chdele9=Cet utilisateur est actuellement désactivé !
be_puser_chdele10=C'est le compte super-administrateur initial ! Il a toujours un accès complet à ce panneau d'administration !
be_puser_chdele11=Ce profil appartient à un autre utilisateur que vous ! Soyez prudent lors de la modification des paramètres, car les changements auront un impact sur l'expérience de l'utilisateur !
be_puser_chdele12=En attente de l'activation de la nouvelle adresse électronique pour :
be_puser_chdele13=Cliquez ici pour annuler l'opération.
be_puser_chdele14=L'adresse électronique ne peut pas être vide !
be_puser_chdele15=Erreur inconnue
be_puser_chdele16=La fonctionnalité de changement d'adresse électronique est actuellement désactivée pour cet utilisateur !
be_puser_chdele17=Il n'est pas autorisé de changer l'adresse électronique de cet utilisateur.
be_puser_chdele18=Il existe déjà un utilisateur actif avec cette adresse électronique ! Les adresses électroniques en double pour les utilisateurs ne sont pas possibles.
be_puser_chdele19=Vous devez attendre un certain temps entre les demandes de changement d'adresse électronique : 
be_puser_chdele20=minutes
be_puser_chdele21=Veuillez vérifier la boîte de réception de votre nouvelle adresse électronique pour l'activer !
be_puser_chdele22=Une erreur s'est produite lors de l'envoi du courriel d'activation !
be_puser_chdele23=La demande de changement d'adresse électronique a été annulée !
be_op_usr_1=Le mot de passe doit contenir un chiffre, une lettre minuscule et une lettre majuscule ! Vous devez avoir au moins 10 caractères.
be_op_usr_2=Les mots de passe ne peuvent pas être vides !
be_op_usr_3=Les mots de passe ne correspondent pas !
be_op_usr_4=Le mot de passe a été changé !
be_op_usr_6=Les permissions de l'utilisateur ont été modifiées !
be_op_usr_11=L'utilisateur a été confirmé et peut maintenant se connecter !
be_op_usr_12=L'utilisateur a été supprimé !
be_book_area_create=Créer un livre

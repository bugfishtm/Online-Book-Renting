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
string_email=Correo Electrónico
string_password=Contraseña
string_login=Iniciar Sesión
string_register=Registrarse
string_close=Cerrar
string_error=Error

# Page - Actions
hive_login_changelanguage=Puedes cambiar el idioma
hive_login_changelanguage_here=aquí.
hive_login_lostpass=¿Has olvidado tu contraseña?
hive_login_notregistered=¿No estás registrado?
hive_login_rememberme=¿Usar cookies?
hive_login_recoveraccount=Recuperar Cuenta
hive_login_haveaccount=¿Ya tienes una cuenta?
hive_login_password_confirm=Confirmar Contraseña
hive_login_mc_change_mail=Cambiar Correo Electrónico
hive_login_mc_backtohome=Volver a la Página Principal
hive_login_title_accactivation=Activación de Cuenta
hive_cannotenterwhilenologin=¡No puedes acceder a esta página si no has iniciado sesión!
hive_cannotenterwhilelogin=¡No puedes acceder a esta página si ya has iniciado sesión!
hive_cannotoperatesiteerror=Hay un error crítico en este módulo del sitio, por lo que actualmente no puedes realizar ninguna operación.
hive_login_backtologin=Volver a Iniciar Sesión
hive_login_change_Lang=Cambiar Idioma
hive_login_language_changed=¡El idioma ha sido cambiado!

# Login Events - General
hive_login_msg_l_wrong=Combinación de contraseña/correo electrónico incorrecta.
hive_login_msg_csrf=El formulario ha expirado, por favor intenta de nuevo.
hive_login_msg_empty=¡Por favor, ingresa los datos requeridos!
hive_login_msg_ipban=Tu IP está bloqueada actualmente; por favor intenta de nuevo más tarde.
hive_login_msg_logout=¡Has cerrado sesión!
hive_login_msg_nomatchpass=La confirmación de contraseña no coincide con la contraseña ingresada.
hive_login_doremember=¿Quieres recordar tu contraseña?

# Login Events - Login
hive_login_msg_l_ok=Inicio de sesión exitoso.
hive_login_msg_l_blocked=No puedes iniciar sesión porque tu cuenta está bloqueada.
hive_login_msg_l_inactive=¡Tu cuenta de usuario aún no está activada! Recupera tu contraseña para activar tu cuenta o haz clic en la URL del correo electrónico de activación que recibiste.
hive_login_msg_l_blockedpwf=¡Has ingresado la contraseña incorrecta demasiadas veces, y tu cuenta ha sido bloqueada!
hive_login_msg_l_disabled=¡Tu cuenta de usuario ha sido deshabilitada!
hive_login_mail_serror=Error al intentar enviar el correo electrónico. Este es un error interno que necesita ser investigado y debe ser informado al personal de nuestro sitio web.
hive_login_msg_register_ok=¡Por favor, revisa tu bandeja de entrada para activar tu nueva cuenta!
hive_login_msg_passfiltererror=La contraseña ingresada no cumple con las reglas de contraseñas.
hive_login_msg_mailexist=Estás intentando registrar una cuenta con un correo electrónico que ya existe.
hive_login_password_rules=Reglas de Contraseñas
hive_login_password_sign=Caracteres Requeridos:
hive_login_password_cap=Letras Mayúsculas Requeridas:
hive_login_password_small=Letras Minúsculas Requeridas:
hive_login_password_special=Caracteres Especiales Requeridos:
hive_login_password_numeric=Números Requeridos:

# Login Events - Mail Change
hive_login_msg_m_ok=¡Has activado exitosamente tu nuevo correo electrónico!
hive_login_msg_m_er=Error al intentar activar la nueva dirección de correo electrónico; por favor intenta de nuevo.
hive_login_msg_m_exp=¡El código de activación del correo electrónico ha expirado! Por favor, intenta cambiar tu correo electrónico nuevamente.
hive_login_msg_m_res=El correo electrónico que intentaste activar ahora está en uso en otra cuenta, por lo que no puede asociarse con tu cuenta.
hive_login_msg_m_block=Tu cuenta está bloqueada para cambios de correo electrónico.
hive_login_msg_m_noadr=La solicitud ha fallado. Por favor, intenta de nuevo más tarde.
hive_login_mc_cmailtext=Tu correo electrónico actual es:
hive_login_msg_rec_ok=Por favor, revisa la bandeja de entrada del nuevo correo electrónico para activar la nueva dirección de correo electrónico.
hive_login_msg_rec_err=Error al intentar cambiar la dirección de correo electrónico.
hive_login_msg_rec_wait=Debes esperar 120 minutos entre cambios de correo electrónico.
hive_login_msg_rec_exist=El correo electrónico que intentas cambiar ya está en uso por otra cuenta de usuario.
hive_login_msg_rec_block=Tu cuenta está bloqueada para cambios de correo electrónico.
hive_login_msg_rec_disable=¡No puedes cambiar el correo electrónico de una cuenta deshabilitada!

# Login Mails
hive_login_mail_pre_change=Activa tu nuevo correo aquí: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_change=Activa Tu Nuevo Correo Electrónico
hive_login_mail_title_register=Activa Tu Nueva Cuenta
hive_login_mail_pre_register=Haz clic en el siguiente enlace para activar tu cuenta: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_rec=Recupera Tu Cuenta
hive_login_mail_pre_rec=Haz clic en el siguiente enlace para recuperar la contraseña de tu cuenta: <a href="SF_ACTION_URL">SF_ACTION_URL</a>

# Login - Activation
hive_login_msg_a_ok=¡Has activado exitosamente tu cuenta! Ahora puedes iniciar sesión en nuestras páginas de inicio de sesión en este sitio web.
hive_login_msg_a_er=Error al intentar activar la cuenta de usuario. Por favor intenta recuperar la contraseña de tu cuenta o registra una nueva cuenta.
hive_login_msg_a_exp=El token de activación es inválido. Por favor, recupera tu cuenta en la página de inicio de sesión para activar tu cuenta.
hive_login_msg_a_block=La activación de tu cuenta ha sido deshabilitada; por favor intenta de nuevo más tarde.

# Login - Recover Request
hive_login_msg_rr_recnewunk=El correo electrónico proporcionado no está registrado.
hive_login_msg_rr_recnope=Tu cuenta no tiene permiso para recuperar la contraseña.
hive_login_msg_rr_recnopede=Tu cuenta ha sido desactivada y no puede realizar nuevas solicitudes.
hive_login_msg_rr_recwait=Debes esperar 120 minutos antes de iniciar una nueva solicitud de recuperación.
hive_login_msg_rr_recnok=Por favor, revisa tu bandeja de entrada para un correo electrónico de restablecimiento de contraseña. Este correo contiene un enlace para recuperar tu contraseña.
hive_login_msg_recfr_ok=¡Por favor, revisa tu bandeja de entrada para obtener un enlace de recuperación de contraseña!

# Login - Recover Execute
hive_login_msg_pwtexpire=¡Este token de recuperación de contraseña ha expirado! Por favor, intenta recuperar tu cuenta nuevamente.
hive_login_msg_recexecerror=Error al intentar recuperar tu contraseña. Por favor intenta recuperar tu cuenta nuevamente.
hive_login_msg_recexecok=Ha recuperado su contraseña con éxito y ahora puede iniciar sesión con su nueva contraseña.
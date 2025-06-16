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
be_404_2=Error 404
be_404_1=¡El contenido solicitado no existe!
be_401_2=Acceso denegado
be_401_1=¡No tienes acceso a esta área!
b_permissions=Permisos

## Popups
be_edit_abort=¡Haz clic aquí para abortar la operación!
be_list_h_exec_flush=¡Todos los elementos en esta tabla han sido eliminados!
be_list_h_btn_flush_rly=¿Realmente quieres vaciar esta tabla? ¡Esto reinicializará esta tabla relacionada en la base de datos y eliminará todas las entradas antiguas!
be_list_h_btn_flush=Vaciar tabla
be_cbanner_1=¡Este sitio web está usando cookies de sesión!
be_cbanner_2=Acepto
be_pp_hide=¿Realmente quieres ocultar este elemento en la lista pública de libros?
be_pp_unhide=¿Realmente quieres mostrar este elemento en la lista pública de libros?
be_pp_delbook=¿Realmente quieres eliminar este libro? Esto eliminará toda la información relacionada y su registro.
be_pp_errimage=¡Por favor selecciona un archivo jpg válido!
be_pp_errimage1=No se ha subido ningún archivo o hubo un error durante la carga.
be_pp_errimage2=Error al mover el archivo cargado.
be_pp_errimage3=Tipo de archivo inválido. Solo se permiten archivos JPG.
be_pp_sapi=¡Esto sobrescribirá la información actual del libro con la información obtenida de openLibrary! ¡La imagen de portada también será reemplazada!
be_pp_sapierr=¡Error al intentar comunicar con la API de openLibrary!
be_pp_sr1=¿Realmente quieres eliminar este libro?
be_pp_sr2=¿Este libro ha vuelto a estar en stock y ha sido devuelto?
be_pp_sr3=¡Error al intentar comunicar con la API de openLibrary!

## Permissions
be_tperm_page_deadlines=Gestionar plazos
be_dperm_page_deadlines=Puede alquilar libros a los usuarios y gestionar los plazos.
be_tperm_page_books=Gestionar libros
be_dperm_page_books=Acceso a la página de libros y sus funciones, puede crear, editar y eliminar libros.
be_tperm_page_tag=Gestionar etiquetas
be_dperm_page_tag=Acceso a la página de etiquetas de libros y sus funciones, puede crear, editar y eliminar etiquetas.
be_tperm_page_user=Gestionar usuarios
be_dperm_page_user=Acceso a la página de usuarios y sus funciones, puede crear usuarios y ver/gestionar todos los usuarios.
be_tperm_page_blacklist=Gestionar lista negra
be_dperm_page_blacklist=Acceso a la página de la lista negra de IP y sus funciones.
be_tperm_page_logging=Gestionar registros
be_dperm_page_logging=Acceso a la página de registros y sus funciones.
be_tperm_page_settings=Gestionar configuración
be_dperm_page_settings=Acceso a la página de configuración y sus funciones.

## Events
be_list_exec_idel=¡El elemento ha sido eliminado!
be_list_exec_iedit=¡El elemento ha sido modificado!
be_usr_ad_herem=¡Debes completar los datos necesarios!
be_usr_ad_hmailex=¡Ya existe otro usuario con ese correo! Por favor, elige otro correo para este usuario.
be_usr_ad_hmaok=¡El usuario ha sido creado!
be_str_item_created=¡El elemento ha sido creado!


############################################################################################################################################1


## Encabezados de Lista
be_list_h_date=Fecha
be_list_h_id=ID
be_list_h_ttype=Tipo
be_list_h_ref=Referencia
be_list_h_detail=Detalles
be_list_h_ar=Llegadas
be_list_h_url=URL
be_list_h_site=Sitio
be_list_h_err=Error
be_list_h_rece=Receptor
be_list_h_content=Contenido
be_list_h_time=Hora
be_list_h_ip=IP
be_list_h_fails=Fallos
be_list_h_delete=Eliminar
be_user_area_adr=Dirección
be_user_area_mail=Correo electrónico
be_usr_ad_hmail=Correo

## Navegación
be_deadlines=Fechas límite
be_profile=Perfil
be_logout=Cerrar sesión
be_tag=Etiquetas
be_books=Libros
be_privacy=Privacidad
be_impressum=Aviso legal
be_settings=Configuración
be_blacklist=Lista negra
be_logging=Registro
be_user=Usuarios
be_myprofile=Mi perfil
be_login=Iniciar sesión

## Área de Etiquetas
be_tag_raw=Etiquetas
be_tag_rawn=Nombre de etiqueta
be_tag_add=Añadir etiqueta
be_tag_edit=Editar etiqueta
be_tag_chdele=¿Realmente deseas eliminar esta etiqueta?
be_tag_exp=Aquí puedes gestionar etiquetas, las etiquetas se pueden asignar a libros.

## Área de Lista Negra
be_exp_blacklist=Aquí se pueden ver las IP bloqueadas. Estas IP no podrán iniciar sesión en este sitio web ni realizar operaciones autenticadas.

## Área de Registro
be_exp_logging=Aquí puedes ver un protocolo de actividades en este sistema.

## Área de Libros
be_book_add=Añadir libro
be_booked_isbn=ISBN
be_booked_title=Título
be_booked_autor=Autor
be_booked_descr=Descripción
be_booked_lang=Idioma
be_booked_released=Fecha de lanzamiento
be_booked_type=Tipo
be_booked_pub=Editorial
be_vb_header_log=Registro
be_vb_header_rentc=Cantidad
be_vb_header_ima=Portada
be_vb_header_det=Detalles

## Área de Fechas Límite
be_deadline_raw=Fechas límite
be_deadline_exp=Aquí puedes ver las fechas límite abiertas y las devoluciones de libros pendientes.
be_table_header_book=Libro
be_table_header_barcode=Código de barras
be_table_header_duedate=Fecha de vencimiento

# Área de Perfil
b_prof_pwinfo=Aquí puedes cambiar la contraseña para iniciar sesión.
b_prof_mailinfo=Aquí puedes cambiar el correo electrónico para iniciar sesión.

## Área de Usuario
be_password_filter_setup=La contraseña debe cumplir los siguientes criterios:<br />- Al menos 10 caracteres<br />- Al menos 1 letra mayúscula<br />- Al menos 1 letra minúscula<br />- Al menos un número



############################################################################################################################################3

be_yes=Sí
be_no=No
b_in_time=A tiempo
b_overdue=Tiempo excedido
b_today_return=Devolver hoy
b_view=Ver
be_table_header_returndate=Fecha de devolución
b_active=Activo
b_inactive=Inactivo
b_edit=Editar
b_action=Acción
b_delete=Eliminar
be_close=Cerrar
be_cancel=Cancelar
b_description=Descripción
be_list=Lista
be_none=Ninguno
be_help=Ayuda
be_explanation=Explicación
b_nosslval=Sin validación SSL
b_sslval=Validación SSL forzada
b_low=Bajo
b_medium=Medio
b_high=Alto
b_apirequest=Sincronizar con API
b_barcode=Código de barras
b_add=Añadir
b_nolistcurrent=¡Actualmente no hay elementos en esta lista!
b_backtolist=Volver a la lista
b_hide=Ocultar
b_unhide=Mostrar
be_profile=Perfil
b_creation=Creación
b_lastmodification=Última modificación
b_firstname=Nombre
b_lastname=Apellido
b_street=Calle
b_postcode=Código postal
b_country=País
b_changeimage=Cambiar imagen
b_password=Contraseña
b_change_password=Cambiar contraseña
b_email=Correo electrónico
b_change_email=Cambiar correo electrónico
b_status=Estado
b_id=ID
b_tags=Etiquetas
b_thisitemcurhiddenlist=¡Este elemento está actualmente oculto en la lista pública!
b_nobooktitlelist=Título desconocido
b_hidden=Oculto
b_lend=Prestar
b_return=Devolver
b_hardback=Tapa dura
b_paperback=Tapa blanda
b_softcover=Cubierta suave
b_bookcurrentlyrented=¡Este libro está actualmente reservado por otro usuario y estará disponible pronto!
b_available=Disponible
b_reserved=Reservado
b_user=Usuario
b_until=Hasta
b_returndate=Fecha de devolución
b_note=Nota
b_lendtouser=Prestar al usuario
b_changefavicon=Cambiar favicon
b_settings_exp_string=En esta página puedes controlar las funcionalidades del sitio web.
b_tel=Teléfono
be_pp_sr1ssd=¿Se ha devuelto el libro?
be_error_booknoexists=¡El libro que intentaste ver no existe!
be_error_usernoexists=¡El usuario que intentaste ver no existe!
be_puser_chdele3=Habilitar usuario
b_prof_pwinfoadd=Como administrador, puedes cambiar los correos de los usuarios sin activación


############################################################################################################################################4

be_about_core_info=Versión CMS
be_about_fw_info=Versión del Framework
be_about_site_info=Versión del Módulo
be_set_header_general=Configuración General
be_set_header_mail=Configuración de Correo Electrónico
be_set_header_trans=Configuración de Traducción
be_set_header_about=Información del Sistema
be_string_key=Clave
be_string_language=Idioma
be_string_translation=Traducción
be_trans_current_active=Traducciones Predeterminadas
be_trans_current_ovr=Anulaciones de Traducción
be_trans_button_create=Crear Traducción
be_trans_button_edit=Editar Traducción
be_trans_dlrly=¿Realmente deseas eliminar esta traducción?
be_eexps_hivetitle=Título de este sitio web.
be_eexps_imp=Tu Texto de Aviso Legal
be_eexps_pry=Tu Texto de Privacidad
be_eexps_expiretoken=El Token de Correo Electrónico expira después de una cantidad específica de minutos.
be_eexps_expireip=Límite de Fallos de IP antes de la Lista Negra.
be_eexps_expirecsrf=Tiempo en segundos que las Claves CSRF son válidas antes de que expiren.
be_eexps_expireact=Tiempo en minutos que los usuarios deben esperar entre solicitudes de recuperación/cambio de correo.
be_eexps_upgc=Asegurar el actualizador en el sitio con un código de acceso.
be_eexps_actmc=Permitir a los usuarios cambiar su correo electrónico.
be_eexps_actrec=Permitir a los usuarios recuperar su contraseña.
be_eexps_actreg=Permitir a los invitados registrarse en este sitio web.
be_eexps_actdeflang=Idioma predeterminado para invitados si no han establecido su propio idioma.
be_eexps_trapage=En esta sección puedes ver las traducciones predeterminadas y anularlas si es útil.
be_eexpm_user=Nombre de usuario para el Servidor de Correo Electrónico
be_eexpm_pass=Contraseña para el Servidor de Correo Electrónico
be_eexpm_host=Nombre de host SMTP
be_eexpm_port=Puerto SMTP
be_eexpm_auth=Método de Autenticación SMTP
be_eexpm_sm=Correo del Remitente para Correos Salientes
be_eexpm_sn=Nombre del Remitente para Correos Salientes
be_eexpm_mh=Encabezado de Correo Predeterminado
be_eexpm_debug=Si ocurren problemas al enviar correo, puedes activar la depuración aquí - en este caso, en cada operación de envío se mostrará información de depuración en la pantalla - incluso si es exitosa.
be_eexpm_ins=Permitir Conexiones SMTP Inseguras
be_eexpm_mf=Pie de Página de Correo Predeterminado
obr_inp_title=Título
obr_inp_autor=Autor
obr_inp_publisher=Editorial
obr_inp_isbn=ISBN
obr_inp_lang=Idioma
obr_inp_tags=Etiquetas
be_obr_li_id=ID del Libro
be_obr_li_book_title=Título
be_obr_li_book_autor=Autor
be_obr_li_book_type=Tipo de Libro
be_obr_li_book_publisher=Editorial
be_obr_li_book_isbn=ISBN
be_obr_li_book_lang=Idioma
be_obr_li_book_tag_array=Categorías Vinculadas
be_obr_li_book_creation=Fecha de Creación
be_obr_li_book_modification=Fecha de Modificación
be_obr_update_book=Obtener Datos del Libro por ISBN
be_obr_delete_book=Eliminar Libro
be_obr_add_stock=Artículos Alquilables
obr_book_item_list=Lista de Artículos Alquilables
be_op_usr_622=El usuario ha sido editado


############################################################################################################################################5
string_add=Añadir
be_exp_usrlst=Aquí puedes gestionar y crear usuarios.
be_user_area_usrname=Nombre
be_opok=Estás viendo este sitio porque has solicitado una activación.<br/>Consulta el cuadro de eventos en la esquina superior derecha para más detalles.
be_operr=Error
be_str_item_createderr=¡No se pudo crear el token API, esto suele ocurrir si este token ya existe para el módulo del sitio relacionado!
be_mail_template_edit=Editar Plantilla de Correo
be_mail_exp_recover=Plantilla de correo para recuperar usuarios registrados. Esta plantilla se envía cuando los usuarios solicitan una nueva contraseña a través de la función 'olvidé mi contraseña'. Se establece una sustitución para proporcionar al usuario un enlace. Con la sustitución fácil _ACTION_URL_.
be_mail_exp_mchange=Plantilla de correo para cambios en los correos de usuarios registrados. Esta plantilla se envía cuando el usuario cambia su correo principal o cuando se cambia en general. Se establece una sustitución para proporcionar al usuario un enlace para activar y confirmar el nuevo correo. Con la sustitución fácil _ACTION_URL_ para la URL de activación.
be_mail_exp_acti=Plantilla de correo para activar usuarios registrados. Esta plantilla se envía cuando se crean usuarios o empleados de la empresa. Se establece una sustitución para proporcionar al usuario un enlace. Con la sustitución fácil _ACTION_URL_ para activar la nueva cuenta. El usuario también puede recuperar la contraseña para activar la cuenta.
be_se_key_mch=Clave de Activación de Correo
b_permission=Permisos
be_user_area_name=Gestión de Usuarios
be_user_area_create=Añadir Usuario
be_usr_ad_errgm=El usuario ha sido creado, pero hubo un error al intentar enviar el correo de activación.
be_noti_user_crea=Ten en cuenta que si un usuario no ha confirmado su cuenta y otro usuario intenta registrarse con el mismo correo, el usuario inicial no confirmado puede ser eliminado. Esto puede llevar a pérdida de datos. Así que asegúrate de trabajar siempre con usuarios confirmados si no quieres que el sistema los elimine. Nunca uses funcionalidades para desconfirmar usuarios, ya que esto también puede llevar a pérdida de datos.
be_usr_ad_errg=Error al intentar crear el usuario.
be_usr_ad_hpasserem=¡La contraseña elegida no cumple con las recomendaciones!
be_usr_ad_hpass=Contraseña
be_usr_ad_h=Procedimiento de Activación
be_usr_ad_rec=Solicitar activación por correo y que el usuario establezca su propia contraseña
be_usr_ad_act=Solicitar solo activación por correo
be_usr_ad_ok=Activar este usuario sin ningún procedimiento de activación
be_puser_noview=¡Este usuario no existe!
be_puser_cpass=Cambiar Contraseña
be_puser_cpass1=Confirmar Contraseña
be_puser_cpass2=Nueva Contraseña
be_puser_cper=Cambiar Permisos
be_puser_chmm=Cambiar Correo del Usuario
be_puser_chmm1=Nuevo Correo
be_puser_chdele=Eliminar Usuario
be_puser_chdele1=Operaciones de Usuario
be_puser_chdele7=¡Este usuario actualmente no está confirmado por correo!
be_puser_chdele8=¡Este usuario está actualmente bloqueado!
be_puser_chdele9=¡Este usuario está actualmente deshabilitado!
be_puser_chdele10=¡Esta es la cuenta inicial de super-admin! Siempre tiene acceso completo a este panel de administración.
be_puser_chdele11=¡Este perfil pertenece a otro usuario que no eres tú! Ten cuidado al cambiar la configuración, ya que los cambios tendrán impacto en la experiencia del usuario.
be_puser_chdele12=Esperando activación de nuevo correo para:
be_puser_chdele13=Haz clic aquí para abortar la operación.
be_puser_chdele14=¡El correo no puede estar vacío!
be_puser_chdele15=Error Desconocido
be_puser_chdele16=¡La funcionalidad para cambiar el correo está actualmente deshabilitada para este usuario!
be_puser_chdele17=No está permitido cambiar el correo de este usuario.
be_puser_chdele18=¡Ya existe un usuario activo con ese correo! No es posible tener correos duplicados en usuarios.
be_puser_chdele19=Necesitas esperar un tiempo específico entre solicitudes de cambio de correo: 
be_puser_chdele20=minutos
be_puser_chdele21=¡Por favor, revisa la bandeja de entrada de tu nuevo correo para activar el nuevo correo!
be_puser_chdele22=¡Hubo un error al enviar el correo de activación!
be_puser_chdele23=¡La solicitud de cambio de correo ha sido cancelada!
be_op_usr_1=¡La contraseña necesita un número, una letra minúscula y una mayúscula! Como mínimo, debes tener 10 caracteres.
be_op_usr_2=¡Las contraseñas no pueden estar vacías!
be_op_usr_3=¡Las contraseñas no coinciden!
be_op_usr_4=¡La contraseña ha sido cambiada!
be_op_usr_6=¡Los permisos del usuario han sido cambiados!
be_op_usr_11=¡El usuario ha sido confirmado y ahora puede iniciar sesión!
be_op_usr_12=¡El usuario ha sido eliminado!
be_book_area_create=Crear Libro

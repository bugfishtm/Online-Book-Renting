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

## Erro
be_404_2=Erro 404
be_404_1=O conteúdo solicitado não existe!
be_401_2=Acesso Negado
be_401_1=Você não tem acesso a esta área!
b_permissions=Permissões

## Popups
be_edit_abort=Clique aqui para cancelar a operação!
be_list_h_exec_flush=Todos os itens nesta tabela foram excluídos!
be_list_h_btn_flush_rly=Você realmente deseja limpar esta tabela? Isso reinicializará a tabela do banco de dados relacionada e excluirá todas as entradas antigas!
be_list_h_btn_flush=Limpar Tabela
be_cbanner_1=Este site está usando cookies de sessão!
be_cbanner_2=Eu Concordo
be_pp_hide=Você realmente deseja ocultar este item da lista pública de livros?
be_pp_unhide=Você realmente deseja mostrar este item na lista pública de livros?
be_pp_delbook=Você realmente deseja excluir este livro? Isso excluirá todas as informações relacionadas e o registro correspondente.
be_pp_errimage=Por favor, selecione um arquivo JPG válido!
be_pp_errimage1=Nenhum arquivo enviado ou ocorreu um erro durante o upload.
be_pp_errimage2=Erro ao mover o arquivo enviado.
be_pp_errimage3=Tipo de arquivo inválido. Apenas arquivos JPG são permitidos.
be_pp_sapi=Isso substituirá as informações atuais do livro com as informações obtidas da OpenLibrary. A imagem da capa também será substituída!
be_pp_sapierr=Erro ao tentar se comunicar com a API da OpenLibrary!
be_pp_sr1=Você realmente deseja excluir este item do livro?
be_pp_sr2=Este livro voltou ao estoque e foi devolvido?
be_pp_sr3=Erro ao tentar se comunicar com a API da OpenLibrary!

## Permissões
be_tperm_page_deadlines=Gerenciar Prazos
be_dperm_page_deadlines=Pode alugar livros para usuários e gerenciar prazos.
be_tperm_page_books=Gerenciar Livros
be_dperm_page_books=Acesso à página de livros e suas funções, pode criar, editar e excluir livros.
be_tperm_page_tag=Gerenciar Tags
be_dperm_page_tag=Acesso à página de tags de livros e suas funções, pode criar, editar e excluir tags.
be_tperm_page_user=Gerenciar Usuários
be_dperm_page_user=Acesso à página de usuários e suas funções, pode criar usuários e visualizar/gerenciar todos os usuários.
be_tperm_page_blacklist=Gerenciar Lista Negra
be_dperm_page_blacklist=Acesso à página de lista negra de IPs e suas funções.
be_tperm_page_logging=Gerenciar Registros
be_dperm_page_logging=Acesso à página de registros e suas funções.
be_tperm_page_settings=Gerenciar Configurações
be_dperm_page_settings=Acesso à página de configurações e suas funções.

## Eventos
be_list_exec_idel=O item foi excluído!
be_list_exec_iedit=O item foi alterado!
be_usr_ad_herem=Você precisa preencher os dados necessários!
be_usr_ad_hmailex=Já existe outro usuário com esse e-mail! Por favor, escolha outro e-mail para este usuário.
be_usr_ad_hmaok=O usuário foi criado!
be_str_item_created=O item foi criado!

############################################################################################################################################1

## Cabeçalhos da Lista
be_list_h_date=Data
be_list_h_id=ID
be_list_h_ttype=Tipo
be_list_h_ref=Referência
be_list_h_detail=Detalhes
be_list_h_ar=Chegadas
be_list_h_url=URL
be_list_h_site=Site
be_list_h_err=Erro
be_list_h_rece=Receptor
be_list_h_content=Conteúdo
be_list_h_time=Hora
be_list_h_ip=IP
be_list_h_fails=Falhas
be_list_h_delete=Excluir
be_user_area_adr=Endereço
be_user_area_mail=E-Mail
be_usr_ad_hmail=Correio

## Navegação
be_deadlines=Prazos
be_profile=Perfil
be_logout=Sair
be_tag=Tags
be_books=Livros
be_privacy=Privacidade
be_impressum=Impressum
be_settings=Configurações
be_blacklist=Lista Negra
be_logging=Registros
be_user=Usuários
be_myprofile=Meu Perfil
be_login=Entrar

## Área de Tags
be_tag_raw=Tags
be_tag_rawn=Nome da Tag
be_tag_add=Adicionar Tag
be_tag_edit=Editar Tag
be_tag_chdele=Você realmente deseja excluir esta tag?
be_tag_exp=Aqui você pode gerenciar tags, as tags podem ser atribuídas aos livros.

## Área de Lista Negra
be_exp_blacklist=Aqui você pode ver os IPs bloqueados. Esses IPs não poderão fazer login neste site ou realizar operações autenticadas.

## Área de Registros
be_exp_logging=Aqui você pode ver um registro das atividades neste sistema.

############################################################################################################################################2

## Área de Livros
be_book_add=Adicionar Livro
be_booked_isbn=ISBN
be_booked_title=Título
be_booked_autor=Autor
be_booked_descr=Descrição
be_booked_lang=Idioma
be_booked_released=Data de Lançamento
be_booked_type=Tipo
be_booked_pub=Editora
be_vb_header_log=Log
be_vb_header_rentc=Quantidade
be_vb_header_ima=Capa
be_vb_header_det=Detalhes


## Área de Prazo
be_deadline_raw=Prazos
be_deadline_exp=Aqui você pode ver os prazos abertos e as datas de devolução dos livros.
be_table_header_book=Livro
be_table_header_barcode=Código de Barras
be_table_header_duedate=Data de Vencimento

# Área de Perfil
b_prof_pwinfo=Aqui você pode alterar a senha para login.
b_prof_mailinfo=Aqui você pode alterar o e-mail para login.


## Área do Usuário
be_password_filter_setup=A senha deve atender aos seguintes critérios:<br />- Pelo menos 10 caracteres<br />- Pelo menos 1 letra maiúscula<br />- Pelo menos 1 letra minúscula<br />- Pelo menos 1 número

############################################################################################################################################3

be_yes=Sim
be_no=Não
b_in_time=No Prazo
b_overdue=Prazo Excedido
b_today_return=Devolver Hoje
b_view=Ver
be_table_header_returndate=Data de Devolução
b_active=Ativo
b_inactive=Inativo
b_edit=Editar
b_action=Ação
b_delete=Excluir
be_close=Fechar
be_cancel=Cancelar
b_description=Descrição
be_list=Lista
be_none=Nenhum
be_help=Ajuda
be_explanation=Explicação
b_nosslval=Sem Validação SSL
b_sslval=Validação SSL Forçada
b_low=Baixo
b_medium=Médio
b_high=Alto
b_apirequest=Sincronizar com a API
b_barcode=Código de Barras
b_add=Adicionar
b_nolistcurrent=Atualmente não há itens nesta lista!
b_backtolist=Voltar à Lista
b_hide=Ocultar
b_unhide=Reexibir
be_profile=Perfil
b_creation=Criação
b_lastmodification=Última Modificação
b_firstname=Primeiro Nome
b_lastname=Último Nome
b_street=Rua
b_postcode=Código Postal
b_country=País
b_changeimage=Mudar Imagem
b_password=Senha
b_change_password=Mudar Senha
b_email=E-mail
b_change_email=Mudar E-mail
b_status=Status
b_id=ID
b_tags=Etiquetas
b_thisitemcurhiddenlist=Este item está atualmente oculto na lista pública!
b_nobooktitlelist=Título Desconhecido
b_hidden=Oculto
b_lend=Emprestar
b_return=Devolver
b_hardback=Capa Dura
b_paperback=Capa Mole
b_softcover=Capa Flexível
b_bookcurrentlyrented=Este livro está atualmente reservado por outro usuário e estará disponível em breve!
b_available=Disponível
b_reserved=Reservado
b_user=Usuário
b_until=Até
b_returndate=Data de Devolução
b_note=Nota
b_lendtouser=Emprestar ao Usuário
b_changefavicon=Mudar Favicon
b_settings_exp_string=Nesta página, você pode controlar as funcionalidades do site.
b_tel=Telefone
be_pp_sr1ssd=O livro foi devolvido?
be_error_booknoexists=O livro que você tentou visualizar não existe!
be_error_usernoexists=O usuário que você tentou visualizar não existe!
be_puser_chdele3=Ativar Usuário
b_prof_pwinfoadd=Como administrador, você pode mudar os e-mails dos usuários sem ativação.

############################################################################################################################################4

be_about_core_info=Versão CMS
be_about_fw_info=Versão do Framework
be_about_site_info=Versão do Módulo
be_set_header_general=Configurações Gerais
be_set_header_mail=Configurações de E-Mail
be_set_header_trans=Configurações de Tradução
be_set_header_about=Informações do Sistema
be_string_key=Chave
be_string_language=Idioma
be_string_translation=Tradução
be_trans_current_active=Traduções Padrão
be_trans_current_ovr=Substituições de Tradução
be_trans_button_create=Criar Tradução
be_trans_button_edit=Editar Tradução
be_trans_dlrly=Você realmente deseja excluir esta tradução?
be_eexps_hivetitle=Título deste site.
be_eexps_imp=Texto de Impressão
be_eexps_pry=Texto de Privacidade
be_eexps_expiretoken=Token de E-Mail expira após um número específico de minutos.
be_eexps_expireip=Límite de falhas de IP antes de colocar na lista negra.
be_eexps_expirecsrf=Tempo em segundos em que as chaves CSRF são válidas antes de expirar.
be_eexps_expireact=Tempo em minutos que os usuários precisam aguardar entre solicitações de recuperação/troca de e-mail.
be_eexps_upgc=Proteja o atualizador do site com um código de acesso.
be_eexps_actmc=Permitir que os usuários alterem seu E-Mail.
be_eexps_actrec=Permitir que os usuários recuperem sua senha.
be_eexps_actreg=Permitir que visitantes se registrem neste site.
be_eexps_actdeflang=Idioma padrão para visitantes que não definiram seu próprio idioma.
be_eexps_trapage=Nesta seção você pode ver traduções padrão e substituí-las, se necessário.
be_eexpm_user=Nome de usuário do Servidor de E-Mail
be_eexpm_pass=Senha do Servidor de E-Mail
be_eexpm_host=Nome do Host SMTP
be_eexpm_port=Porta SMTP
be_eexpm_auth=Método de Autenticação SMTP
be_eexpm_sm=E-Mail do Remetente para E-Mails de saída
be_eexpm_sn=Nome do Remetente para E-Mails de saída
be_eexpm_mh=Cabeçalho Padrão de E-Mail
be_eexpm_debug=Se ocorrerem problemas ao enviar e-mails, você pode ativar o modo de depuração aqui - nesse caso, a cada operação de envio, informações de depuração serão mostradas na tela, mesmo que seja bem-sucedida.
be_eexpm_ins=Permitir conexões SMTP inseguras
be_eexpm_mf=Rodapé Padrão de E-Mail
obr_inp_title=Título
obr_inp_autor=Autor
obr_inp_publisher=Editora
obr_inp_isbn=ISBN
obr_inp_lang=Idioma
obr_inp_tags=Tags
be_obr_li_id=ID do Livro
be_obr_li_book_title=Título
be_obr_li_book_autor=Autor
be_obr_li_book_type=Tipo de Livro
be_obr_li_book_publisher=Editora
be_obr_li_book_isbn=ISBN
be_obr_li_book_lang=Idioma
be_obr_li_book_tag_array=Categorias Vinculadas
be_obr_li_book_creation=Data de Criação
be_obr_li_book_modification=Data de Modificação
be_obr_update_book=Buscar Dados do Livro pelo ISBN
be_obr_delete_book=Excluir Livro
be_obr_add_stock=Itens Disponíveis para Aluguel
obr_book_item_list=Lista de Itens Alugáveis
be_op_usr_622=O usuário foi editado.

############################################################################################################################################5

string_add=Adicionar
be_exp_usrlst=Aqui você pode gerenciar e criar usuários.
be_user_area_usrname=Nome
be_opok=Você está vendo este site porque solicitou uma ativação.<br/>Veja a caixa de eventos no canto superior direito para mais detalhes.
be_operr=Erro
be_str_item_createderr=O Token API não pôde ser criado, isso geralmente acontece se o token já existir para o módulo relacionado do site!
be_mail_template_edit=Editar Modelo de E-mail
be_mail_exp_recover=Modelo de e-mail para recuperar usuários registrados. Este modelo é enviado quando os usuários solicitam uma nova senha através da função 'esqueci a senha'. Uma substituição é configurada para fornecer ao usuário um link. Substituição fácil _ACTION_URL_.
be_mail_exp_mchange=Modelo de e-mail para mudanças nos e-mails dos usuários registrados. Este modelo é enviado quando o usuário altera seu e-mail principal ou quando é alterado em geral. Uma substituição é configurada para fornecer ao usuário um link para ativar e confirmar o novo e-mail. Substituição fácil _ACTION_URL_ para o URL de ativação.
be_mail_exp_acti=Modelo de e-mail para ativar usuários registrados. Este modelo é enviado quando usuários ou funcionários da empresa são criados. Uma substituição é configurada para fornecer ao usuário um link. Substituição fácil _ACTION_URL_ para ativar a nova conta. O usuário também pode recuperar a senha para ativar a conta.
be_se_key_mch=Chave de Ativação por E-mail
b_permission=Permissões
be_user_area_name=Gestão de Usuários
be_user_area_create=Adicionar Usuário
be_usr_ad_errgm=O usuário foi criado, mas houve um erro ao tentar enviar o e-mail de ativação!
be_noti_user_crea=Por favor, esteja ciente de que se um usuário não confirmou sua conta e outro usuário tenta se cadastrar com o mesmo e-mail, o usuário inicial não confirmado pode ser excluído. Isso pode levar à perda de dados. Portanto, certifique-se de sempre trabalhar com usuários confirmados, se não quiser que o sistema os exclua. Nunca use funcionalidades para desconfirmar usuários, pois isso também pode levar à perda de dados.
be_usr_ad_errg=Erro ao tentar criar o usuário.
be_usr_ad_hpasserem=A senha escolhida não atende às recomendações!
be_usr_ad_hpass=Senha
be_usr_ad_h=Procedimento de Ativação
be_usr_ad_rec=Solicitar ativação por e-mail e permitir ao usuário definir sua própria senha
be_usr_ad_act=Solicitar apenas ativação por e-mail
be_usr_ad_ok=Ativar este usuário sem nenhum procedimento de ativação
be_puser_noview=Este usuário não existe!
be_puser_cpass=Mudar Senha
be_puser_cpass1=Confirmar Senha
be_puser_cpass2=Nova Senha
be_puser_cper=Mudar Permissões
be_puser_chmm=Mudar E-mail do Usuário
be_puser_chmm1=Novo E-mail
be_puser_chdele=Excluir Usuário
be_puser_chdele1=Operações do Usuário
be_puser_chdele7=Este usuário ainda não foi confirmado por e-mail!
be_puser_chdele8=Este usuário está bloqueado!
be_puser_chdele9=Este usuário está desativado!
be_puser_chdele10=Esta é a conta inicial de superadministrador! Ela sempre terá acesso total a este painel de administração!
be_puser_chdele11=Este perfil pertence a outro usuário que não você! Tenha cuidado ao alterar configurações, pois as alterações impactarão a experiência do usuário!
be_puser_chdele12=Aguardando nova ativação de e-mail para:
be_puser_chdele13=Clique aqui para cancelar a operação.
be_puser_chdele14=O e-mail não pode estar vazio!
be_puser_chdele15=Erro desconhecido
be_puser_chdele16=A funcionalidade de alteração de e-mail está atualmente desativada para este usuário!
be_puser_chdele17=Não é permitido alterar o e-mail deste usuário.
be_puser_chdele18=Já existe um usuário ativo com esse e-mail! E-mails duplicados para usuários não são permitidos.
be_puser_chdele19=Você precisa aguardar um tempo específico entre as solicitações de alteração de e-mail:
be_puser_chdele20=minutos
be_puser_chdele21=Por favor, verifique a caixa de entrada do seu novo e-mail para ativar o novo e-mail!
be_puser_chdele22=Ocorreu um erro ao enviar o e-mail de ativação!
be_puser_chdele23=A solicitação de alteração de e-mail foi cancelada!
be_op_usr_1=A senha deve conter pelo menos um número, uma letra minúscula e uma letra maiúscula! A senha deve ter no mínimo 10 caracteres.
be_op_usr_2=As senhas não podem estar vazias!
be_op_usr_3=As senhas não coincidem!
be_op_usr_4=A senha foi alterada!
be_op_usr_6=As permissões do usuário foram alteradas!
be_op_usr_11=O usuário foi confirmado e agora pode fazer login!
be_op_usr_12=O usuário foi excluído!
be_book_area_create=Criar Livro

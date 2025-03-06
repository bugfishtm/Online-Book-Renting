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
## Substituições de Idioma Padrão do Backend para Scripts de Login
##########################################################################################

# Strings - Geral
string_email=E-Mail
string_password=Senha
string_login=Entrar
string_register=Registrar
string_close=Fechar
string_error=Erro

# Página - Ações
hive_login_changelanguage=Você pode alterar o idioma
hive_login_changelanguage_here=aqui.
hive_login_lostpass=Esqueceu a Senha?
hive_login_notregistered=Não Registrado?
hive_login_rememberme=Usar Cookies?
hive_login_recoveraccount=Recuperar Conta
hive_login_haveaccount=Já Tem uma Conta?
hive_login_password_confirm=Confirmar Senha
hive_login_mc_change_mail=Alterar E-Mail
hive_login_mc_backtohome=Voltar para a Página Inicial
hive_login_title_accactivation=Ativação da Conta
hive_cannotenterwhilenologin=Você não pode acessar esta página se não estiver logado!
hive_cannotenterwhilelogin=Você não pode acessar esta página se já estiver logado!
hive_cannotoperatesiteerror=Há um erro crítico neste módulo do site, portanto, você não pode executar nenhuma operação no momento!
hive_login_backtologin=Voltar para o Login
hive_login_change_Lang=Alterar Idioma
hive_login_language_changed=O idioma foi alterado!

# Eventos de Login - Geral
hive_login_msg_l_wrong=Combinação de Senha/E-Mail incorreta.
hive_login_msg_csrf=Formulário expirado, tente novamente.
hive_login_msg_empty=Por favor, insira os dados necessários!
hive_login_msg_ipban=Seu IP está bloqueado no momento; tente novamente mais tarde.
hive_login_msg_logout=Você foi desconectado!
hive_login_msg_nomatchpass=A confirmação de senha não corresponde à senha inserida.
hive_login_doremember=Você quer lembrar sua senha?

# Eventos de Login - Login
hive_login_msg_l_ok=Login bem-sucedido.
hive_login_msg_l_blocked=Você não pode fazer login porque sua conta está bloqueada.
hive_login_msg_l_inactive=Sua conta de usuário ainda não foi ativada! Recupere sua senha para ativar sua conta ou clique no link no E-Mail de ativação que você recebeu!
hive_login_msg_l_blockedpwf=Você inseriu a senha errada muitas vezes, e sua conta foi bloqueada!
hive_login_msg_l_disabled=Sua conta de usuário foi desativada!
hive_login_mail_serror=Erro ao tentar enviar o E-Mail. Este é um erro interno que precisa ser investigado e deve ser relatado à equipe do nosso site.
hive_login_msg_register_ok=Por favor, verifique sua caixa de entrada para ativar sua nova conta!
hive_login_msg_passfiltererror=A senha inserida não atende às regras de senha!
hive_login_msg_mailexist=Você está tentando registrar uma conta com um E-Mail que já existe!
hive_login_password_rules=Regras de Senha
hive_login_password_sign=Caracteres Necessários:
hive_login_password_cap=Letras Maiúsculas Necessárias:
hive_login_password_small=Letras Minúsculas Necessárias:
hive_login_password_special=Caracteres Especiais Necessários:
hive_login_password_numeric=Caracteres Numéricos Necessários:

# Eventos de Login - Alteração de E-Mail
hive_login_msg_m_ok=Você ativou com sucesso seu novo E-Mail!
hive_login_msg_m_er=Erro ao tentar ativar o novo endereço de E-Mail; tente novamente.
hive_login_msg_m_exp=O código de ativação do E-Mail expirou! Tente novamente para alterar seu E-Mail!
hive_login_msg_m_res=O E-Mail que você tentou ativar agora é usado em outra conta, então não pode ser associado à sua conta!
hive_login_msg_m_block=Sua conta está bloqueada para alterações de E-Mail!
hive_login_msg_m_noadr=A solicitação falhou. Por favor, tente novamente mais tarde.
hive_login_mc_cmailtext=Seu E-Mail atual é:
hive_login_msg_rec_ok=Por favor, verifique a nova caixa de entrada de E-Mail para ativar o novo endereço de E-Mail.
hive_login_msg_rec_err=Erro ao tentar alterar o endereço de E-Mail.
hive_login_msg_rec_wait=Você precisa esperar 120 minutos entre alterações de E-Mail!
hive_login_msg_rec_exist=O E-Mail que você está tentando alterar já é usado por outra conta de usuário!
hive_login_msg_rec_block=Sua conta está bloqueada para alterações de E-Mail!
hive_login_msg_rec_disable=Você não pode alterar o E-Mail de uma conta desativada!

# E-Mails de Login
hive_login_mail_pre_change=Ative seu novo E-Mail aqui: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_change=Ative Seu Novo E-Mail
hive_login_mail_title_register=Ative Sua Nova Conta
hive_login_mail_pre_register=Clique no link a seguir para ativar sua conta: <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_rec=Recupere Sua Conta
hive_login_mail_pre_rec=Clique no link a seguir para recuperar a senha de sua conta: <a href="SF_ACTION_URL">SF_ACTION_URL</a>

# Login - Ativação
hive_login_msg_a_ok=Você ativou com sucesso sua conta! Agora você pode fazer login nas páginas de login deste site.
hive_login_msg_a_er=Erro ao tentar ativar a conta de usuário. Tente recuperar sua senha ou registrar uma nova conta.
hive_login_msg_a_exp=O token de ativação é inválido. Recupere sua conta na página de login para ativar sua conta!
hive_login_msg_a_block=A ativação da sua conta foi desativada; tente novamente mais tarde!

# Login - Solicitação de Recuperação
hive_login_msg_rr_recnewunk=O E-Mail fornecido não está registrado.
hive_login_msg_rr_recnope=Sua conta não tem permissão para recuperar a senha!
hive_login_msg_rr_recnopede=Sua conta foi desativada e não pode fazer novas solicitações!
hive_login_msg_rr_recwait=Você precisa esperar 120 minutos antes de iniciar uma nova solicitação de recuperação!
hive_login_msg_rr_recnok=Por favor, verifique sua caixa de entrada para um E-Mail de redefinição de senha. Este E-Mail contém um link para recuperar sua senha.
hive_login_msg_recfr_ok=Por favor, verifique sua caixa de entrada para obter um link de recuperação de senha!

# Login - Execução de Recuperação
hive_login_msg_pwtexpire=Este Token de Recuperação de Senha expirou! Tente recuperar sua conta novamente.
hive_login_msg_recexecerror=Erro ao tentar recuperar sua senha. Tente novamente para recuperar sua conta.
hive_login_msg_recexecok=Você recuperou sua senha com sucesso e agora pode fazer login com sua nova senha.

##########################################################################################
## Setupable Constant Explanations
##########################################################################################

hive_var_exp_1=Tema: Cor padrão para Cores Dinâmicas do Tema
hive_var_exp_2=Tema: Array serializado com temas válidos
hive_var_exp_3=Tema: Tema padrão usado
hive_var_exp_4=Idioma: Array serializado com idiomas válidos
hive_var_exp_5=Idioma: Array com idioma padrão
hive_var_exp_6=Ações: Formulário de registro geral ativo? (1=on/0=off)
hive_var_exp_7=Sem explicação ainda.
hive_var_exp_8=Ações: Formulário de recuperação geral ativo? (1=on/0=off)
hive_var_exp_9=Ações: Formulário de ativação geral ativo? (1=on/0=off)
hive_var_exp_10=Formulário de login geral ativo? (1=on/0=off)
hive_var_exp_11=TinyMCE: String de configuração de plugins
hive_var_exp_12=TinyMCE: String de configuração da barra de menu
hive_var_exp_13=TinyMCE: String de configuração da barra de ferramentas
hive_var_exp_14=Configuração do usuário: Máximo de dias que as sessões/cookies são válidos
hive_var_exp_15=Configuração do usuário: Tempo em minutos para expiração de tokens de e-mails de ativação
hive_var_exp_16=Configuração do usuário: Bloquear usuários após X falhas de login (pode ser 0 para desabilitar)
hive_var_exp_17=Configuração do usuário: Tempo em minutos que o usuário tem que esperar entre solicitações (anti flood)
hive_var_exp_18=Configuração do usuário: Registrar sessões antigas? (Logins, Recuperações, Ativações, Mudanças de e-mail) (1=on/0=off)
hive_var_exp_19=Configuração do usuário: Registrar IPs de usuários no banco de dados (1=on/0=off)
hive_var_exp_20=Configuração do usuário: 1 - Remover chaves de recuperação após login bem-sucedido do usuário | 0 - Preservar chaves
hive_var_exp_21=Configuração do usuário: 1 - Permitir múltiplos logins | 0 - Desabilitar múltiplos logins
hive_var_exp_22=Filtro de senha: Mínimo de caracteres
hive_var_exp_23=Filtro de senha: Mínimo de caracteres maiúsculos
hive_var_exp_24=Filtro de senha: Mínimo de caracteres minúsculos
hive_var_exp_25=Filtro de senha: Mínimo de caracteres especiais
hive_var_exp_26=Filtro de senha: Mínimo de caracteres numéricos
hive_var_exp_27=Nome de usuário criado inicialmente
hive_var_exp_28=Senha do usuário criada inicialmente
hive_var_exp_29=Captcha: Altura da imagem
hive_var_exp_30=Captcha: Largura da imagem
hive_var_exp_31=Captcha: Cores para o captcha (Opcional, pode ser 0)
hive_var_exp_32=Captcha: Fonte (Se 0, a fonte padrão será usada)
hive_var_exp_33=Redis: Ativado? 1/0
hive_var_exp_34=Redis: Host
hive_var_exp_35=Redis: Porta
hive_var_exp_36=Atualizador: Título para o atualizador neste site
hive_var_exp_37=Atualizador: Código necessário para atualização? (pode ser 0 para desabilitar)
hive_var_exp_38=Configurações: Registrar solicitações de classe CURL? (1/0)
hive_var_exp_39=Configurações: Bloquear IPs após X falhas (pode ser 0 para desabilitar)
hive_var_exp_40=Configurações: Registrar Referers? (1/0)
hive_var_exp_41=Configurações: Tempo padrão de validade do código CSRF em segundos
hive_var_exp_42=Configurações: 1 - Execução de Cronjob apenas da linha de comando | 0 - Permitir execução de Cronjob no navegador
hive_var_exp_43=Configurações: Ativar registro de erros de depuração Javascript (1/0)
hive_var_exp_44=Configurações: Título do site para abas e mais
hive_var_exp_45=Configurações: Espaçador de título para abas no navegador
hive_var_exp_46=Configurações: Mostrar erros PHP no site? (1/0)
hive_var_exp_47=Configurações: Array serializado com módulos PHP necessários, se não existirem, erro será exibido (exemplo: array("mysqli", "mbstring", "gd"))
hive_var_exp_48=Configurações: Parar e mostrar erros MySQL na página se ocorrerem? (Sempre será registrado na tabela x_log_mysql!) (1/0)
hive_var_exp_49=Configurações: 1 - Usar URLs SEO | 0 - Não usar URLs SEO
hive_var_exp_50=Configurações: Necessário apenas se _HIVE_URL_SEO_ == falso [Nome para variáveis de localização no array serializado]
hive_var_exp_51=Configuração de e-mail: Senha SMTP
hive_var_exp_52=Configuração de e-mail: Nome de usuário SMTP
hive_var_exp_53=Configuração de e-mail: Autenticação SMTP (ssl/tls/falso)
hive_var_exp_54=Configuração de e-mail: Porta SMTP
hive_var_exp_55=Configuração de e-mail: Host SMTP
hive_var_exp_56=Configuração de e-mail: Modo de depuração de e-mail (0, 1, 2, 3) - Use 0 para produção, pois isso gerará saída de depuração no site!
hive_var_exp_57=Configuração de e-mail: Permitir conexões SSL inseguras? (1/0)
hive_var_exp_58=Configuração de e-mail: Todos os e-mails enviados como HTML? (1/0)
hive_var_exp_59=Configuração de e-mail: Nome do remetente padrão
hive_var_exp_60=Configuração de e-mail: Endereço de e-mail do remetente padrão
hive_var_exp_61=Configuração de e-mail: Rodapé padrão para e-mails
hive_var_exp_62=Configuração de e-mail: Cabeçalho padrão para e-mails


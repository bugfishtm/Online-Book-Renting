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
string_email=メールアドレス
string_password=パスワード
string_login=ログイン
string_register=登録
string_close=閉じる
string_error=エラー

# Page - Actions
hive_login_changelanguage=言語を変更できます
hive_login_changelanguage_here=こちら.
hive_login_lostpass=パスワードを忘れましたか？
hive_login_notregistered=まだ登録していませんか？
hive_login_rememberme=クッキーを使用しますか？
hive_login_recoveraccount=アカウントを回復
hive_login_haveaccount=既にアカウントをお持ちですか？
hive_login_password_confirm=パスワードの確認
hive_login_mc_change_mail=メールアドレスを変更
hive_login_mc_backtohome=ホームに戻る
hive_login_title_accactivation=アカウントの有効化
hive_cannotenterwhilenologin=ログインしていない場合、このページにアクセスできません！
hive_cannotenterwhilelogin=ログイン中はこのページにアクセスできません！
hive_cannotoperatesiteerror=このサイトモジュールで重大なエラーが発生しているため、現在は操作を実行できません！
hive_login_backtologin=ログインページに戻る
hive_login_change_Lang=言語を変更
hive_login_language_changed=言語が変更されました！

# Login Events - General
hive_login_msg_l_wrong=パスワード/メールアドレスの組み合わせが間違っています。
hive_login_msg_csrf=フォームの有効期限が切れました。もう一度お試しください。
hive_login_msg_empty=必要な情報を入力してください！
hive_login_msg_ipban=現在、あなたのIPはブロックされています。後でもう一度お試しください。
hive_login_msg_logout=ログアウトしました！
hive_login_msg_nomatchpass=確認用パスワードが入力したパスワードと一致しません。
hive_login_doremember=パスワードを記憶しますか？

# Login Events - Login
hive_login_msg_l_ok=ログインに成功しました。
hive_login_msg_l_blocked=アカウントがブロックされているため、ログインできません。
hive_login_msg_l_inactive=ユーザーアカウントはまだ有効化されていません！アカウントを有効化するには、パスワードを回復するか、受信した有効化メールのURLをクリックしてください！
hive_login_msg_l_blockedpwf=パスワードを何度も間違えたため、アカウントがブロックされました！
hive_login_msg_l_disabled=ユーザーアカウントは無効化されています！
hive_login_mail_serror=メールの送信中にエラーが発生しました。この内部エラーは調査が必要であり、当サイトのスタッフに報告してください。
hive_login_msg_register_ok=新しいアカウントを有効化するには、メール受信箱を確認してください！
hive_login_msg_passfiltererror=入力されたパスワードがパスワード規則を満たしていません！
hive_login_msg_mailexist=既に存在するメールアドレスでアカウントを登録しようとしています！
hive_login_password_rules=パスワード規則
hive_login_password_sign=必須文字：
hive_login_password_cap=必須大文字：
hive_login_password_small=必須小文字：
hive_login_password_special=必須特殊文字：
hive_login_password_numeric=必須数字：

# Login Events - Mail Change
hive_login_msg_m_ok=新しいメールアドレスが正常に有効化されました！
hive_login_msg_m_er=新しいメールアドレスを有効化中にエラーが発生しました。再試行してください。
hive_login_msg_m_exp=メール有効化コードの有効期限が切れました！メール変更を再試行してください！
hive_login_msg_m_res=有効化しようとしたメールアドレスは既に他のアカウントで使用されているため、あなたのアカウントには関連付けられません！
hive_login_msg_m_block=アカウントがメール変更をブロックされています！
hive_login_msg_m_noadr=リクエストに失敗しました。後でもう一度お試しください。
hive_login_mc_cmailtext=現在のメールアドレスは：
hive_login_msg_rec_ok=新しいメールアドレスを有効化するには、その受信箱を確認してください。
hive_login_msg_rec_err=メールアドレスの変更中にエラーが発生しました。
hive_login_msg_rec_wait=メール変更には120分の間隔を空ける必要があります！
hive_login_msg_rec_exist=変更しようとしているメールアドレスは既に別のユーザーアカウントで使用されています！
hive_login_msg_rec_block=アカウントがメール変更をブロックされています！
hive_login_msg_rec_disable=無効なアカウントのメールアドレスは変更できません！

# Login Mails
hive_login_mail_pre_change=新しいメールを有効化するには、こちらをクリック： <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_change=新しいメールアドレスを有効化
hive_login_mail_title_register=新しいアカウントを有効化
hive_login_mail_pre_register=アカウントを有効化するには、以下のリンクをクリックしてください： <a href="SF_ACTION_URL">SF_ACTION_URL</a>
hive_login_mail_title_rec=アカウントを回復
hive_login_mail_pre_rec=アカウントパスワードを回復するには、以下のリンクをクリックしてください： <a href="SF_ACTION_URL">SF_ACTION_URL</a>

# Login - Activation
hive_login_msg_a_ok=アカウントを正常に有効化しました！このサイトのログインページでログインできます。
hive_login_msg_a_er=ユーザーアカウントの有効化中にエラーが発生しました。パスワードを回復するか、新しいアカウントを登録してください。
hive_login_msg_a_exp=有効化トークンが無効です。アカウントを有効化するには、ログインページでアカウントを回復してください！
hive_login_msg_a_block=アカウントの有効化が無効化されています。後でもう一度お試しください！

# Login - Recover Request
hive_login_msg_rr_recnewunk=提供されたメールアドレスは登録されていません。
hive_login_msg_rr_recnope=アカウントにはパスワードを回復する権限がありません！
hive_login_msg_rr_recnopede=アカウントが無効化されているため、新しいリクエストを行うことができません！
hive_login_msg_rr_recwait=新しい回復リクエストを開始するには、120分の間隔を空ける必要があります！
hive_login_msg_rr_recnok=パスワードリセットメールを受信箱で確認してください。このメールにはパスワードを回復するためのリンクが含まれています。
hive_login_msg_recfr_ok=パスワード回復リンクを取得するには、メール受信箱を確認してください！

# Login - Recover Execute
hive_login_msg_pwtexpire=このパスワード回復トークンの有効期限が切れました！アカウント回復を再試行してください。
hive_login_msg_recexecerror=パスワード回復中にエラーが発生しました。もう一度お試しください。
hive_login_msg_recexecok=パスワードを正常に回復しました。新しいパスワードでログインできます。

##########################################################################################
## Setupable Constant Explanations
##########################################################################################

hive_var_exp_1=テーマ: ダイナミックテーマカラーのデフォルトカラー
hive_var_exp_2=テーマ: 有効なテーマのシリアライズされた配列
hive_var_exp_3=テーマ: デフォルトで使用されるテーマ
hive_var_exp_4=言語: 有効な言語のシリアライズされた配列
hive_var_exp_5=言語: デフォルト言語の配列
hive_var_exp_6=アクション: 一般登録フォームを有効にするか？ (1=オン/0=オフ)
hive_var_exp_7=まだ説明がありません。
hive_var_exp_8=アクション: 一般回復フォームを有効にするか？ (1=オン/0=オフ)
hive_var_exp_9=アクション: 一般有効化フォームを有効にするか？ (1=オン/0=オフ)
hive_var_exp_10=一般ログインフォームを有効にするか？ (1=オン/0=オフ)
hive_var_exp_11=TinyMCE: プラグイン設定文字列
hive_var_exp_12=TinyMCE: メニューバー設定文字列
hive_var_exp_13=TinyMCE: ツールバー設定文字列
hive_var_exp_14=ユーザー設定: セッション/クッキーが有効な最大日数
hive_var_exp_15=ユーザー設定: 有効化メールのトークンが有効な分数
hive_var_exp_16=ユーザー設定: X回ログイン失敗後にユーザーをブロック (0に設定すると無効化)
hive_var_exp_17=ユーザー設定: リクエスト間でユーザーが待機する必要のある分数 (アンチフラッド)
hive_var_exp_18=ユーザー設定: 古いセッションを記録しますか？ (ログイン、回復、有効化、メール変更) (1=オン/0=オフ)
hive_var_exp_19=ユーザー設定: データベースにユーザーのIPを記録しますか？ (1=オン/0=オフ)
hive_var_exp_20=ユーザー設定: 1 - ユーザーが正常にログイン後に回復キーを削除 | 0 - キーを保持
hive_var_exp_21=ユーザー設定: 1 - 複数ログインを許可 | 0 - 複数ログインを無効化
hive_var_exp_22=パスワードフィルター: 最小文字数
hive_var_exp_23=パスワードフィルター: 最小大文字数
hive_var_exp_24=パスワードフィルター: 最小小文字数
hive_var_exp_25=パスワードフィルター: 最小特殊文字数
hive_var_exp_26=パスワードフィルター: 最小数字数
hive_var_exp_27=初期作成されたユーザー名
hive_var_exp_28=初期作成されたユーザーパスワード
hive_var_exp_29=キャプチャ: 画像の高さ
hive_var_exp_30=キャプチャ: 画像の幅
hive_var_exp_31=キャプチャ: キャプチャ用カラー (オプション、0で無効化可)
hive_var_exp_32=キャプチャ: フォント (0の場合デフォルトフォントが使用されます)
hive_var_exp_33=Redis: 有効化? 1/0
hive_var_exp_34=Redis: ホスト
hive_var_exp_35=Redis: ポート
hive_var_exp_36=アップデーター: このサイトのアップデータのタイトル
hive_var_exp_37=アップデーター: 更新に必要なコード？ (0で無効化可)
hive_var_exp_38=設定: CURLクラスのリクエストを記録？ (1/0)
hive_var_exp_39=設定: X回の失敗後にIPをブロック (0に設定すると無効化)
hive_var_exp_40=設定: リファラーを記録？ (1/0)
hive_var_exp_41=設定: デフォルトCSRFコードの有効時間 (秒)
hive_var_exp_42=設定: 1 - コマンドラインからのCronjob実行のみ許可 | 0 - ブラウザでのCronjob実行を許可
hive_var_exp_43=設定: Javascriptデバッグエラーログを有効化 (1/0)
hive_var_exp_44=設定: タブやその他用のウェブサイトタイトル
hive_var_exp_45=設定: ブラウザタブ用のタイトルスペーサー
hive_var_exp_46=設定: ウェブサイト上でPHPエラーを表示？ (1/0)
hive_var_exp_47=設定: 必要なPHPモジュールのシリアライズされた配列 (例: array("mysqli", "mbstring", "gd")) が存在しない場合エラーを表示
hive_var_exp_48=設定: 発生した場合、ページ上でMySQLエラーを停止して表示しますか？ (常にx_log_mysqlテーブルに記録されます) (1/0)
hive_var_exp_49=設定: 1 - SEO URLを使用 | 0 - SEO URLを使用しない
hive_var_exp_50=設定: _HIVE_URL_SEO_ がfalseの場合にのみ必要 [シリアライズされた配列内のGETロケーション変数名]
hive_var_exp_51=メール設定: SMTPパスワード
hive_var_exp_52=メール設定: SMTPユーザー名
hive_var_exp_53=メール設定: SMTP認証 (ssl/tls/false)
hive_var_exp_54=メール設定: SMTPポート
hive_var_exp_55=メール設定: SMTPホスト
hive_var_exp_56=メール設定: メールデバッグモード (0, 1, 2, 3) - サイト上にデバッグ出力を表示しないために0を使用してください！
hive_var_exp_57=メール設定: 安全でないSSL接続を許可しますか？ (1/0)
hive_var_exp_58=メール設定: すべてのメールをHTMLとして送信しますか？ (1/0)
hive_var_exp_59=メール設定: デフォルトの送信者名
hive_var_exp_60=メール設定: デフォルトの送信者アドレス
hive_var_exp_61=メール設定: メールのデフォルトフッター
hive_var_exp_62=メール設定: メールのデフォルトヘッダー

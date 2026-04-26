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
be_404_2=エラー404
be_404_1=要求されたコンテンツは存在しません！
be_401_2=アクセス拒否
be_401_1=このエリアにアクセスする権限がありません！
b_permissions=権限

## Popups
be_edit_abort=操作を中止するにはここをクリックしてください！
be_list_h_exec_flush=このテーブルのすべての項目が削除されました！
be_list_h_btn_flush_rly=本当にこのテーブルをフラッシュしますか？これにより、関連するデータベーステーブルが再初期化され、古いエントリーがすべて削除されます！
be_list_h_btn_flush=テーブルをフラッシュ
be_cbanner_1=このウェブサイトはセッションクッキーを使用しています！
be_cbanner_2=同意します
be_pp_hide=本当にこの項目を公開書籍リストから非表示にしますか？
be_pp_unhide=本当にこの項目を公開書籍リストに表示しますか？
be_pp_delbook=本当にこの本を削除しますか？関連するすべての情報とログが削除されます。
be_pp_errimage=有効なjpgファイルを選択してください！
be_pp_errimage1=ファイルがアップロードされていないか、アップロード中にエラーが発生しました。
be_pp_errimage2=アップロードされたファイルの移動中にエラーが発生しました。
be_pp_errimage3=無効なファイルタイプです。JPGファイルのみが許可されています。
be_pp_sapi=これにより、現在の書籍情報がopenLibraryから取得した情報で上書きされます。表紙画像も置き換えられます！
be_pp_sapierr=openLibrary APIとの通信中にエラーが発生しました！
be_pp_sr1=本当にこの書籍項目を削除しますか？
be_pp_sr2=この本は在庫に戻り、返却されましたか？
be_pp_sr3=openLibrary APIとの通信中にエラーが発生しました！

## Permissions
be_tperm_page_deadlines=期限の管理
be_dperm_page_deadlines=ユーザーに本を貸し出し、期限を管理できます。
be_tperm_page_books=書籍の管理
be_dperm_page_books=書籍ページとその機能へのアクセス、書籍の作成、編集、削除が可能です。
be_tperm_page_tag=タグの管理
be_dperm_page_tag=書籍タグページとその機能へのアクセス、タグの作成、編集、削除が可能です。
be_tperm_page_user=ユーザーの管理
be_dperm_page_user=ユーザーページとその機能へのアクセス、ユーザーの作成、すべてのユーザーの閲覧/管理が可能です。
be_tperm_page_blacklist=ブラックリストの管理
be_dperm_page_blacklist=IPブラックリストページとその機能へのアクセスが可能です。
be_tperm_page_logging=ログの管理
be_dperm_page_logging=ログページとその機能へのアクセスが可能です。
be_tperm_page_settings=設定の管理
be_dperm_page_settings=設定ページとその機能へのアクセスが可能です。

## Events 
be_list_exec_idel=項目が削除されました！
be_list_exec_iedit=項目が変更されました！
be_usr_ad_herem=必要なデータを入力する必要があります！
be_usr_ad_hmailex=そのメールアドレスを持つ別のユーザーが既に存在します！このユーザーには別のメールアドレスを選択してください。
be_usr_ad_hmaok=ユーザーが作成されました！
be_str_item_created=項目が作成されました


############################################################################################################################################1

## List Headers 
be_list_h_date=日付
be_list_h_id=ID
be_list_h_ttype=タイプ
be_list_h_ref=参照
be_list_h_detail=詳細
be_list_h_ar=到着
be_list_h_url=URL
be_list_h_site=サイト
be_list_h_err=エラー
be_list_h_rece=受信者
be_list_h_content=内容
be_list_h_time=時間
be_list_h_ip=IP
be_list_h_fails=失敗
be_list_h_delete=削除
be_user_area_adr=住所
be_user_area_mail=Eメール
be_usr_ad_hmail=メール

## Navigation
be_deadlines=期限
be_profile=プロフィール
be_logout=ログアウト
be_tag=タグ
be_books=書籍
be_privacy=プライバシー
be_impressum=インプレッサム
be_settings=設定
be_blacklist=ブラックリスト
be_logging=ログ
be_user=ユーザー
be_myprofile=マイプロフィール
be_login=ログイン

## Tag Area
be_tag_raw=タグ
be_tag_rawn=タグ名
be_tag_add=タグを追加
be_tag_edit=タグを編集
be_tag_chdele=本当にこのタグを削除しますか？
be_tag_exp=ここでタグを管理できます。タグは書籍に割り当てることができます。

## Blacklist Area
be_exp_blacklist=ブロックされたIPアドレスがここに表示されます。これらのIPアドレスはこのウェブサイトにログインしたり、認証された操作を実行したりすることはできません。

## Logging Area
be_exp_logging=ここでシステム内のアクティビティの記録を確認できます。

############################################################################################################################################2

## Book Area
be_book_add=書籍を追加
be_booked_isbn=ISBN
be_booked_title=タイトル
be_booked_autor=著者
be_booked_descr=説明
be_booked_lang=言語
be_booked_released=発売日
be_booked_type=タイプ
be_booked_pub=出版社
be_vb_header_log=ログ
be_vb_header_rentc=数量
be_vb_header_ima=表紙
be_vb_header_det=詳細

## Deadline Area
be_deadline_raw=期限
be_deadline_exp=ここで未返却の書籍と返却期限を確認できます。
be_table_header_book=書籍
be_table_header_barcode=バーコード
be_table_header_duedate=返却期限

# Profile Area
b_prof_pwinfo=ここでログインパスワードを変更できます。
b_prof_mailinfo=ここでログインEメールを変更できます。

## User Area
be_password_filter_setup=パスワードは以下の基準を満たす必要があります：<br />- 10文字以上<br />- 少なくとも1つの大文字<br />- 少なくとも1つの小文字<br />- 少なくとも1つの数字


############################################################################################################################################3

be_yes=はい
be_no=いいえ
b_in_time=時間内
b_overdue=期限超過
b_today_return=今日返却
b_view=表示
be_table_header_returndate=返却日
b_active=アクティブ
b_inactive=非アクティブ
b_edit=編集
b_action=アクション
b_delete=削除
be_close=閉じる
be_cancel=キャンセル
b_description=説明
be_list=リスト
be_none=なし
be_help=ヘルプ
be_explanation=説明
b_nosslval=SSL検証なし
b_sslval=SSL検証強制
b_low=低
b_medium=中
b_high=高
b_apirequest=APIと同期
b_barcode=バーコード
b_add=追加
b_nolistcurrent=現在このリストにアイテムはありません！
b_backtolist=リストに戻る
b_hide=非表示
b_unhide=表示
be_profile=プロフィール
b_creation=作成
b_lastmodification=最終更新
b_firstname=名
b_lastname=姓
b_street=住所
b_postcode=郵便番号
b_country=国
b_changeimage=画像を変更
b_password=パスワード
b_change_password=パスワードを変更
b_email=メールアドレス
b_change_email=メールアドレスを変更
b_status=ステータス
b_id=ID
b_tags=タグ
b_thisitemcurhiddenlist=このアイテムは現在公開リストで非表示になっています！
b_nobooktitlelist=不明なタイトル
b_hidden=非表示
b_lend=貸出
b_return=返却
b_hardback=ハードカバー
b_paperback=ペーパーバック
b_softcover=ソフトカバー
b_bookcurrentlyrented=この本は現在他のユーザーに予約されており、まもなく利用可能になります！
b_available=利用可能
b_reserved=予約済み
b_user=ユーザー
b_until=まで
b_returndate=返却日
b_note=メモ
b_lendtouser=ユーザーに貸出
b_changefavicon=ファビコンを変更
b_settings_exp_string=このページでウェブサイトの機能を制御できます。
b_tel=電話番号
be_pp_sr1ssd=本は返却されましたか？
be_error_booknoexists=閲覧しようとした本は存在しません！
be_error_usernoexists=閲覧しようとしたユーザーは存在しません！
be_puser_chdele3=ユーザーを有効化
b_prof_pwinfoadd=管理者として、アクティベーションなしでユーザーのメールを変更できます


############################################################################################################################################4

be_about_core_info=CMSバージョン
be_about_fw_info=フレームワークバージョン
be_about_site_info=モジュールバージョン
be_set_header_general=一般設定
be_set_header_mail=メール設定
be_set_header_trans=翻訳設定
be_set_header_about=システム情報
be_string_key=キー
be_string_language=言語
be_string_translation=翻訳
be_trans_current_active=デフォルト翻訳
be_trans_current_ovr=翻訳オーバーライド
be_trans_button_create=翻訳を作成
be_trans_button_edit=翻訳を編集
be_trans_dlrly=本当にこの翻訳を削除しますか？
be_eexps_hivetitle=このウェブサイトのタイトル
be_eexps_imp=あなたの発行者情報テキスト
be_eexps_pry=あなたのプライバシーテキスト
be_eexps_expiretoken=メールトークンが特定の分数後に期限切れになります
be_eexps_expireip=ブラックリスト登録前のIP失敗制限
be_eexps_expirecsrf=CSRFキーが期限切れになるまでの有効秒数
be_eexps_expireact=ユーザーがパスワード回復/メール変更リクエストの間に待つ必要がある分数
be_eexps_upgc=オンサイトアップデーターをアクセスコードで保護する
be_eexps_actmc=ユーザーが自分のメールアドレスを変更できるようにする
be_eexps_actrec=ユーザーがパスワードを回復できるようにする
be_eexps_actreg=ゲストがこのウェブサイトに登録できるようにする
be_eexps_actdeflang=独自の言語を設定していないゲスト用のデフォルト言語
be_eexps_trapage=このセクションでは、デフォルトの翻訳を確認し、必要に応じてオーバーライドできます
be_eexpm_user=メールサーバーのユーザー名
be_eexpm_pass=メールサーバーのパスワード
be_eexpm_host=SMTPホスト名
be_eexpm_port=SMTPポート
be_eexpm_auth=SMTP認証方法
be_eexpm_sm=送信メールの送信者メールアドレス
be_eexpm_sn=送信メールの送信者名
be_eexpm_mh=デフォルトのメールヘッダー
be_eexpm_debug=メール送信中に問題が発生した場合、ここでデバッグを有効にできます - この場合、送信操作ごとにデバッグ情報が画面に表示されます（成功した場合も含む）
be_eexpm_ins=安全でないSMTP接続を許可する
be_eexpm_mf=デフォルトのメールフッター
obr_inp_title=タイトル
obr_inp_autor=著者
obr_inp_publisher=出版社
obr_inp_isbn=ISBN
obr_inp_lang=言語
obr_inp_tags=タグ
be_obr_li_id=書籍ID
be_obr_li_book_title=タイトル
be_obr_li_book_autor=著者
be_obr_li_book_type=書籍タイプ
be_obr_li_book_publisher=出版社
be_obr_li_book_isbn=ISBN
be_obr_li_book_lang=言語
be_obr_li_book_tag_array=リンクされたカテゴリー
be_obr_li_book_creation=作成日
be_obr_li_book_modification=修正日
be_obr_update_book=ISBNで書籍データを取得
be_obr_delete_book=書籍を削除
be_obr_add_stock=貸出可能アイテム
obr_book_item_list=貸出可能アイテムリスト
be_op_usr_622=ユーザーが編集されました


############################################################################################################################################5

string_add=追加
be_exp_usrlst=ここでユーザーを管理および作成できます。
be_user_area_usrname=名前
be_opok=アクティベーションをリクエストしたため、このサイトが表示されています。<br/>詳細については、右上隅のイベントボックスをご覧ください。
be_operr=エラー
be_str_item_createderr=APIトークンを作成できませんでした。これは主に、関連するサイトモジュールに対してこのトークンがすでに存在する場合に発生します！
be_mail_template_edit=メールテンプレートの編集
be_mail_exp_recover=登録ユーザーのパスワード回復用メールテンプレート。このテンプレートは、ユーザーが「パスワードを忘れた」機能を通じて新しいパスワードをリクエストした際に送信されます。ユーザーにリンクを提供するための置換が設定されています。簡単な置換 _ACTION_URL_ を使用します。
be_mail_exp_mchange=登録ユーザーのメール変更用メールテンプレート。このテンプレートは、ユーザーが主要メールアドレスを変更した場合、または一般的に変更された場合に送信されます。新しいメールをアクティベートし確認するためのリンクをユーザーに提供するための置換が設定されています。アクティベーションURLには簡単な置換 _ACTION_URL_ を使用します。
be_mail_exp_acti=登録ユーザーのアクティベーション用メールテンプレート。このテンプレートは、ユーザーまたは会社の従業員が作成された際に送信されます。ユーザーにリンクを提供するための置換が設定されています。新しいアカウントをアクティベートするには簡単な置換 _ACTION_URL_ を使用します。ユーザーはアカウントをアクティベートするためにパスワードを回復することもできます。
be_se_key_mch=メールアクティベートキー
b_permission=権限
be_user_area_name=ユーザー管理
be_user_area_create=ユーザーの追加
be_usr_ad_errgm=ユーザーは作成されましたが、アクティベーションメールの送信中にエラーが発生しました！
be_noti_user_crea=ユーザーがアカウントを確認していない状態で、別のユーザーが同じメールアドレスでサインアップしようとすると、最初の未確認ユーザーが削除される可能性があることにご注意ください。これはデータ損失につながる可能性があります。システムによるユーザーの削除を望まない場合は、常に確認済みのユーザーで作業していることを確認してください。ユーザーの確認を解除する機能は使用しないでください。これもデータ損失につながる可能性があります。
be_usr_ad_errg=ユーザーの作成中にエラーが発生しました。
be_usr_ad_hpasserem=選択されたパスワードは推奨事項に適合していません！
be_usr_ad_hpass=パスワード
be_usr_ad_h=アクティベーション手順
be_usr_ad_rec=メールアクティベーションをリクエストし、ユーザーに自身でパスワードを設定させる
be_usr_ad_act=メールによるアクティベーションのみをリクエスト
be_usr_ad_ok=アクティベーション手順なしでこのユーザーをアクティベートする
be_puser_noview=このユーザーは存在しません！
be_puser_cpass=パスワードの変更
be_puser_cpass1=パスワードの確認
be_puser_cpass2=新しいパスワード
be_puser_cper=権限の変更
be_puser_chmm=ユーザーメールの変更
be_puser_chmm1=新しいメール
be_puser_chdele=ユーザーの削除
be_puser_chdele1=ユーザー操作
be_puser_chdele7=このユーザーは現在メールで確認されていません！
be_puser_chdele8=このユーザーは現在ブロックされています！
be_puser_chdele9=このユーザーは現在無効になっています！
be_puser_chdele10=これは初期のスーパー管理者アカウントです！常にこの管理パネルへのフルアクセスを持っています！
be_puser_chdele11=このプロフィールはあなた以外のユーザーに属しています！設定を変更する際は注意してください。変更はユーザーの体験に影響を与えます！
be_puser_chdele12=新しいメールのアクティベーションを待っています:
be_puser_chdele13=操作を中止するにはここをクリックしてください。
be_puser_chdele14=メールは空にできません！
be_puser_chdele15=不明なエラー
be_puser_chdele16=このユーザーのメール変更機能は現在無効になっています！
be_puser_chdele17=このユーザーのメールを変更することは許可されていません。
be_puser_chdele18=そのメールアドレスを持つアクティブなユーザーがすでに存在します！ユーザーの重複メールは許可されていません。
be_puser_chdele19=メール変更リクエストの間に特定の待機時間が必要です：
be_puser_chdele20=分
be_puser_chdele21=新しいメールのインボックスを確認して、新しいメールをアクティベートしてください！
be_puser_chdele22=アクティベーションメールの送信中にエラーが発生しました！
be_puser_chdele23=メール変更リクエストがキャンセルされました！
be_op_usr_1=パスワードには1つの整数、1つの小文字、1つの大文字が必要です！少なくとも10文字必要です。
be_op_usr_2=パスワードは空にできません！
be_op_usr_3=パスワードが一致しません！
be_op_usr_4=パスワードが変更されました！
be_op_usr_6=ユーザー権限が変更されました！
be_op_usr_11=ユーザーが確認され、ログインできるようになりました！
be_op_usr_12=ユーザーが削除されました！
be_book_area_create=本の作成

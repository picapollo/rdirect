<?php

$lang['email_must_be_array'] = 'メールアドレス検証メソッドの引数には配列を指定してください。';
$lang['email_invalid_address'] = 'メールアドレスが不正です: %s';
$lang['email_attachment_missing'] = '添付ファイルが見つかりません: %s';
$lang['email_attachment_unreadable'] = '添付ファイルが開けません: %s';
$lang['email_no_recipients'] = '送信先メールアドレス(To, Cc, Bccのいずれか)が指定されていません。';
$lang['email_send_failure_phpmail'] = 'PHP mail()でメールを送信できません。利用中のサーバではこの方式でメールを送信できないかもしれません。';
$lang['email_send_failure_sendmail'] = 'PHP Sendmailでメールを送信できません。利用中のサーバではこの方式でメールを送信できないかもしれません。';
$lang['email_send_failure_smtp'] = 'PHP SMTPでメールを送信できません。利用中のサーバではこの方式でメールを送信できないかもしれません。';
$lang['email_sent'] = '以下のプロトコルでメッセージ送信に成功しました: %s';
$lang['email_no_socket'] = 'Sendmailへのソケットを開けません。設定を確認してください。';
$lang['email_no_hostname'] = 'SMTPホスト名が指定されていません。';
$lang['email_smtp_error'] = 'SMTPエラーが発生しました: %s';
$lang['email_no_smtp_unpw'] = 'SMTPのユーザ名とパスワードを指定してください。';
$lang['email_failed_smtp_login'] = 'AUTH LOGINコマンドの送信に失敗しました: %s';
$lang['email_smtp_auth_un'] = 'ユーザ名の認証に失敗しました: %s';
$lang['email_smtp_auth_pw'] = 'パスワードの認証に失敗しました: %s';
$lang['email_smtp_data_failure'] = 'データを送信できません: %s';
$lang['email_exit_status'] = '';
?>
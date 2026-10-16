<?php
	require('lib/lib.php');
    session_start();

    $error = [];
    $email = '';
    $password = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $recaptcha = filter_input(INPUT_POST, 'g-recaptcha-response');

        if (isset($recaptcha)) {
            $captcha = $recaptcha;
        } else {
            $captcha = '';
        }
        // シークレットキーを入れる
        $secretKey = "";
        $resp = @file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}");
        $resp_result = json_decode($resp,true);
        if(intval($resp_result["success"]) !== 1) {
            // reCAPTCHA承認失敗時の処理
            echo '失敗------------------------------';
        } else {
            // reCAPTCHA承認成功時の処理
            echo '成功---------------';
        }

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($email === '' || $password === '') {
            $error['login'] = 'blank';
        } else {
            $db = dbConnect();
            $stmt = $db->prepare('SELECT id, name, password FROM `members` WHERE email = ? limit 1;');
            if (!$stmt) {
                die($db->error);
            }
            $stmt->bind_param('s', $email);
            $result = $stmt->execute();
            if (!$result) {
                die($db->error);
            }

            $stmt->bind_result($id, $name, $hash);
            $stmt->fetch();

            if (password_verify($password, $hash)) {
                // session id の再生成
                session_regenerate_id();
                $_SESSION['id'] = $id;
                $_SESSION['name'] = $name;
		        header('Location: index.php');
                exit();
            } else {
                $error['login'] = 'failed';
            }
        }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>ログインする</title>

    <!-- reCAPTCHAapi読み込み -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<div id="wrap">
    <div id="head">
        <h1>ログインする</h1>
    </div>
    <div id="content">
        <div id="lead">
            <p>メールアドレスとパスワードを記入してログインしてください。</p>
            <p>入会手続きがまだの方はこちらからどうぞ。</p>
            <p>&raquo;<a href="join/">入会手続きをする</a></p>
        </div>
        <form action="" method="post">
            <dl>
                <dt>メールアドレス</dt>
                <dd>
                    <input type="text" name="email" size="35" maxlength="255" value="<?php echo specialChars($email); ?>"/>
                    <?php if (isset($error['login']) && $error['login'] === 'blank'): ?>
                        <p class="error">* メールアドレスとパスワードをご記入ください</p>
                    <?php endif; ?>
                    <?php if (isset($error['login']) && $error['login'] === 'failed'): ?>
                        <p class="error">* ログインに失敗しました。正しくご記入ください。</p>
                    <?php endif; ?>
                </dd>
                <dt>パスワード</dt>
                <dd>
                    <input type="password" name="password" size="35" maxlength="255" value=""/>
                </dd>
            </dl>

            <!-- formタグの内側でreCAPTHA登場場所を記述 サイトキーを入れる-->
            <div class="g-recaptcha" data-callback="onSubmit" data-sitekey=""></div>
            <div>
                <input type="submit" value="ログインする" class="submit-button" disabled/>
            </div>
        </form>
    </div>
</div>
    <script>
    function onSubmit(recaptcha) {
        if (recaptcha !== ''){
            // reCAPTHAによるチェックをしたあとは送信ボタンを押せるようにする
            $('.submit-button').removeAttr('disabled');
        }
    }
    </script>
</body>
</html>

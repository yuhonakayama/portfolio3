<!DOCTYPE html>
<html lang="ja">
<head>
    <title>確認ページ</title>
    <meta name="description" content="確認ページ">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Kristi&family=Zen+Kaku+Gothic+Antique&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poor+Story&display=swap" rel="stylesheet">
</head>
<body>
    <!-- ヘッダー -->
  <header>
    <!-- ロゴ -->
    <a href="index.html" class="title-logo">yuho design</a>

    <!-- PC用ナビゲーション -->
     <nav class="nav-pc">
      <a href="#reference-works">参考作品</a>
      <a href="#skills">スキル</a>
      <a href="#about">私について</a>
      <a href="#contact">お問い合わせ</a>
     </nav>

     <!-- スマホ用メニューボタン -->
      <img class="menu-sp" src="image/nav/menu-up.png" alt="ナビゲーションを開く" onclick="document.querySelector('.nav-sp').style.display = 'block'">

    <!-- スマホ用ナビゲーション -->
    <nav class="nav-sp">
      <img class="close" src="image/nav/close.png" alt="ナビゲーションを閉じる" onclick="document.querySelector('.nav-sp').style.display = 'none'">
      <a class="logo-sp" href="index.html" onclick="document.querySelector('.nav-sp').style.display = 'none'">yuho design</a>
      <hr>
      <a class="menu" href="#reference-works" onclick="document.querySelector('.nav-sp').style.display = 'none'">参考作品</a>
      <hr>
      <a class="menu" href="#skills" onclick="document.querySelector('.nav-sp').style.display = 'none'">スキル</a>
      <hr>
      <a class="menu" href="#about" onclick="document.querySelector('.nav-sp').style.display = 'none'">私について</a>
      <hr>
      <a class="menu" href="#contact" onclick="document.querySelector('.nav-sp').style.display = 'none'">お問い合わせ</a>
      <hr>
      <div class="nav-sns">
      <img src="image/nav/nav-sp-x.png" class="menu-sp-sns" alt="X">
      </div>
    </nav>
  
  </header>
  <main>
  <?php
    require 'vendor/autoload.php'; // 必要なライブラリを読み込み

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // POSTデータがあるか確認
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];
        $name = htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8');
        $furigana = htmlspecialchars($_POST['furigana'] ?? '', ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES, 'UTF-8');

        // バリデーション
        if (empty($name)) {
            $errors[] = "お名前を入力してください。";
        }

        if (empty($furigana)) {
            $errors[] = "フリガナを入力してください。";
        } elseif (!preg_match('/^[ァ-ンヴー\s　]+$/u', $furigana)) {
            $errors[] = "フリガナは全角カタカナで入力してください。";
        }

        if (empty($email)) {
            $errors[] = "メールアドレスを入力してください。";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "有効なメールアドレスを入力してください。";
        }

        if (empty($message)) {
            $errors[] = "お問い合わせ内容を入力してください。";
        }

        // エラーがある場合、エラーメッセージを表示
        if (!empty($errors)) {
            echo "<div style='color: red; margin-top: 15%;'>";
            foreach ($errors as $error) {
                echo "<p>" . $error . "</p>";
            }
            echo "</div>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='name' value='{$name}'>";
            echo "<input type='hidden' name='furigana' value='{$furigana}'>";
            echo "<input type='hidden' name='email' value='{$email}'>";
            echo "<input type='hidden' name='message' value='{$message}'>";
            echo "<button type='button' onclick='history.back();' style='margin: 50px;'>修正する</button>";
            echo "</form>";
        } else {
            // 確認ページ表示
            if (isset($_POST['submit']) && $_POST['submit'] === 'send') {
                try {
                    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
                    $dotenv->load();

                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = $_ENV['SMTP_HOST'];
                    $mail->SMTPAuth = true;
                    $mail->Username = $_ENV['SMTP_USER'];
                    $mail->Password = $_ENV['SMTP_PASS'];
                    $mail->SMTPSecure = $_ENV['SMTP_SECURE'];
                    $mail->Port = $_ENV['SMTP_PORT'];

                    $mail->setFrom($_ENV['SMTP_USER'], '中山友歩のポートフォリオ');
                    $mail->addAddress('info@yuhonakayama.com');

                    $mail->isHTML(true);
                    $mail->Subject = "お問い合わせ";
                    $mail->Body = "
                        <p>お名前: {$name}</p>
                        <p>ふりがな: {$furigana}</p>
                        <p>メールアドレス: {$email}</p>
                        <p>お問い合わせ内容:</p>
                        <p>{$message}</p>
                    ";
                    $mail->CharSet = 'UTF-8';

                    if ($mail->send()) {
                        echo "<p style='height: 100vh; width: 80vw; margin-top: 15%; text-align: center;'>
                                    お問い合わせありがとうございます。<br>
                                    <br>
                                    内容を確認の上、通常2～3営業日以内にご返信させていただきます。<br>
                                    <br>
                                    万が一、返信がない場合は迷惑メールフォルダをご確認いただくか、再度お問い合わせください。</p>";
                    } else {
                        echo "<p style='height: 100vh; width: 80vw; margin-top: 15%; text-align: center;'>
                                    メールの送信に失敗しました。<br>
                                    <br>
                                    恐れ入りますが、もう一度お試しいただくか、しばらく時間を置いて再送信してください。</p>";
                    }
                } catch (Exception $e) {
                    echo "<p style='height: 100vh; width: 80vw; margin-top: 15%; text-align: center;'>
                                    エラーが発生しました<br>
                                    <br>
                                    : " . $e->getMessage() . "</p>";
                }
            } else {
                // 確認ページ表示
    ?>
            <section id="confirmation" style="height: 100vh; width: 600px; margin-top: 10%;">
                <h2 style="font-size: 2rem">以下の内容でよろしいでしょうか？</h2>
                <br>
                <p>お名前：<?php echo $name; ?></p>
                <br>
                <p>ふりがな：<?php echo $furigana; ?></p>
                <br>
                <p>メールアドレス：<?php echo $email; ?></p>
                <br>
                <p>お問い合わせ内容：<?php echo nl2br($message); ?></p>
                <br>
                <form method="POST">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="furigana" value="<?php echo $furigana; ?>">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <input type="hidden" name="message" value="<?php echo $message; ?>">
                    <div style="display: flex; justify-content: center;">
                        <button type="submit" name="submit" value="send" style="margin: 10px;">送信する</button>
                        <button type="button" onclick="history.back();" style="margin: 10px;">修正する</button>
                    </div> 
                </form>
            </section>
            <?php
        }
    }
} else {
    echo "<p>不正なアクセスです。</p>";
}
?>

  </main>
</body>
</html>

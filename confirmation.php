<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>確認ページと送信処理</title>
</head>
<body>
<?php
require 'vendor/autoload.php'; // 必要なライブラリを読み込み

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// POSTデータがあるか確認
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit']) && $_POST['submit'] === 'send') {
        // 送信処理
        $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
        $furigana = htmlspecialchars($_POST['furigana'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $message = nl2br(htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8'));

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
                echo "<p>メールが送信されました。</p>";
            } else {
                echo "<p>メールの送信に失敗しました。</p>";
            }
        } catch (Exception $e) {
            echo "<p>エラーが発生しました: " . $e->getMessage() . "</p>";
        }
    } else {
        // 確認ページ表示
        $name = htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8');
        $furigana = htmlspecialchars($_POST['furigana'] ?? '', ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES, 'UTF-8');
?>
        <h2>以下の内容でよろしいでしょうか？</h2>
        <p>お名前：<?php echo $name; ?></p>
        <p>ふりがな：<?php echo $furigana; ?></p>
        <p>メールアドレス：<?php echo $email; ?></p>
        <p>お問い合わせ内容：<?php echo nl2br($message); ?></p>
        <form method="POST">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="furigana" value="<?php echo $furigana; ?>">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="message" value="<?php echo $message; ?>">
            <button type="submit" name="submit" value="send">送信する</button>
            <button type="button" onclick="history.back();">修正する</button>
        </form>
<?php
    }
} else {
    echo "<p>不正なアクセスです。</p>";
}
?>
</body>
</html>

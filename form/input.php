<?php

session_start();

require "validation.php";

header("X-FRAME-OPTIONS: DENY");

if (!empty($_POST)) {

    echo "<pre>";

    var_dump($_POST);

    echo "</pre>";
}


function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

$errors = validation($_POST);

$pageFlag = 0;

if (!empty($_POST["btn_confirm"]) && empty($errors)) {
    $pageFlag = 1;
}

if (!empty($_POST["btn_submit"])) {
    $pageFlag = 2;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php if ($pageFlag === 0) : ?>
        <?php
        if (!isset($_SESSION['csrfToken'])) {
            $csrfToken = bin2hex(random_bytes(32));
            $_SESSION['csrfToken'] = $csrfToken;
        }
        $token = $_SESSION['csrfToken'];
        ?>

        <?php if (!empty($errors) && !empty($_POST["btn_confirm"])) : ?>
            <ul>
                <?php
                foreach ($errors as $error) echo '<li>' . $error . '</li>';
                ?>
            </ul>

        <?php endif; ?>

        <form method="POST" action="input.php">
            <label for="your_name">氏名</label>
            <input type="text" name="your_name" value="<?php if (!empty($_POST['your_name'])) echo h($_POST['your_name']); ?>" id="your_name">

            <br>

            <label for="email">メールアドレス</label>
            <input type="email" name="email" value="<?php if (!empty($_POST['email'])) echo h($_POST['email']); ?>" id="email">

            <br>

            <label for="url">ホームページ</label>
            <input type="url" name="url" value="<?php if (!empty($_POST['url'])) echo h($_POST['url']); ?>" id="url">

            <br>
            <label for="gender">性別</label>
            <input type="radio" name="gender" value="0" id="gender" <?php if (isset($_POST['gender']) && $_POST['gender'] === "0") echo "checked"; ?>>男性
            <input type="radio" name="gender" value="1" id="gender" <?php if (!empty($_POST['gender']) && $_POST['gender'] === "1") echo "checked"; ?>>女性

            <br>
            <label for="age">年齢</label>
            <select name="age">
                <option value="">選択してください</option>
                <option value="1">~19</option>
                <option value="2">20~29</option>
                <option value="3">30~39</option>
                <option value="4">40~49</option>
                <option value="5">50~59</option>
            </select>
            <br>
            <label for="contact">お問い合わせ内容</label>
            <textarea type="text" name="contact" id="contact">
                <?php if (!empty($_POST['contact'])) echo h($_POST['contact']); ?>
            </textarea>
            <br>

            <input type="checkbox" name="caution" value="1">注意事項にチェックする
            <br>


            <input type="submit" name="btn_confirm" value="確認する">
            <input type="hidden" name="csrf" value="<?php echo $token; ?>">

        </form>

    <?php endif; ?>

    <?php
    if ($pageFlag === 1) : ?>
        <?php if ($_POST["csrf"] === $_SESSION['csrfToken']) : ?>
            <form method="POST" action="input.php">
                <label for="your_name">氏名</label>
                <?php echo h($_POST['your_name']); ?>
                <br>

                <label for="email">メールアドレス</label>
                <?php echo h($_POST['email']); ?>

                <br>

                <label for="url">ホームページ</label>
                <?php echo h($_POST['url']); ?>

                <br>

                <label for="gender">性別</label>
                <?php if ($_POST['gender'] === "0") echo "男性"; ?>
                <?php if ($_POST['gender'] === "1") echo "女性"; ?>

                <br>

                <label for="age">年齢</label>
                <?php if ($_POST['age'] === "1") echo "~19"; ?>
                <?php if ($_POST['age'] === "2") echo "20~29"; ?>
                <?php if ($_POST['age'] === "3") echo "30~39"; ?>
                <?php if ($_POST['age'] === "4") echo "40~49"; ?>
                <?php if ($_POST['age'] === "5") echo "50~59"; ?>

                <br>

                <label for="email">お問い合わせ内容</label>
                <?php echo h($_POST['contact']); ?>

                <br>

                <input type="submit" name="btn_submit" value="送信する">
                <input type="submit" name="btn_return" value="戻る">
                <input type="hidden" name="your_name" value="<?php echo h($_POST['your_name']) ?>">
                <input type="hidden" name="email" value="<?php echo h($_POST['email']) ?>">
                <input type="hidden" name="url" value="<?php echo h($_POST['url']) ?>">
                <input type="hidden" name="age" value="<?php echo h($_POST['age']) ?>">
                <input type="hidden" name="gender" value="<?php echo h($_POST['gender']) ?>">
                <input type="hidden" name="contact" value="<?php echo h($_POST['contact']) ?>">
                <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']) ?>">
            </form>


        <?php endif; ?>
    <?php endif; ?>

    <?php
    if ($pageFlag === 2) : ?>
        <?php if ($_POST["csrf"] === $_SESSION['csrfToken']) : ?>

            <p>送信が完了しました。</p>

            <?php unset($_SESSION["csrfToken"]) ?>
        <?php endif; ?>
    <?php endif; ?>


</body>

</html>
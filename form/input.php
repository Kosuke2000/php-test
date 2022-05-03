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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form method="POST" action="input.php">
                        <div class="mb-3">
                            <label for="your_name" class="form-label">氏名</label>
                            <input type="text" name="your_name" class="form-control" value="<?php if (!empty($_POST['your_name'])) echo h($_POST['your_name']); ?>" id="your_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">メールアドレス</label>
                            <input type="text" name="email" class="form-control" value="<?php if (!empty($_POST['email'])) echo h($_POST['email']); ?>" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="url" class="form-label">ホームページ</label>
                            <input type="text" name="url" class="form-control" value="<?php if (!empty($_POST['url'])) echo h($_POST['url']); ?>" id="url">
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">性別</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="0" id="gender" <?php if (isset($_POST['gender']) && $_POST['gender'] === "0") echo "checked"; ?>>
                                <label for="gender" class="form-check-label">男性</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="1" id="gender" <?php if (!empty($_POST['gender']) && $_POST['gender'] === "1") echo "checked"; ?>>
                                <label for="gender" class="form-check-label">女性</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label">年齢</label>
                            <select name="age" class="form-select">
                                <option value="">選択してください</option>
                                <option value="1">~19</option>
                                <option value="2">20~29</option>
                                <option value="3">30~39</option>
                                <option value="4">40~49</option>
                                <option value="5">50~59</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">お問い合わせ内容</label>
                            <textarea type="text" name="contact" class="form-control" id="contact" rows="3"><?php if (!empty($_POST['contact'])) echo h($_POST['contact']); ?></textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="caution" value="1" id="caution">
                            <label class="form-check-label" for="caution">
                                注意事項にチェックする
                            </label>
                        </div>
                        <div>
                            <input class="btn btn-primary" type="submit" name="btn_confirm" value="確認する">
                            <input type="hidden" name="csrf" value="<?php echo $token; ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                <input type="hidden" name="age" value="<?php echo h($_POST['age']) ?>">
                <input type="hidden" name="contact" value="<?php echo h($_POST['contact']) ?>">
                <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']) ?>">
            </form>


        <?php endif; ?>
    <?php endif; ?>

    <?php
    if ($pageFlag === 2) : ?>
        <?php if ($_POST["csrf"] === $_SESSION['csrfToken']) : ?>
            <?php require "../mainte/insert.php";
            insertContact($_POST);
            ?>

            <p>送信が完了しました。</p>

            <?php unset($_SESSION["csrfToken"]) ?>
        <?php endif; ?>
    <?php endif; ?>



</body>

</html>

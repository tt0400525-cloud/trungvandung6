<?php
$errors = [];
$email = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = htmlspecialchars(trim($_POST["email"] ?? ""));
    $password = $_POST["password"] ?? "";

    if (empty($email)) {
        $errors["email"] = "Vui lòng nhập email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Email không đúng định dạng.";
    }

    if (empty($password)) {
        $errors["password"] = "Vui lòng nhập mật khẩu.";
    }

    if (empty($errors)) {

        // Lấy dữ liệu từ cookie
        $cookie_email = $_COOKIE["email"] ?? "";
        $cookie_password = $_COOKIE["password"] ?? "";

        // So sánh dữ liệu
        if ($email === $cookie_email && $password === $cookie_password) {

            header("Location: success.php");
            exit();

        } else {
            $errors["login"] = "Email hoặc mật khẩu không đúng.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./reset.css">
    <link rel="stylesheet" href="./style.css">
    <title>Login Page</title>
</head>

<body>
    <div class="wrapper fade-in-down">
        <div id="form-content">

            <a href="/LTW_ltvd6-main/login.php">
                <h2 class="active">Đăng nhập</h2>
            </a>
            <a href="/LTW_ltvd6-main/register.php">
                <h2 class="inactive underline-hover">Đăng ký</h2>
            </a>

            <div class="fade-in first">
                <img src="./imgs/avatar.png" id="avatar" alt="User Icon">
            </div>

            <!-- Thông báo thành công -->
            <?php if (!empty($success)): ?>
                <p style="color:green; font-weight:bold;"><?= $success ?></p>
            <?php endif; ?>
            <?php if (isset($errors["login"])): ?>
                <p style="color:red">
                    <?= $errors["login"] ?>
                </p>
            <?php endif; ?>
            <form method="POST" action="">
                <!-- Email -->
                <input type="email" name="email" placeholder="Email" value="<?= $email ?>">
                <?php if (isset($errors["email"])): ?>
                    <p style="color:red"><?= $errors["email"] ?></p>
                <?php endif; ?>

                <!-- Mật khẩu -->
                <input type="password" name="password" placeholder="Mật khẩu">
                <?php if (isset($errors["password"])): ?>
                    <p style="color:red"><?= $errors["password"] ?></p>
                <?php endif; ?>

                <input type="submit" value="Đăng nhập">

            </form>

            <div id="form-footer">
                <a class="underline-hover" href="#">Quên mật khẩu?</a>
            </div>

        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<!-- TODO
  1) Chuyển đổi register.html thành file php và chạy trên webserver để xử lý 
  form đăng ký người dùng gồm các thông tin: 
  Họ tên: Không được để trống. 
  Email: Không được để trống và phải đúng định dạng.
  Mật khẩu: Không được để trống, ít nhất 6 ký tự (strlen()).
  Xác nhận mật khẩu: Phải giống với Mật khẩu.
  gợi ý: 
    + Kiểm tra và lọc dữ liệu đầu vào để chống XSS (htmlspecialchars()).
    + có thể sử dụng filter_var hoặc preg_match để kiểm tra biến
  2) Lỗi phát sinh sẽ được đưa vào mãng $errors = [];
  ví dụ: $errors = ["username" => "Vui lòng nhập họ tên.", "email" => "Vui lòng nhập email."];
  3) Hiển thị lỗi nếu có sai sót và giữ nguyên dữ liệu đã nhập nếu có lỗi.
  Có thể hiển thị lỗi trên đầu form hoặc lỗi ngay dưới phần nhập của lỗi.
  4) Nếu đăng ký thành công, hiển thị thông báo chào mừng. Xóa trống form đăng ký.
  -->

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./reset.css" />
  <link rel="stylesheet" href="./style.css" />
  <title>Register Page</title>
</head>

<body>
  <?php

  $errors = [];
  $success = "";

  $fullname = "";
  $email = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lọc dữ liệu
    $fullname = htmlspecialchars(trim($_POST["username"] ?? ""));
    $email = htmlspecialchars(trim($_POST["email"] ?? ""));
    $password = $_POST["password"] ?? "";
    $confirm_password = $_POST["repeat-password"] ?? "";
    // Kiểm tra họ tên
    if ($fullname == "") {
      $errors["username"] = "Vui lòng nhập họ tên.";
    }
    // Kiểm tra email
    if ($email == "") {
      $errors["email"] = "Vui lòng nhập email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors["email"] = "Email không đúng định dạng.";
    }
    // Kiểm tra mật khẩu
    if ($password == "") {
      $errors["password"] = "Vui lòng nhập mật khẩu.";
    } elseif (strlen($password) < 6) {
      $errors["password"] = "Mật khẩu phải ít nhất 6 ký tự.";
    }
    // Kiểm tra xác nhận mật khẩu
    if ($confirm_password == "") {
      $errors["repeat-password"] = "Vui lòng nhập lại mật khẩu.";
    } elseif ($confirm_password != $password) {
      $errors["repeat-password"] = "Mật khẩu xác nhận không khớp.";
    }
    // Nếu không có lỗi
    if (empty($errors)) {

      // lưu cookie 1 ngày
      setcookie("username", $fullname, time() + 86400, "/");
      setcookie("email", $email, time() + 86400, "/");
      setcookie("password", $password, time() + 86400, "/");

      // chuyển sang trang login
      header("Location: /LTW_ltvd6-main/login.php");
      exit();
    }
  }
  ?>
  <?php if (isset($success))
    echo "<p style='color:green'>$success</p>"; ?>
  <?php if (isset($errors["login"]))
    echo "<p style='color:red'>{$errors["login"]}</p>"; ?>
  <div class="wrapper fade-in-down">
    <div id="form-content">
      <!-- Tabs Titles -->
      <a href="/LTW_ltvd6-main/login.php">
        <h2 class="inactive underline-hover">Đăng nhập</h2>
      </a>
      <a href="/LTW_ltvd6-main/register.php">
        <h2 class="active">Đăng ký</h2>
      </a>
      <!-- Icon -->
      <div class="fade-in first">
        <img src="./imgs/avatar.png" id="avatar" alt="User Icon" />
      </div>
      <!-- Login Form -->
      <form method="POST" action="">
        <input 
        type="text" 
        id="username" 
        class="fade-in first" 
        name="username" 
        placeholder="Họ tên" />
        <?php if (isset($errors["username"])): ?>
          <p style="color:red"><?= $errors["username"] ?></p>
        <?php endif; ?>
        <input 
        type="email" 
        id="Email" 
        class="fade-in second" 
        name="email" 
        placeholder="Email" />
        <?php if (isset($errors["email"])): ?>
          <p style="color:red"><?= $errors["email"] ?></p>
        <?php endif; ?>
        <input 
        type="password" 
        id="password" 
        class="fade-in third" 
        name="password" 
        placeholder="Mật khẩu" />
        <?php if (isset($errors["password"])): ?>
          <p style="color:red"><?= $errors["password"] ?></p>
        <?php endif; ?>
        <input 
        type="password" 
        id="repeat-password" 
        class="fade-in fourth" 
        name="repeat-password"
          placeholder="Xác nhận mật khẩu" />
        <?php if (isset($errors["repeat-password"])): ?>
          <p style="color:red"><?= $errors["repeat-password"] ?></p>
        <?php endif; ?>
        <input type="submit" class="fade-in five" value="Đăng ký" />
      </form>

      <!-- Remind Passowrd -->
      <div id="form-footer">
        <a class="underline-hover" href="#">Quên mật khẩu?</a>
      </div>
    </div>
  </div>
</body>

</html>
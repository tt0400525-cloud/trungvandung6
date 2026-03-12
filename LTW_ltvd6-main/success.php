<?php
$username = $_COOKIE["username"] ?? "User";
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập thành công</title>

    <style>
        .background {}

        body {
            margin: 0;
            font-family: Arial, sans-serif;

            background-image: url("imgs/1.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            width: 350px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 80px;
            margin-bottom: 15px;
        }

        h1 {
            color: #333;
        }

        .username {
            color: #007BFF;
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>

</head>

<body>

    <div class="card">

        <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png">

        <h1>Đăng nhập thành công 🎉</h1>

        <p>Xin chào <span class="username">
                <?= htmlspecialchars($username) ?>
            </span></p>

        <a class="btn" href="login.php">Đăng xuất</a>

    </div>

</body>

</html>
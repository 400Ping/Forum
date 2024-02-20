<html>
<head>
    <title>會員註冊</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans JP', sans-serif;
        }
    </style>
</head>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $link = @mysqli_connect('localhost', 'root', '', 'DB');
    if (!$link) {
        die("MySQL資料庫連接錯誤!<br/>");
    }

    $username = mysqli_real_escape_string($link, $_POST['帳號']);
    $password = mysqli_real_escape_string($link, $_POST['密碼']);
    $confirm_password = mysqli_real_escape_string($link, $_POST['密碼再確認']);

    if (empty($username) || empty($password) || empty($confirm_password)) {
        $_SESSION['message'] = "請填寫所有欄位。";
    } else {
        if ($password !== $confirm_password) {
            $_SESSION['message'] = "密碼不匹配。";
        } else {
            $query = "SELECT * FROM 會員資料 WHERE 帳號 = '$username'";
            $result = mysqli_query($link, $query);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['message'] = "該用戶名已被占用，請使用其他用戶名。";
            } else {
                $sql = "INSERT INTO 會員資料 (帳號, 密碼) VALUES ('$username', '$password')";
                if (mysqli_query($link, $sql)) {
                    $_SESSION['message'] = "註冊成功！";
                } else {
                    $_SESSION['message'] = "錯誤: " . mysqli_error($link);
                }
            }
        }
    }

    mysqli_close($link);

    header("Location: sign up.php");
    exit();
}
?>

<body class="bg-blue-200 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h1 class="text-4xl mb-6 text-center">會員註冊</h1>
        <h2 class="text-2xl mb-4 text-center">註冊</h2>
        <form method="post" action="">
            <label class="block mb-4">
                <span class="block text-gray-700 text-sm font-bold mb-2">帳號:</span>
                <input type="text" name="帳號" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="帳號設置">
            </label>
            <label class="block mb-4">
                <span class="block text-gray-700 text-sm font-bold mb-2">密碼:</span>
                <input type="password" name="密碼" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" placeholder="密碼設置">
            </label>
            <label class="block mb-6">
                <span class="block text-gray-700 text-sm font-bold mb-2">密碼再確認:</span>
                <input type="password" name="密碼再確認" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" placeholder="密碼再確認">
            </label>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" type="submit">
                註冊
            </button>
        </form>
		<form action="login.php" method="post" class="mt-4">
			<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">登入</button>
		</form>
		<?php
		if (isset($_SESSION['message'])) {
			echo "<p>" . $_SESSION['message'] . "</p>";
			unset($_SESSION['message']);
		}
		?>
    </div>
</body>
</html>

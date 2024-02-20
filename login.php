<html>
<head>
    <title>會員登入</title>
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

    if (empty($username) || empty($password)) {
        $_SESSION['message'] = "請填寫所有欄位。";
    } else {
        $query = "SELECT * FROM 會員資料 WHERE 帳號 = '$username' AND 密碼 = '$password'";
        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['message'] = "登入成功！";
            header("Location: index.php");
        } else {
            $_SESSION['message'] = "帳號或密碼錯誤。";
        }
    }

    mysqli_close($link);

    header("Location: index.php");
    exit();
}
?>

<body class="bg-blue-200 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h1 class="text-4xl mb-6 text-center">會員登入</h1>
        <h2 class="text-2xl mb-4 text-center">登入</h2>
        
	<form method="post">
	<div class="mb-4">
	    <span class="block text-gray-700 text-sm font-bold mb-2">帳號:</span>
		<input type="text" name="帳號" placeholder="輸入帳號" 
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2">
		<span class="block text-gray-700 text-sm font-bold mb-2">密碼:</span>
		<input type="password" name="密碼" placeholder="輸入密碼" 
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2">
	</div>
	<div class="flex justify-between gap-4">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">登入</button>
    </div>
	</form>
	<form action="sign up.php" method="post" class="mt-4">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">註冊</button>
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
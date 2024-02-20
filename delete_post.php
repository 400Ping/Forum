<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['post_id'];

    // 添加連接到數據庫的代碼
    $link = @mysqli_connect('localhost', 'root', '', 'DB');
    if (!$link) {
        die("MySQL資料庫連接錯誤!<br/>");
    }

    // 刪除文章的 SQL 查詢
    $query = "DELETE FROM questions WHERE id = '$post_id'";
    $result = mysqli_query($link, $query);

    if ($result) {
        $_SESSION['message'] = "文章已成功刪除！";
    } else {
        $_SESSION['message'] = "刪除文章時發生錯誤：" . mysqli_error($link);
    }

    mysqli_close($link);

    // 返回到原來的頁面（這取決於您的需求）
    header("Location: index.php");
    exit();
}
?>
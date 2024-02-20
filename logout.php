<!-- logout.php -->
<?php
session_start();

// 刪除所有 session 變數
session_unset();

// 刪除 session
session_destroy();

// 跳轉回首頁或其他頁面
header("Location: index.php");
exit();
?>

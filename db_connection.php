<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mywebsite";

// 創建連接
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!-- process_ask.php -->
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $link = @mysqli_connect('localhost', 'root', '', 'DB');
    if (!$link) {
        die("MySQL資料庫連接錯誤!<br/>");
    }

    $title = mysqli_real_escape_string($link, $_POST['questionTitle']);
    $content = mysqli_real_escape_string($link, $_POST['questionContent']);
    $author = mysqli_real_escape_string($link, $_POST['authorName']);

    $query = "INSERT INTO questions (title, content, author, article_count) VALUES ('$title', '$content', '$author', 1)";
    $result = mysqli_query($link, $query);

    if ($result) {
        $_SESSION['message'] = "問題已成功提交！";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['message'] = "問題提交失敗。";
        header("Location: ask_question.php");
        exit();
    }

    mysqli_close($link);
}
?>

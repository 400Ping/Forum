<!-- index.php -->
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>論壇網站</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<header class="bg-dark text-white text-center py-5">
    <div class="header-container">
        <h1>論壇網站</h1>
        <div class="header-buttons">
            <?php
            // 檢查是否有登入的帳號
            if (isset($_SESSION['username'])) {
                echo "<p class='text-white'>歡迎，" . $_SESSION['username'] . "！</p>";
                echo "<a href='logout.php' class='btn btn-primary mb-3'>登出</a>";
            } else {
                echo "<a href='login.php' class='btn btn-primary mb-3'>登入 / 註冊</a>";
            }
            ?>
        </div>
    </div>
</header>
</body>

<div class="text-center mt-3">
    <a href="index.html" class="btn btn-primary">返回首頁</a>
</div>

    <section id="forum-content" class="container mt-5">
        <h2 class="text-center mb-4">論壇內容</h2>

        <?php
        if (isset($_SESSION['message'])) {
            echo "<p>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        }
        ?>

        <a href="ask_question.php" class="btn btn-primary mb-3">來分享新問題吧</a>

        <?php
        $link = @mysqli_connect('localhost', 'root', '', 'DB');
        if (!$link) {
            die("MySQL資料庫連接錯誤!<br/>");
        }

        // 獲取文章數量
        $query = "SELECT SUM(article_count) AS total_articles FROM questions";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);
        $articleCount = $row['total_articles'];
        
        // 顯示文章數量
        echo "<p>共有 " . $articleCount . " 篇文章</p>";

        // 獲取文章列表
        $query = "SELECT q.*, m.帳號 as author FROM questions q JOIN 會員資料 m ON q.author = m.帳號 ORDER BY q.created_at DESC";
        $result = mysqli_query($link, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='card mb-3'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . htmlspecialchars($row['title']) . "</h5>";
            echo "<p class='card-text'>" . htmlspecialchars($row['content']) . "</p>";

            if (isset($_SESSION['username'])) {
                echo "<p class='card-text'><small class='text-muted'>發布者：" . $_SESSION['username'] . "</small></p>";
            }
            else {
                // 如果未登入，可以顯示匿名或其他默認信息
                echo "<p class='card-text'><small class='text-muted'>發布者：匿名</small></p>";
            }

            // 刪除文章表單
            echo "<form method='post' action='delete_post.php' class='mb-2'>";
            echo "<input type='hidden' name='post_id' value='" . $row['id'] . "'>";
            echo "<button type='submit' class='btn btn-danger btn-sm'>刪除文章</button>";
            echo "</form>";

            echo "</div>";
            echo "</div>";
        }

        mysqli_close($link);
        ?>

    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2023 張傑凱&邱高詮. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>

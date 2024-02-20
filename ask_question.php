<!-- ask_question.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask a Question</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

    <header class="bg-dark text-white text-center py-5">
        <h1>論壇網站</h1>
        <p class="lead">歡迎提問</p>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">論壇</a>
    </nav>

    <section id="ask-form" class="container mt-5">
        <h2 class="text-center mb-4">提問</h2>
        <form action="process_ask.php" method="post">
            <div class="form-group">
                <label for="questionTitle">問題標題:</label>
                <input type="text" id="questionTitle" name="questionTitle" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="questionContent">問題內容:</label>
                <textarea id="questionContent" name="questionContent" class="form-control" rows="5" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">提交問題</button>
        </form>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2023 Your Name. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>

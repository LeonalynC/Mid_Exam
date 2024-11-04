<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body { background-color: #f8f0f8; }
        .card { background-color: #ffe6f0; }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-4">
        <?php $getPostByID = getPostByID($pdo, $_GET['user_post_id']); ?>
        <h2>Are you sure you want to delete this post?</h2>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $getPostByID['title']; ?></h4>
                <p class="card-text"><?php echo $getPostByID['body']; ?></p>
                <form action="core/handleForms.php?user_post_id=<?php echo $_GET['user_post_id']; ?>" method="POST">
                    <button type="submit" name="deletePostBtn" class="btn">Delete</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
session_start();
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['viewed_posts'])) {
    $_SESSION['viewed_posts'] = [];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
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
        <?php $getUserByID = getUserByID($pdo, $_GET['user_id']); ?>
        <h3>Username: <?php echo $getUserByID['username']; ?></h3>
        <h3>First Name: <?php echo $getUserByID['first_name']; ?></h3>
        <h3>Last Name: <?php echo $getUserByID['last_name']; ?></h3>
        <h3>Date Joined: <?php echo $getUserByID['date_added']; ?></h3>
        <h3>All Posts</h3>
        <?php 
        $getAllPostsByUser = getAllPostsByUser($pdo, $_GET['user_id']); 
        foreach ($getAllPostsByUser as $row) {
        ?>
            <div class="card mt-3" onclick="updateView(<?php echo $row['user_post_id']; ?>)">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['date_added']; ?></h6>
                    <p class="card-text"><?php echo $row['body']; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
    <script>
        function updateView(userPostId) {
            fetch('update_view.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'user_post_id=' + encodeURIComponent(userPostId)
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.status);
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
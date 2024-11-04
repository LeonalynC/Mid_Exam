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
    <title>Home</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="index-page">
    <?php include 'navbar.php'; ?>
    <div class="container mt-4">
        <h1>Write a post</h1>
        <form action="core/handleForms.php" method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" name="body" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" name="category">
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <input type="text" class="form-control" name="tags">
            </div>
            <button type="submit" name="insertNewPostBtn" class="btn">Submit</button>
        </form>

        <h1 class="mt-5">All Posts</h1>
        <?php $getAllPosts = getAllPosts($pdo); ?>
        <?php foreach ($getAllPosts as $row) { ?>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                    Added By: <?php echo $row['userFullName']; ?> - 
                        <?php echo $row['date_added']; ?> 
                        (Status: <?php echo $row['status']; ?>, Views: <?php echo $row['views']; ?>)
                    </h6>
                    <p class="card-text"><?php echo $row['body']; ?></p>
                    <p class="card-text"><small>Last updated: <?php echo $row['last_updated']; ?></small></p>
                    <p class="card-text"><small>Category: <?php echo $row['category']; ?></small></p>
                    <p class="card-text"><small>Tags: <?php echo $row['tags']; ?></small></p>
                    <?php if ($_SESSION['user_id'] == $row['user_id']) { ?>
                        <a href="editpost.php?user_post_id=<?php echo $row['user_post_id']; ?>" class="card-link">Edit</a>
                        <a href="deletepost.php?user_post_id=<?php echo $row['user_post_id']; ?>" class="card-link">Delete</a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>

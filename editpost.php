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
    <title>Edit Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body { background-color: #f8f0f8; }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-4">
        <?php $getPostByID = getPostByID($pdo, $_GET['user_post_id']); ?>
        <h2>Edit Post</h2>
        <form action="core/handleForms.php?user_post_id=<?php echo $_GET['user_post_id']; ?>" method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo $getPostByID['title']; ?>">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" name="body" rows="5"><?php echo $getPostByID['body']; ?></textarea>
            </div>
            <button type="submit" name="editPostBtn" class="btn">Update</button>
        </form>
    </div>
</body>
</html>

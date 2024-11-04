<?php
session_start();
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

header('Content-Type: application/json');

if (isset($_POST['user_post_id'])) {
    $user_post_id = $_POST['user_post_id'];

    if (!in_array($user_post_id, $_SESSION['viewed_posts'])) {
        if (incrementPostViews($pdo, $user_post_id)) {
            $_SESSION['viewed_posts'][] = $user_post_id;
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'fail']);
        }
    } else {
        echo json_encode(['status' => 'already_viewed']);
    }
} else {
    echo json_encode(['status' => 'error']);
}
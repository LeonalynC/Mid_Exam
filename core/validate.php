<?php  
function validatePassword($password) {
    if (strlen($password) > 8) {
        $hasLower = preg_match('/[a-z]/', $password);
        $hasUpper = preg_match('/[A-Z]/', $password);
        $hasNumber = preg_match('/[0-9]/', $password);
        return $hasLower && $hasUpper && $hasNumber;
    }
    return false;
}

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
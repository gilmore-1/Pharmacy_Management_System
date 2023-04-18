<?php
// Include config file
require_once("db.php");

session_start();

$auth_page = "menu/menu.php";

// Check if the user is already logged in
if (!empty($_SESSION['logged_in'])) {
    // Redirect to authenticated page
    header("Location: $auth_page");
}

// Check if the verification code is present in the URL query string
if (!isset($_GET['code'])) {
    // Verification code not found
    echo 'Verification code not found.';
    exit;
}

// Retrieve the user's information from the database based on the verification code
$verificationCode = mysqli_real_escape_string($Links, $_GET['code']);
$query = "SELECT * FROM user WHERE verification_code = '$verificationCode'";
$result = mysqli_query($Links, $query);

if (!$result) {
    // Error executing query
    echo 'An error occurred while processing your request.';
    exit;
}

if (mysqli_num_rows($result) == 1) {
    // User account found with the given verification code
    $user = mysqli_fetch_assoc($result);

    // Check if the user's account is already verified
    if ($user['is_verified'] == 1) {
        // Account already verified
        echo 'Your account is already verified.';
    } else {
        // Update the user's account status to indicate that it is verified
        $query = "UPDATE user SET is_verified = 1, verification_code = NULL WHERE id = " . $user['id'];
        $result = mysqli_query($Links, $query);

        if (!$result) {
            // Error executing query
            echo 'An error occurred while processing your request.';
            exit;
        }

        // Account verified successfully
        echo 'Your account has been verified.';

        // Provide a link to the login page for the user to log in after their account has been verified
        echo '<br><br>Click <a href="login.php">here</a> to log in.';
    }
} else {
    // Invalid verification code
    echo 'Invalid verification code.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
</head>
<body>
    
</body>
</html>

<?php
// Include config file
require_once("db.php");

session_start();

$auth_page = "menu/menu.php";

// Check if the user is logged in already or not.
if (!empty($_SESSION['logged_in'])) {
    // Immediately redirect to page
    header("Location: $auth_page");
}

$email = "";
$email = "";


if (isset($_POST['submit_btn'])) {
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email";
    } else {
        // Prepare a select statement
        $email = trim($_POST["email"]);
        $sql = "SELECT email FROM user WHERE email = '" . mysqli_real_escape_string($Links, $email) . "'";

        $result = mysqli_query($Links, $sql);
        if (!$result) {
            echo "Oops! Something went wrong. Please try again later.";
        } elseif (mysqli_num_rows($result) == 0) {
            $email_err = "email not found.";
        } else {
            //

    
            // email found, do something`
            $token = bin2hex(random_bytes(16));
            $to = $email;
            $subject = "Password Reset";
            $message = "Click the following link to reset your password: https://atest.recraft.ge/resetverification.php?token=$token";
            $headers = "From: atest@recraft.ge";

            if (mail($to, $subject, $message, $headers)) {
                $email_err = "email sent successfully.";
                $Query = "INSERT INTO password_resets(email, token, expires_at) VALUES ( '$email', '$token',  NOW())";
                mysqli_query($Links, $Query);

            } else {
                $email_err =  "email sending failed.";
            }
        }
    }
}
// Close connection
mysqli_close($Links);

?>

<!DOCTYPE html>
<html>

<head>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="css/index.css" rel="stylesheet" />
    <title>Reset Password</title>
</head>

<body>
    <div class="container" style="background-color: #041221;max-width: none;margin-top: +2%;">
        <div id="flow">
            <span class="flow-1"></span>
            <span class="flow-2"></span>
            <span class="flow-3"></span>
        </div>
        <div class="section">

            <section class="hero is-success is-fullheight">
                <div class="hero-body">
                    <div class="container has-text-centered" style="max-width: 1132px;">
                        <div class="column is-4 is-offset-4">
                            <div class="login-header">
                                <h3 class="title ">Reset Password</h3>
                                <hr class="login-hr">

                                <div class="box">
                                    <form action="resetpassword.php" method="post">
                                        <fieldset>
                                            <div class="field">
                                                <div class="control">
                                                    <label>email</label>
                                                    <input type="email" name="email" class="form-control  <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>">
                                                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <input type="submit" name="submit_btn" class="button is-block is-primary is-medium is-fullwidth" value="Sign Up"><i class="fas fas-sign-in" aria-hidden="true"></i>
                                            </div>
                                            <p>you don't have an account? <a href="register.php">Register here</a>.</p>
                                    </form>
                                </div>
                                <a class=" level-item logo-margin">
                                    <img src="image/logo.png" width="152" height="140">
                                </a>

</body>

</html>
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

$password = "";
$password_err = "";
$token = "";
$email = '';
if (isset($_POST['submit_btn'])) {
    // Validate email
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter new password.";
    } else {
        // Prepare a select statement
        $password = trim($_POST["password"]);
        $token = trim($_POST['token']);
        $expiredTokens = "SELECT * FROM password_resets WHERE token = '" . mysqli_real_escape_string($Links, $token) . "'";
        $result = mysqli_query($Links, $expiredTokens);
        if (!$result) {
            header("Location: login.php");
        } elseif (mysqli_num_rows($result) == 0) {
            header("Location: login.php");
        } else {
            $row = mysqli_fetch_assoc($result);
            $email = $row['email'];
            $updateUser = "UPDATE user SET password = '" . md5($_POST['password']) . "' WHERE email = '$email'";
            mysqli_query($Links, $updateUser);
    
            $deleteToken = "DELETE FROM password_resets WHERE token = '$token'";
            mysqli_query($Links, $deleteToken);
            header("Location: login.php");

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
                                <form action="https://atest.recraft.ge/resetverification.php?token=<?php echo $_GET['token']?>" method="post">

                                        <fieldset>
                                            <div class="field">
                                                <div class="control">
                                                    <label>New Password</label>
                                                    <input type="password" name="password" class="form-control  <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                                                    <input type="hidden" name="token" class="form-control" value="<?php echo $_GET['token']?>"
                                                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <input type="submit" name="submit_btn" class="button is-block is-primary is-medium is-fullwidth" value="Confirm Password"><i class="fas fas-sign-in" aria-hidden="true"></i>
                                            </div>
                                    </form>
                                </div>
                                <a class=" level-item logo-margin">
                                    <img src="image/logo.png" width="152" height="140">
                                </a>

</body>

</html>
<?php
const REQUIRE_FIELD_ERROR = "This field is required";

$username = $email = $password = $password_confirm = "";

$messageError = [];

if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $username = post_data('username');
    $email = post_data('email');
    $password = post_data('password');
    $password_confirm = post_data('password_confirm');

    if (!$username)
        $messageError['username'] = REQUIRE_FIELD_ERROR;
    elseif (strlen($username) < 6 || strlen($username) > 16)
        $messageError['username'] = "This field must be between 6 and 16 characters long";

    if (!$email)
        $messageError['email'] = REQUIRE_FIELD_ERROR;
    elseif (!filter_var($email,FILTER_VALIDATE_EMAIL))
        $messageError['email'] = "Enter your email correctly";

    if (!$password)
        $messageError['password'] = REQUIRE_FIELD_ERROR;
    if (!$password_confirm)
        $messageError['password_confirm'] = REQUIRE_FIELD_ERROR;
    elseif ($password && strcmp($password,$password_confirm) !== 0)
        $messageError['password_confirm'] = "Please repeat your password correctly";
}

function post_data($field){
    if (!isset($_POST[$field])){
        return false;
    }
    $data = $_POST[$field];
    return htmlspecialchars(stripslashes(trim($data)));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="frontEnd/fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Main css -->
    <link rel="stylesheet" href="frontEnd/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="register-form" id="register-form" novalidate>
                            <div class="row my-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                        <input type="text" name="username" id="name" placeholder="Your Name" class="form-control <?= isset($messageError['username']) ? 'is-invalid' : '' ; ?> " value="<?= $username; ?>"/>
                                        <div class="invalid-feedback">
                                            <?= $messageError['username'] ?? ""; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                                        <input type="email" name="email" id="email" placeholder="Your Email" class="form-control <?= isset($messageError['email']) ? 'is-invalid' : '' ; ?> " value="<?= $email; ?>"/>
                                        <div class="invalid-feedback">
                                            <?= $messageError['email'] ?? ""; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                        <input type="password" name="password" id="pass" placeholder="Password" class="form-control <?= isset($messageError['password']) ? 'is-invalid' : '' ; ?> " value="<?= $password; ?>"/>
                                        <div class="invalid-feedback">
                                            <?= $messageError['password'] ?? ""; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="re_pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                        <input type="password" name="password_confirm" id="re_pass" placeholder="Repeat your password" class="form-control <?= isset($messageError['password_confirm']) ? 'is-invalid' : '' ; ?> " value="<?= $password_confirm; ?>"/>
                                        <div class="invalid-feedback">
                                            <?= $messageError['password_confirm'] ?? ""; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term checkbox" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit delete" value="Register" disabled="disabled"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="frontEnd/images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

<!-- JS -->
<script src="frontEnd/vendor/jquery/jquery.min.js"></script>
<script src="frontEnd/js/main.js"></script>
<script>
    $(function() {
        $(".checkbox").click(function(){
            $('.delete').prop('disabled',$('input.checkbox:checked').length === 0);
        });
    });
</script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
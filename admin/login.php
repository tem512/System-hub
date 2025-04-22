<?php require_once('../config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../inc/header.php'); ?>
    <script>start_loader();</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Educational Bootstrap 5 Login Page Website Template</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="hold-transition">
<section class="form-02-main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="_lk_de">
                    <div class="form-03-main">
                        <div class="logo">
                            <img src="assets/images/user.jpeg">
                        </div>
                        <form id="login-frm" action="" method="post">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control _ge_de_ol" placeholder="Username" required aria-required="true">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control _ge_de_ol" placeholder="Enter Password" required aria-required="true">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="_btn_04">Sign In</button><br><br> 
                                <a href="<?php echo base_url; ?>" class="_btn_04">Go to Home</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>$(document).ready(function(){end_loader();});</script>
</body>
</html>
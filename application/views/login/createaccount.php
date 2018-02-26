<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create account</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo asset_url() ?>css/foundation.css" />

    <!-- Add new stylesheets after this comment -->
    <link rel="stylesheet" href="<?php echo asset_url() ?>css/main.css" />
</head>
<body>
    <div class="row">
        <div class="medium-6 medium-centered large-4 large-centered columns">
            <form action="<?= site_url('login/createaccount') ?>" method="post" onsubmit="return validate(this)">
                <div class="row column log-in-form">
                    <img src="<?php echo asset_url() ?>images/ksc.png">
                    <label>KSC Email
                    <input type="text" name="username" placeholder="KSC.Student@ksc.keene.edu">
                    </label>
                    <label>Password
                    <input type="password" name="password" placeholder="Password">
                    </label>
                    <p>
                        Password requirements:<br>
                        <small>- must be 6 - 20 characters long</small>
                        <small>- must contain at least 1 digit</small>
                        <small>- must contain at least 1 upper case letter</small>
                        <small>- must contain at least 1 lower case letter</small>
                    </p>
                    <p><input type="submit" name="" class="button expanded" value="Create"></p>
                </div>
            </form>
            <label class="errorLabel"><?php echo $error?></label>
        </div>
    </div>
    <script src="<?php echo asset_url()?>js/passwordRequirements.js"></script>
</body>
</html>
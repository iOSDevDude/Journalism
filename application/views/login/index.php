<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo asset_url() ?>css/foundation.css" />

    <!-- Add new stylesheets after this comment -->
    <link rel="stylesheet" href="<?php echo asset_url() ?>css/main.css" />
</head>

<body>
    <div class="row">
        <div class="medium-6 medium-centered large-4 large-centered columns">

            <form action="<?= site_url('login') ?>" method="post">
                <div class="row column log-in-form">
                    <img src="<?php echo asset_url() ?>images/ksc.png">
                    <label>KSC Email
                    <input type="text" name="username" placeholder="firstname.lastname@ksc.keene.edu">
                    </label>
                    <label>Password
                    <input type="password" name="password" placeholder="Password">
                    </label>
                    <p><input type="submit" name="" class="button expanded" value="Log in"></p>
                    <p><a id="createAcc" href="<?php echo site_url('login/createaccount') ?>" class="button expanded">Create account</a></p>
                </div>
            </form>
        <label class="errorLabel"><?php echo $error?></label>

        </div>
    </div>
</body>
</html>

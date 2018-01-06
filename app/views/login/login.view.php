<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="./public/css/bootstrap.min.css">
        <link rel="stylesheet" href="./public/css/animate.css">
        <link rel="stylesheet" href="./public/css/login.css">
        <title>NursingHome - Login</title>
    </head>
    <body>

        <?php $this->showErrors(); ?>

        <div class="container wow fadeInDown">

            <form class="form-signin" method="post" action="" id="login-form">
                <h2 class="form-signin-heading">Connexion</h2>
                <label for="email" class="sr-only">Email
                </label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="" autofocus="">
                <label for="code" class="sr-only">Password</label>
                <input type="password" name="code" id="code" class="form-control" placeholder="Mot de passe" required="">
                <button class="btn btn-lg btn-dark btn-block" type="submit">Se connecter</button>
            </form>

        </div>

        <script src="./public/js/jquery.js"></script>
        <script src="./public/js/bootstrap.min.js"></script>
        <script src="./public/js/wow.min.js"></script>
        <script src="./public/js/main.js"></script>

    </body>
</html>
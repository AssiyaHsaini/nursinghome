<!-- Cette vue propose aux utilisateurs de se connecté. Pour cela l'utilisateur doit entré son email et son mot de passe -->

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
    <!-- formulaire de connexion -->
            <form class="form-signin" method="post" action="" id="login-form">
                <h2 class="form-signin-heading">Connexion</h2>

                <label for="email" class="sr-only">Email
                </label>
                <!-- champ pour entré son email -->
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="" autofocus="">
                <label for="code" class="sr-only">Password</label>
                <!-- champ pour entré son mot de passe -->                
                <input type="password" name="code" id="code" class="form-control" placeholder="Mot de passe" required="">
                <!-- bouton pour se connecté   -->
                <button class="btn btn-lg btn-dark btn-block" type="submit">Se connecter</button>
            </form>

        </div>




    </body>
</html>

<?php
// on inclue le footer qui permet ici d'inclure les bibliotheque de bootstrap, et nos scripts javaScript dont main.js
 require_once(__ROOT__ .'/app/views/common/footer.php');
?>
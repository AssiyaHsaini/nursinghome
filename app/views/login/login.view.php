<?php
// require_once(__DIR__ .'/../common/head.php');
require_once(__ROOT__ .'/app/views/common/head.php');
?>

<link rel="stylesheet" href="./public/css/bootstrap.min.css">
<link rel="stylesheet" href="./public/css/main.css">


<div class="container">

        <?php $this->showErrors(); ?>

      <form class="form-signin" method="post" action="">
        <h2 class="form-signin-heading">Connexion</h2>
        <label for="email" class="sr-only">Email </label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="" autofocus="">
        <label for="code" class="sr-only">Password</label>
        <input type="password" name="code" id="code" class="form-control" placeholder="Mot de passe" required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
      </form>

    </div>
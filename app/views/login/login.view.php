<?php
require_once(__DIR__ .'/../common/header.php');
require_once(__DIR__ .'/../../controllers/VerificationController.php');
?>

<h1>Login </h1>



<form method="post" action="VerificationController.php" >
	
	<label for="code"> Votre code </label> : <input type="text" name="code" id="code" />
    <br/>
     <input type="submit" value="Valider" /> 

</form>

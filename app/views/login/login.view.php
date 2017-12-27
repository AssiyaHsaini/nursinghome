<?php
require_once(__DIR__ .'/../common/header.php');
?>

<?php if (isset($this->data['errors'])) { ?>
    <div class="alert">
        <?php // echo $this->data['error'] ?>
        <?php var_dump($this->data['errors']) ?>
    </div>
<?php } ?>

<h1>Login </h1>

<form method="post" action="" >
	
	<label for="code"> Votre code </label> : <input type="text" name="code" id="code" />
    <br/>
    <input type="submit" value="Valider" /> 

</form>

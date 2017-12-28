<?php
require_once(__DIR__ .'/../common/header.php');
?>

<?php if (isset($this->data['errors'])) { ?>
    <div class="alert">
        <?php // echo $this->data['error'] ?>
        <?php var_dump($this->data['errors']) ?>
    </div>
<?php } ?>

<h1> Nursings  </h1>

<?php 

if (isset($this->data['nursings']) && count($this->data['nursings']) > 0 ) {

    foreach($this->data['nursings'] as $nursing)
    {
    ?>  
        <p><? echo " - " . $nursing['lastname']; ?></p>
        <form action="" method="POST">
            <input type="hidden" name="postMethod" value="delete"> 
            <input type="hidden" name="personId" value="<? echo $nursing['id'];?>"> 
            <input type="submit" value="Supprimer" /> 
            
        </form>
        
    <?php
    }
}
?>

<h1>Inscription</h1> 
       
       <form action="" method="POST">
       
       <p>
       <label for="lastname"> lastName </label> : <input type="text" name="lastname" id="lastname" required/>
       <label for="firstname"> firstName </label> : <input type="text" name="firstname" id="firstname" required/>
       <label for="email"> email </label> : <input type="text" name="email" id="email" required/>
       <label for="role">role</label>
       <select name="role" id="role">
          <option value="0">cadre santé</option>
          <option value="1">aide soignante</option>
       </select>
       <input type="hidden" name="postMethod" value="create">       
       <input type="submit" value="Inscrire" /> 
       </p>
       </form>

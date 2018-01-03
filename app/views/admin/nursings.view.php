<?php
require_once(__DIR__ .'/../common/header-cadre.php');
?>

<!-- <?php if (isset($this->data['errors'])) { ?>
    <div class="alert">
        <?php // echo $this->data['error'] ?>
        <?php var_dump($this->data['errors']) ?>
    </div>
    <?php } ?> 
-->

<?php $this->showErrors(); ?>

<h1>Les aides soignantes </h1>



<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col"> Prénom </th>
      <th scope="col"> Nom </th>
      <th scope="col"> Email </th> 
      <th scope="col"> bouton </th>
   </tr>
  </thead>
<tbody>


<?php 

if (isset($this->data['nursings']) && count($this->data['nursings']) > 0 ) {

    foreach($this->data['nursings'] as $nursing)
    {
    ?>  
        <tr>
        <th scope="row"> <?= $nursing['firstname']; ?> </th>
        <td> <?= $nursing['lastname']; ?> </td>
        <td> <?= $nursing['email']; ?> </td>        
        <td>
            <form action="" method="POST">
                <input type="hidden" name="postMethod" value="delete"> 
                <input type="hidden" name="personId" value="<? echo $nursing['id'];?>"> 
                <input type="submit" value="Supprimer" /> 
                
            </form>
        </td>
        </tr>
        
    <?php
    }
}
?>
  </tbody>
</table>






<!-- <h1>Inscription</h1> 
       
       <form action="" method="POST">
       
       <p>
       <label for="lastname"> lastName </label> : <input type="text" name="lastname" id="lastname" required/>
       <label for="firstname"> firstName </label> : <input type="text" name="firstname" id="firstname" required/>
       <label for="email"> email </label> : <input type="text" name="email" id="email" required/>
       <label for="role">role</label>
       <select name="role" id="role">
          <option value="1">aide soignante</option>
       </select>
       <input type="hidden" name="postMethod" value="create">       
       <input type="submit" value="Inscrire" /> 
       </p>
       </form>  -->
  <h1>Inscription</h1> 
       <form action="" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="lastname"> Nom </label>
                <input type="text" name="lastname" id="lastname"  class="form-control"  placeholder="Hsaini" required>
                </div>
                <div class="form-group col-md-6">
                <label for="firstname">Prénom</label>
                <input type="text" name="firstname" id="firstname"  class="form-control" placeholder="Assiya" required>
                </div>
                <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" id="inputAddress" placeholder="Email" required>
                </div>
                <div class="form-group col-md-6">
                <label for="inputState">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option selected>Choisir...</option>
                        <option value="1">aide soignante</option>
                    </select>
                </div>
                <input type="hidden" name="postMethod" value="create">   
                <!-- <input type="submit" value="Inscrire" />    -->
            <button type="submit" class="btn btn-primary">Inscrire</button> 
                
            </div>
  
       </form>   



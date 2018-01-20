<!-- Cette vue affiche les aides soignantes inscrites, et permet à la cadre sante de supprimer une aide soignatnte ou d'en ajouter une. -->
<!-- Cette vue contient deux formulaire, un pour ajouter et un pour supprimer une aide soignante. -->
<?php
require_once(__DIR__ .'/../common/header-cadre.php');
?>

<?php
// voir classe View.php 
$this->showErrors(); ?>

<div class="container wow bounceInLeft">
    <div class="row head-row align-items-center">
        <h2>Aides soignantes actuelles</h2>
    </div>

    <div class="row">

        <!-- tableau qui liste les informations des aides soignantes inscrite -->
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col"> ID </th>
              <th scope="col"> Nom </th>
              <th scope="col"> Prénom </th>
              <th scope="col"> Email </th> 
              <th scope="col"></th>
           </tr>
          </thead>
          <tbody>
        
        
            <?php 
        
                if (isset($this->data['nursings']) && count($this->data['nursings']) > 0 ) {
        
                    foreach($this->data['nursings'] as $nursing)
                    {
                    ?>  
                        <tr>
                        <th scope="row"> <?= $nursing['id']; ?> </th>
                        <td> <?= ucfirst($nursing['lastname']); ?> </td>
                        <td> <?= ucfirst($nursing['firstname']); ?> </td>
                        <td> <?= $nursing['email']; ?> </td>        
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="postMethod" value="delete"> 
                                <input type="hidden" name="personId" value="<? echo $nursing['id'];?>"> 
                                <button type="submit" class=" close close-icon" aria-label="Close">
                                    <i class="material-icons">clear</i>
                                </button>             
                            </form>
                        </td>
                        </tr>
                        
                    <?php
                    }
                }
                else
                {
                    
                }
            ?>
          </tbody>
        </table>

    </div>

</div>


<div class="container wow">
<br>
<hr>
<h2>Ajouter une aide soignante</h2>
<form action="" method="POST">
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="lastname">
                Nom
            </label>
            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Hsaini" required="required">
        </div>
        <div class="form-group col-md-4">
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Assiya" required="required">
        </div>
        <div class="form-group col-md-4">
            <label for="email">Email</label>
            <input type="text" name="email" id="inputAddress" class="form-control" placeholder="Email" required="required">
        </div>
        <input type="hidden"  name="role" value="1" >
        <input type="hidden" name="postMethod" value="create">

    </div>
    <button type="submit" class="btn btn-dark btn-lg btn-block">Valider</button>
</form>
<br>
</div>


<?php
require_once(__DIR__ .'/../common/footer.php');
?>

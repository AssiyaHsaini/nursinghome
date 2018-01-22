<!-- Cette vue affiche les aides soignantes inscrites, et permet à la cadre sante de supprimer une aide soignatnte ou d'en ajouter une. -->
<!-- Cette vue contient deux formulaire, un pour ajouter et un pour supprimer une aide soignante. -->
<?php
// on inclue "header-cadre.php" qui est commun a toute les vues de la cadre sante
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
          <!-- premiere ligne du tableau -->
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
            // parcours de "data['nursings']" qui contient les informations des aides soignantes (nom prenom email) 
        
                if (isset($this->data['nursings']) && count($this->data['nursings']) > 0 ) {
        
                    foreach($this->data['nursings'] as $nursing)
                    {
                    ?>  
                    <!-- à chaque tour de boucle une ligne sera créer, (une ligne par aide soigante) -->
                        <tr>
                        <th scope="row"> <?= $nursing['id']; ?> </th>
                        <td> <?= ucfirst($nursing['lastname']); ?> </td>
                        <td> <?= ucfirst($nursing['firstname']); ?> </td>
                        <td> <?= $nursing['email']; ?> </td>        
                        <td>
                            <!-- premier formulaire qui permet de supprimer une aide soignante -->
                            <form action="" method="POST">
                            <!-- les deux lignes suivante vous nous servir à differencier les deux formulaires de notre page -->
                                <!-- si "postMethod" a pour valeur "delete" alors on sais qu'il s'agit du formualire pour supprimer une aide soignante. De ce fait on pourra appeller la méthode consequente dans AdminController -->
                                <input type="hidden" name="postMethod" value="delete"> 
                                <!-- ce second input de type "hidden" va nous permettre de transmettre l'id de l'aide soignante à la methode "deleteNursing" de adminController (cette methode a besoin de l'id pour supprimer) -->
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

            ?>
          </tbody>
          <!-- fin du tableau -->
        </table>

    </div>

</div>


<div class="container wow">
<br>
<hr>
<h2>Ajouter une aide soignante</h2>
<!-- deuxième formulaire qui permet de créer des aides soignantes. Pour cela la cadre santé doit choisir un nom, un prenom et un email -->
<form action="" method="POST">
    <div class="form-row">
        <div class="form-group col-md-4">
                <!-- champ pour entrer le nom -->
            <label for="lastname">
                Nom
            </label>
                
            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Hsaini" required="required">
        </div>
        <div class="form-group col-md-4">
                <!-- champ pour entre le prenom -->
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Assiya" required="required">
        </div>
        <div class="form-group col-md-4">
            <label for="email">Email</label>
                <!-- champ pour entre l'email -->                
            <input type="text" name="email" id="inputAddress" class="form-control" placeholder="Email" required="required">
        </div>
        <input type="hidden"  name="role" value="1" >

        <!-- si "postMethod" a pour valeur "create" alors on sais qu'il s'agit du formualire pour ajouter une aide soignante. De ce fait on pourra appeller la méthode consequente dans AdminController -->
        <input type="hidden" name="postMethod" value="create">

    </div>
    <button type="submit" class="btn btn-dark btn-lg btn-block">Valider</button>
</form>
<br>
</div>



<?php
// on inclue le footer qui permet ici d'inclure les bibliotheque de bootstrap 
require_once(__DIR__ .'/../common/footer.php');
?>

<?php

namespace App;

/**
 * Classe qui reprensente les vues de notre application 
 */

class View {

    private $path; // chemin de la vue 
    private $data = []; // données de la vue

    public function __construct($path, $data) {
        $this->path = $path;
        $this->data = $data;
    }

    /*
        Cette fonction va être utilisé pour afficher nos vues
    */
    public function render() { 
        include_once $this->path;
    }

    /*
        affiche les erreurs rencontrées dans la vue
    */
    public function showErrors()
    {
        if (isset($this->data['errors'])) 
        {
            if (is_array($this->data['errors'])) // si on a faire à un tableau, alors on parcourt le tableau pour afficher chaque erreur
            {
                foreach ($this->data['errors'] as $message)
                {
                    echo "<div class='alert alert-danger wow fadeInDown' role='alert'>" . $message . "</div> "; 
                }
            }
            else 
                 echo "<div class='alert alert-danger' role='alert'>" . $this->data['errors'] . "</div> "; // sinon on affiche l'unique erreur
           

        }
       
    }

}
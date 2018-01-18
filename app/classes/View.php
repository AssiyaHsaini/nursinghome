<?php

namespace App;

/**
 * Class qui reprensente les vue de notre application 
 */

class View {

    private $path; // chemin de la vue 
    private $data = []; // données de la vue 

    public function __construct($path, $data) {
        $this->path = $path;
        $this->data = $data;
    }

    public function render() {
        include_once $this->path;
    }

    //affiche les erreurs rencontrées dans la vue
    public function showErrors()
    {
        if (isset($this->data['errors']))
        {
            if (is_array($this->data['errors']))
            {
                foreach ($this->data['errors'] as $message)
                {
                    echo "<div class='alert alert-danger wow fadeInDown' role='alert'>" . $message . "</div> ";
                }
            }
            else 
                 echo "<div class='alert alert-danger' role='alert'>" . $this->data['errors'] . "</div> ";
           

        }
       
    }

}
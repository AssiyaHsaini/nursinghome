<?php

namespace App;

class View {

    private $path;
    private $data = [];

    public function __construct($path, $data) {
        $this->path = $path;
        $this->data = $data;
    }

    public function render() {
        include_once $this->path;
    }

    public function showErrors()
    {
        if (isset($this->data['errors']))
        {
            if (is_array($this->data['errors']))
            {
                foreach ($this->data['errors'] as $message)
                {
                    echo "<div class='alert alert-danger' role='alert'>" . $message . "</div> ";
                }
            }
            else 
                 echo "<div class='alert alert-danger' role='alert'>" . $this->data['errors'] . "</div> ";
           

        }
       
    }

}
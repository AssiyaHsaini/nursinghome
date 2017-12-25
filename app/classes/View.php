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

}
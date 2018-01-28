<?php

  namespace App;

  class PagesController{
    public function home() {      
      $posts = Pessoa::all();      
      require_once('views/pessoas/index.php');
    }

    public function error() {
      require_once('views/pages/error.php');
    }
  }
?>
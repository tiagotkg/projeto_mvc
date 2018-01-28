<?php

  namespace App;
 
  class Grupo {   
    
    public $cdGrupo;
    public $grupo;

    public function __construct($cdGrupo, $grupo) {
      $this->cdGrupo = $cdGrupo;
      $this->grupo  = $grupo;      
    }

    public static function all() {
      $list = []; 

      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM grupos');
      
      foreach($req->fetchAll() as $grupo) {
        $list[] = new Grupo($grupo['cd_grupo'], $grupo['grupo']);
      }

      return $list;
    }
    
  }
?>
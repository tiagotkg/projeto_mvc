<?php  

  namespace App;

  class Routes {

    public function __construct($controller, $action) {
      $this->run($controller, $action);
    }

    public function run($controller, $action) {      
      $controllers = array('pages' => ['home', 'error'],                          
                           'pessoas' => ['index', 'create', 'save', 'edit', 'update', 'delete']);

      if (array_key_exists($controller, $controllers)) {
        if (in_array($action, $controllers[$controller])) {
          $this->call($controller, $action);
        } else {
          $this->call('pages', 'error');
        }
      } else {
        $this->call('pages', 'error');
      }
    }

    public function call($controller, $action) {
      $controller = ucfirst($controller);    
  
      switch($controller) {
        case 'Pages':
          $controller = new PagesController();
        break;
        case 'Posts':                
          $controller = new PostsController();
        break;
        case 'Pessoas':                
          $controller = new PessoasController();
        break;
      }
  
      $controller->{ $action }();
    }   

  }

  
?>
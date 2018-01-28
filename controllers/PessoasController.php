<?php

namespace App;

class PessoasController extends Pessoa {
    public function index() {      
        $pessoas = Pessoa::all();
        require_once('views/pessoas/index.php');
    }

    public function show() {      
        if (!isset($_GET['cdPessoa'])) {
            return Routes::call('pages', 'error');
        }            
      
        $pessoa = Pessoa::find($_GET['cdPessoa']);
        require_once('views/pessoas/show.php');
    }

    public function create() {                        
        $grupos = Grupo::all();
        require_once('views/pessoas/create.php');
    }

    public function save() {        

        try {
            Pessoa::savePessoa($_REQUEST);
            header('Location: ./');
        } catch (\Exception $e) {
            $grupos = Grupo::all();
            echo '<div class="alert alert-danger" role="alert">' .$e->getMessage(). '</div>';            
            require_once('views/pessoas/create.php');
        }
    }

    public function edit() {
        $pessoa = Pessoa::find($_REQUEST['cdPessoa']);
        $grupos = Grupo::all();       

        require_once('views/pessoas/edit.php');
    }

    public function update() {
        try {
            Pessoa::updatePessoa($_REQUEST);
            header('Location: ./');
        } catch (\Exception $e) {              
            $grupos = Grupo::all();
            echo '<div class="alert alert-danger" role="alert">' .$e->getMessage(). '</div>';            
            require_once('views/pessoas/edit.php');
        }        
    }

    public function delete() {
        try {
            Pessoa::deletePessoa($_REQUEST);            
        } catch (\Exception $e) {              
            $grupos = Grupo::all();
            echo '<div class="alert alert-danger" role="alert">' .$e->getMessage(). '</div>';            
            
        }   
        header('Location: ./');
    }


  }
?>
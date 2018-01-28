<?php

  namespace App;
 
  class Pessoa {   
    
    private $cdPessoa;
    private $nome;
    private $sobrenome;
    private $dataCriacao;
    private $dataAtualizacao;
    private $grupos;

    protected function getCdPessoa() {
        return $this->cdPessoa;
    }

    protected function getNome() {
        return $this->nome;
    }

    protected function getSobrenome() {
        return $this->sobrenome;
    }

    protected function getDataCriacao() {   
        return date_format(date_create($this->dataCriacao), 'd/m/y');
    }

    protected function getDataAtualizacao() {
        if($this->dataAtualizacao != '') {
            return date_format(date_create($this->dataAtualizacao), 'd/m/y');
        }        
    }

    protected function getGrupos() {
        return $this->grupos;
    }

    protected function setGrupos($grupos) {
        $this->grupos = $grupos;
    }


    public function __construct($cdPessoa = null, $nome = null, $sobrenome  = null, $dataCriacao  = null, $dataAtualizacao = null, $grupos = null) {
        $this->cdPessoa = $cdPessoa;
        $this->nome  = $nome;
        $this->sobrenome = $sobrenome;
        $this->dataCriacao  = $dataCriacao;
        $this->dataAtualizacao = $dataAtualizacao;  
        $this->grupos = $grupos;  
    }

    protected function all() {
        $list = []; 

        $db = Db::getInstance();
        $queryPessoas = $db->query('SELECT * FROM pessoas');
        
        $queryGrupos = $db->prepare('SELECT grupos.* FROM grupos 
                        INNER JOIN pessoas_grupos ON pessoas_grupos.grupos_cd_grupo = grupos.cd_grupo 
                        WHERE pessoas_grupos.pessoas_cd_pessoa = :cdPessoa');
        $queryGrupos->bindParam(':cdPessoa', $cdPessoa);
       
        foreach($queryPessoas->fetchAll() as $rowPessoa) {
            $pessoa = new Pessoa($rowPessoa['cd_pessoa'], $rowPessoa['nome'], $rowPessoa['sobrenome'], $rowPessoa['dt_criacao'], $rowPessoa['dt_atualizacao']);        
            $cdPessoa = intval($rowPessoa['cd_pessoa']);
            
            $queryGrupos->execute();
            $pessoa->setGrupos($queryGrupos->fetchAll());

            $list[] = $pessoa;
        }

        return $list;
    }

    protected function savePessoa($request = null) {

        $this->validate($request);

        $db = Db::getInstance();
        $insertPessoa = $db->prepare("INSERT INTO pessoas (nome, sobrenome, dt_criacao) VALUES (:nome, :sobrenome, :dataCriacao)");  
        $insertPessoa->bindParam(':nome', $request['nome']);
        $insertPessoa->bindParam(':sobrenome', $request['sobrenome']);
        $insertPessoa->bindParam(':dataCriacao', $date);

        $date = date("Y-m-d");
        $insertPessoa->execute();
        $cdPessoa = $db->lastInsertId();

        $insertPessoasGrupos = $db->prepare('INSERT INTO pessoas_grupos (pessoas_cd_pessoa, grupos_cd_grupo) VALUES (:cdPessoa, :cdGrupo)');
        $insertPessoasGrupos->bindParam(':cdPessoa', $cdPessoa);
        
        foreach($request['grupos'] as $grupo) {
            $insertPessoasGrupos->bindParam(':cdGrupo', $grupo);
            $insertPessoasGrupos->execute();
        }
        
    }

    protected function updatePessoa($request = null) {

        if(!isset($request['cdPessoa']) || $request['cdPessoa'] == '') {
            throw new \Exception('Código da pessoa inválido');            
        } else {
            $pessoa = $this->find($request['cdPessoa']);
            if(!$pessoa) {
                throw new \Exception('Pessoa não encontrada.');            
            }
        }

        $this->validate($request);

        $db = Db::getInstance();
        $updatePessoa = $db->prepare("UPDATE pessoas SET nome = :nome, sobrenome = :sobrenome, dt_atualizacao = :dataAtualizacao WHERE cd_pessoa = :cdPessoa");  
        $updatePessoa->bindParam(':cdPessoa', $request['cdPessoa']);
        $updatePessoa->bindParam(':nome', $request['nome']);
        $updatePessoa->bindParam(':sobrenome', $request['sobrenome']);
        $updatePessoa->bindParam(':dataAtualizacao', $date);

        $date = date("Y-m-d");
        $updatePessoa->execute();        
        
        $db->exec('DELETE FROM pessoas_grupos WHERE pessoas_cd_pessoa = ' . $request['cdPessoa']);

        $insertPessoasGrupos = $db->prepare('INSERT INTO pessoas_grupos (pessoas_cd_pessoa, grupos_cd_grupo) VALUES (:cdPessoa, :cdGrupo)');
        $insertPessoasGrupos->bindParam(':cdPessoa', $request['cdPessoa']);
        
        foreach($request['grupos'] as $grupo) {
            $insertPessoasGrupos->bindParam(':cdGrupo', $grupo);
            $insertPessoasGrupos->execute();
        }
        
    }

    protected function deletePessoa($request) {
        $db = Db::getInstance();
        if(!isset($request['cdPessoa']) || $request['cdPessoa'] == '') {
            throw new \Exception('Código da pessoa inválido');            
        } else {
            $pessoa = $this->find($request['cdPessoa']);
            if(!$pessoa) {
                throw new \Exception('Pessoa não encontrada.');            
            }
        }

        $db->exec('DELETE FROM pessoas_grupos WHERE pessoas_cd_pessoa = ' . $request['cdPessoa']);
        $db->exec('DELETE FROM pessoas WHERE cd_pessoa = ' . $request['cdPessoa']);

    }


    private function validate($request) {
        
        $nome = strlen($request['nome']);
        $sobrenome = strlen($request['sobrenome']);
        
        if($nome > 50 || $nome < 3) {
            throw new \Exception('Nome de conter de 3 a 50 caracteres.');            
        }

        if($sobrenome > 100 || $sobrenome < 3) {
            throw new \Exception('Sobrenome de conter de 3 a 100 caracteres.');            
        }

        if(!isset($request['grupos']) || count($request['grupos']) < 2) {
            throw new \Exception('Selecione ao menos 2 grupos.');            
        }

    }

    protected static function find($cdPessoa) {
        $db = Db::getInstance();
        $queryPessoa = $db->prepare('SELECT * FROM pessoas WHERE cd_pessoa = :cdPessoa');
        $queryPessoa->bindParam(':cdPessoa', $cdPessoa);
        $queryPessoa->execute();

        $queryGrupos = $db->prepare('SELECT grupos.cd_grupo FROM grupos 
                        INNER JOIN pessoas_grupos ON pessoas_grupos.grupos_cd_grupo = grupos.cd_grupo 
                        WHERE pessoas_grupos.pessoas_cd_pessoa = :cdPessoa');
        $queryGrupos->bindParam(':cdPessoa', $cdPessoa);
       
        $resultPessoa = $queryPessoa->fetchAll(); 
        
        if(!$resultPessoa) {
            return false;
        }

        foreach($resultPessoa as $rowPessoa) {
            $pessoa = new Pessoa($rowPessoa['cd_pessoa'], $rowPessoa['nome'], $rowPessoa['sobrenome'], $rowPessoa['dt_criacao'], $rowPessoa['dt_atualizacao']);        
            $cdPessoa = intval($rowPessoa['cd_pessoa']);
            
            $queryGrupos->execute();
            $pessoa->setGrupos($queryGrupos->fetchAll());            
        }

        return $pessoa;
    }
  }
?>
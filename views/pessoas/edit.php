<form action="?controller=pessoas&action=update&cdPessoa=<?php echo isset($_REQUEST['cdPessoa']) ? $_REQUEST['cdPessoa'] : $pessoa->getCdPessoa(); ?>" method="post">
    <h3>Editar Pessoa</h3>        
    <div class="row">
        <div class="col-sm-6 form-group">
            <label for="nome">Nome</label>
            <input id="nome" type="text" name="nome" value="<?php echo isset($_REQUEST['nome']) ? $_REQUEST['nome'] : $pessoa->getNome(); ?>" placeholder="Nome" class="form-control" required="">
        </div>
        <div class="col-sm-6 form-group">
            <label for="sobrenome">Sobrenome</label>
            <input id="sobrenome" value="<?php echo isset($_REQUEST['sobrenome']) ? $_REQUEST['sobrenome'] : $pessoa->getSobrenome(); ?>" type="text" name="sobrenome" placeholder="Sobrenome" class="form-control" required="">
        </div>
    </div>	
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Grupos</h3>
        </div>
        <div class="panel-body">
            <?php foreach($grupos as $grupo): ?>

                <?php 
                    $checked = '';

                    if(isset($_REQUEST['grupos'])) {
                        $pessoaGrupos = $_REQUEST['grupos'];
                    } else {
                        $pessoaGrupos = array_column($pessoa->getGrupos(), 'cd_grupo');
                    }
                    
                    if(in_array($grupo->cdGrupo, $pessoaGrupos)) {
                        $checked = 'checked="checked"';
                    }
                
                ?>

                <div class="col-sm-4 form-check">                
                    <input class="form-check-input" name="grupos[]" type="checkbox" <?php echo $checked; ?> value="<?php echo $grupo->cdGrupo; ?>" id="label<?php echo $grupo->cdGrupo; ?>">
                    <label class="form-check-label" for="label<?php echo $grupo->cdGrupo; ?>"><?php echo $grupo->grupo; ?></label>                
                </div>            	
            <?php endforeach; ?>
        </div>
    </div>
                
    <div class="text-right">
    <hr />
        <input type="submit" value="Atualizar" class="btn btn-info" />                    
    </div>	
</form> 

<h2>Pessoas</h1>

<div class="row">
    <div>
        <table class="table">
        <thead>
            <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Grupos</th>
            <th>Data de Criação</th>
            <th>Data de Atualização</th>
            <th class="text-right"><a href='?controller=pessoas&action=create' class="btn btn-sm btn-primary">Cadastrar</a></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($pessoas as $pessoa) { ?>
            <tr>
                <td><?php echo $pessoa->getCdPessoa(); ?></td>
                <td><?php echo $pessoa->getNome(); ?></td>
                <td><?php echo $pessoa->getSobrenome(); ?></td>
                <td>
                    <?php foreach($pessoa->getGrupos() as $grupo): ?>
                        <?php echo $grupo['grupo']; ?>
                        <br />
                    <?php endforeach; ?>                
                </td>
                <td><?php echo $pessoa->getDataCriacao(); ?></td>
                <td><?php echo $pessoa->getDataAtualizacao(); ?></td>
                <td class="text-right">
                <a href='?controller=pessoas&action=edit&cdPessoa=<?php echo $pessoa->getCdPessoa(); ?>' class="btn btn-sm btn-warning">Editar</a>
                <a href="?controller=pessoas&action=delete&cdPessoa=<?php echo $pessoa->getCdPessoa(); ?>" class="btn btn-sm btn-danger btDelete">Deletar</a>
                </td>
            </tr>     
          <?php } ?>         
        </tbody>
        </table>
    </div>        
</div>
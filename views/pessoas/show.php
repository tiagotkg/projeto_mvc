<h2>Pessoa</h1>

<div class="row">
    <div class="col-md-6">
        <table class="table">
        <thead>
            <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Data de Criação</th>
            <th>Data de Atualização</th>
            <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td><?php echo $pessoa->cdPessoa; ?></td>
            <td><?php echo $pessoa->nome; ?></td>
            <td><?php echo $pessoa->sobrenome; ?></td>
            <td><?php echo $pessoa->dataCriacao; ?></td>
            <td><?php echo $pessoa->dataAtualizacao; ?></td>
            </tr>              
        </tbody>
        </table>
    </div>        
</div>
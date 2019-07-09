<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <?php
    if ($this->getUsuario() != null) : ?>
        <h1 class="navbar-brand" href="#"><?= $this->getUsuario()->getNome() ?></h1>
    <?php else : ?>
        <h1 class="navbar-brand" href="#">Sistema de perguntas</h1>
    <?php endif ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?= URL_RAIZ . 'perguntas'?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL_RAIZ . 'perguntas/criar'?>">Criar pergunta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= URL_RAIZ . 'perguntas/relatorio'?>>Relatorio</a>
            </li>
        </ul>
        <div class="my-2 my-lg-0">
            <?php
            if ($this->getUsuario() != null) : ?>
                <form action="usuario/login" method="post">
                    <input type="hidden" name="_metodo" value="DELETE">
                    <button type="submit" class="btn btn-danger">Sair</button>
                </form>
            <?php else : ?>
                <form action="usuario/login" method="get">
                    <button type="submit" class="btn btn-danger">Entrar</button>
                </form>
            <?php endif ?>
        </div>
    </div>
</nav>
<br>
<div class="container">
    <div class="mx-auto">
        <?php foreach ($relatorio as $tabela) : ?>
            <table class="table table-striped">
                <div class="mx-auto">
                    <h4>
                        <?= $tabela->getTipo() ?>
                    </h4>
                </div>
                <thead>
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Pergunta</th>
                        <th scope="col">Acertos</th>
                        <th scope="col">Erros</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><?= $tabela->getNome() ?></th>
                        <td><?= $tabela->getPergunta() ?></td>
                        <td><?= $tabela->getAcertos() ?></td>
                        <td><?= $tabela->getErros() ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
        <?php endforeach ?>
    </div>
</div>
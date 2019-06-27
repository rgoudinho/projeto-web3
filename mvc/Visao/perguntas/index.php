<div class="center-block site ">
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
                    <a class="nav-link" href="perguntas">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="perguntas/criar">Criar pergunta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="perguntas/relatorio">Relatorio</a>
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
        <div class="row">
            <div class="mx-auto">
                <a href="<?= URL_RAIZ . 'perguntas/1' ?>" class="btn btn-primary">Fácil</a>
                <a href="<?= URL_RAIZ . 'perguntas/2' ?>" class="btn btn-primary">Médio</a>
                <a href="<?= URL_RAIZ . 'perguntas/3' ?>" class="btn btn-primary">Difícil</a>
            </div>
        </div>
    </div>
    <br>
    <table class="table">
        <?php
        if (empty($perguntas)) : ?>
            <tr>
                <td colspan="99" class="text-center">Nenhum pergunta encontrada encontrada.</td>
            </tr>
        <?php endif ?>
        <div class="col-lg-8 mx-auto">
            <?php if ($mensagemFlash) : ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?= $mensagemFlash ?>
                </div>
            <?php endif ?>
        </div>
        <?php foreach ($perguntas as $pergunta) : ?>
            <div class="container">
                <div class="card col-lg-8 mx-auto" style="background-color:#eee;">

                    <div class="row">
                        <div class="col-sm-6 mx-auto">
                            <img src="<?= URL_IMG . $pergunta->getFoto() ?>" class="card-img-top">
                        </div>
                        <div class="col-sm-6 card-body">
                            <h3 class="pergunta card-title"><?= $pergunta->getPergunta() ?></h3>
                            <br>
                            <p id="usuario" class="card-text"><?= "Usuario: " . $pergunta->getUsuario() ?>
                                <br> <?= "Dificuldade: " . $pergunta->getDificuldade() ?></p>
                            <a class="btn btn-xs btn-primary" href="<?= URL_RAIZ . 'perguntas/' . $pergunta->getId() . '/editar' ?>" title="Editar">
                                <span class="glyphicon glyphicon-pencil"></span>EDITAR
                            </a>
                            <form class="clearfix margin-bottom" action="<?= URL_RAIZ . 'perguntas/' . $pergunta->getId() ?>" method="post">
                                <input type="hidden" name="_metodo" value="DELETE">
                                <button type="submit" class="btn btn-xs btn-danger" title="Deletar">
                                    DELETAR
                                </button>
                            </form>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php
                        $alt = $pergunta->embaralhaPerguntas($pergunta);
                        for ($i = 1; $i <= 5; $i = $i + 1) :
                            if ($alt[$i] != null) : ?>
                                <a href="<?= URL_RAIZ . 'perguntas/' . $alt[$i] . '/' . $pergunta->getId() ?>">
                                    <li class="list-group-item">
                                        <?= $alt[$i] ?>
                                    </li>
                                </a>
                            <?php endif ?>
                        <?php endfor ?>
                    </ul>
                    <br>
                </div>
            </div>
            <br>
        <?php endforeach ?>
    </table>
    <div class="container">
        <div class="row">
            <div class="mx-auto">
                <?php if ($pagina > 1) : ?>
                    <a href="<?= URL_RAIZ . 'perguntas?p=' . ($pagina - 1) ?>" class="btn" style="background-color:#eee;">
                        <</a> <?php endif ?> <?php if ($pagina < $ultimaPagina) : ?> <a href="<?= URL_RAIZ . 'perguntas?p=' . ($pagina + 1) ?>" class="btn" style="background-color:#eee;">>
                    </a>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
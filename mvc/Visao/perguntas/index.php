<div class="center-block site ">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <h1 class="navbar-brand" href="#">Sistema de perguntas</h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="perguntas">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="criar">Criar pergunta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="usuario/login">Logar</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <table class="table">
        <?php
        if (empty($perguntas)) : ?>
            <tr>
                <td colspan="99" class="text-center">Nenhum pergunta encontrada encontrada.</td>
            </tr>
        <?php endif ?>
        <?php foreach ($perguntas as $pergunta) : ?>
            <div class="card col-lg-8 mx-auto" style="background-color:#eee;">
                <img src="<?= PASTA_PUBLIC . $pergunta->getFoto() ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="pergunta card-title"><?= $pergunta->getPergunta()?></h5>
                    <p id="usuario" class="card-text"><?= "Usuario: " . $pergunta->getUsuario() ?></p>
                    <p id="dificuldade" class="card-text"><?= "Dificuldade: " . $pergunta->getDificuldade() ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <?php
                    $alt = $pergunta->embaralhaPerguntas($pergunta);
                    for ($i = 1; $i <= 5; $i = $i + 1) :
                        if ($alt[$i] != null) : ?>
                            <li class="list-group-item">
                                <form action=""> <?= $alt[$i] ?></form>
                            </li>
                        <?php endif ?>
                    <?php endfor ?>
                </ul>
                <br>
            </div>
            <br>
        <?php endforeach ?>
    </table>
</div>
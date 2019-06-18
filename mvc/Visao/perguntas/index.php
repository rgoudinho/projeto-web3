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
            <div class="card" style="width: 18rem;">
                <img src="<?=PASTA_PUBLIC . $pergunta->getFoto()?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="usuario"><?= $pergunta->getId_usuario() ?></h5>
                    <p class="pergunta"><?= $pergunta->getPergunta() ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <?php
                    $alt = $pergunta->embaralhaPerguntas($pergunta);
                    ?>
                    <?php 
                    if($alt[1] != null) : ?>
                        <li class="list-group-item"><?= $alt[1] ?></li>
                    <?php endif ?>
                    <?php 
                    if($alt[2] != null) : ?>
                        <li class="list-group-item"><?= $alt[2] ?></li>
                    <?php endif ?>
                    <?php 
                    if($alt[3] != null) : ?>
                        <li class="list-group-item"><?= $alt[3] ?></li>
                    <?php endif ?>
                    <?php 
                    if($alt[4] != null) : ?>
                        <li class="list-group-item"><?= $alt[4] ?></li>
                    <?php endif ?>
                    <?php 
                    if($alt[5] != null) : ?>
                        <li class="list-group-item"><?= $alt[5] ?></li>
                    <?php endif ?>
                </ul>
            </div>
        <?php endforeach ?>
    </table>
</div>
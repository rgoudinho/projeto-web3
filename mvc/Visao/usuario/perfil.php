<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h1 class="navbar-brand" href="#"><?= $usuario->getNome() ?></h1>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="perguntas">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="perfil">Perfil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-red" href="#">Criar pergunta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-red" href="cadastrar">Cadastrar</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
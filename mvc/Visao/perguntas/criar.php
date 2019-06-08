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
                <a class="nav-link" href="usuario/perfil">Perfil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-red" href="perguntas/criar">Criar pergunta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-red" href="usuario/cadastrar">Cadastrar</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<div class="d-flex justify-content-center">
    <div class="col-sm-8 col-lg-8">
        <h1 class="text-center">Criar perguntas</h1>
        <P>
            A pergunta deve ser objetiva, deve ter entre 2 a 5 opções de resposta,
            deve conter o nível de dificuldade e uma foto.
        </P>
        <form action="<?= URL_RAIZ . 'index' ?>" method="post" class="margin-bottom" enctype="multipart/form-data>
            <div class="form-group">
                <label for="pergunta">Pergunta*</label>
                <input type="text" class="form-control" id="Pergunta" placeholder="Qual é a capital do estado de São Paulo?">
            </div>
            <div class="form-group">
                <label for="respostaCorreta">Resposta correta*</label>
                <input type="text" class="form-control" id="respostaCorreta" placeholder="São Paulo">
            </div>
            <div class="form-group">
                <label for="respostaErrada1">Primeira resposta errada*</label>
                <input type="text" class="form-control" id="respostaErrada1" placeholder="Guarulhos">
            </div>
            <div class="form-group">
                <label for="respostaErrada2">Segunda resposta errada</label>
                <input type="text" class="form-control" id="respostaErrada2" placeholder="Campinas">
            </div>
            <div class="form-group">
                <label for="respostaErrada3">Terceira resposta errada</label>
                <input type="text" class="form-control" id="respostaErrada3" placeholder="São Bernardo do Campo">
            </div>
            <div class="form-group">
                <label for="respostaErrada4">Quarta resposta errada</label>
                <input type="text" class="form-control" id="respostaErrada4" placeholder="Santo André">
            </div>
            <label for="my-1 mr-2">Selecione o nivel de dificuldade</label>
            <select id="dificuldade" class="custom-select col-sm-2 col-lg-2">
                <option value="facil">Facíl</option>
                <option value="medio">Médio</option>
                <option value="dificil">Difícil</option>
            </select>
                Selecione uma imagem: <input name="arquivo" type="file" />
            <br/>
            <input id="foto" type="submit" value="Salvar"/>
        </form>
    </div>
</div>
<br>
<br>
<?php if ($mensagem) : ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= $mensagem ?>
    </div>
<?php endif ?>

<div class="d-flex justify-content-center">
    <div class="col-sm-8 col-lg-8">
        <h1 class="text-center">Criar perguntas</h1>
        <P>
            A pergunta deve ser objetiva, deve ter entre 2 a 5 opções de resposta,
            deve conter o nível de dificuldade e uma foto.
        </P>
        <form action="<?= URL_RAIZ . 'criar' ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="usuario">Usuario*</label>
                <input type="text" value="<?= $usuario->getNome() ?>" name="usuario" id="usuario" class="form-control">
            </div>
            <div class="form-group">
                <label for="pergunta">Pergunta*</label>
                <input type="text" class="form-control" id="pergunta" name="pergunta" placeholder="Qual é a capital do estado de São Paulo?">
            </div>
            <div class="form-group">
                <label for="respostaCorreta">Resposta correta*</label>
                <input type="text" class="form-control" name="resposta-correta" id="resposta-correta" placeholder="São Paulo">
            </div>
            <div class="form-group">
                <label for="respostaErrada1">Primeira resposta errada*</label>
                <input type="text" class="form-control" name="resposta-errada1" id="resposta-errada1" placeholder="Guarulhos">
            </div>
            <div class="form-group">
                <label for="respostaErrada2">Segunda resposta errada</label>
                <input type="text" class="form-control" name="resposta-errada2" id="resposta-errada2" placeholder="Campinas">
            </div>
            <div class="form-group">
                <label for="respostaErrada3">Terceira resposta errada</label>
                <input type="text" class="form-control" name="resposta-errada3" id="resposta-errada3" placeholder="São Bernardo do Campo">
            </div>
            <div class="form-group">
                <label for="respostaErrada4">Quarta resposta errada</label>
                <input type="text" class="form-control" name="resposta-errada4" id="resposta-errada4" placeholder="Santo André">
            </div>
            <label for="my-1 mr-2">Selecione o nivel de dificuldade</label>
            <select id="dificuldade" name="dificuldade" class="custom-select col-sm-2 col-lg-2">
                <option value="facil">Facíl</option>
                <option value="medio">Médio</option>
                <option value="dificil">Difícil</option>
            </select>
            Selecione uma imagem: <input name="foto" type="file" id="foto" />
            <br />
            <input id="foto" type="submit" value="Salvar" />
        </form>
    </div>
</div>
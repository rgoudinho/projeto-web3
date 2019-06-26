<br>
<br>
<?php
use Modelo\Usuario;
?>

<div class="d-flex justify-content-center">
    <div class="col-sm-8 col-lg-8">
        <h1 class="text-center">Editar pergunta</h1>
        <P>
            A pergunta deve ser objetiva, deve ter entre 2 a 5 opções de resposta,
            deve conter o nível de dificuldade e uma foto.
        </P>
        <form action="<?= URL_RAIZ . 'perguntas/' . $pergunta->getId() ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_metodo" value="PATCH">
            <div class="form-group">
                <label for="usuario">Usuario*</label>
                <input type="text" value="<?= Usuario::buscarNome($pergunta->getId_usuario()) ?>" name="usuario" id="usuario" class="form-control" disabled>
            </div>
            <div class="form-group">
                <label for="pergunta">Pergunta*</label>
                <input type="text" class="form-control" id="pergunta" name="pergunta" value="<?= $pergunta->getPergunta() ?>">
            </div>
            <div class="form-group">
                <label for="respostaCorreta">Resposta correta*</label>
                <input type="text" class="form-control" name="resposta-correta" id="resposta-correta" value="<?= $pergunta->getAlternativaCorreta() ?>">
            </div>
            <div class="form-group">
                <label for="respostaErrada1">Primeira resposta errada*</label>
                <input type="text" class="form-control" name="resposta-errada1" id="resposta-errada1" value="<?= $pergunta->getAlternativaErrada1() ?>">
            </div>
            <div class="form-group">
                <label for="respostaErrada2">Segunda resposta errada</label>
                <input type="text" class="form-control" name="resposta-errada2" id="resposta-errada2" value="<?= $pergunta->getAlternativaErrada2() ?>">
            </div>
            <div class="form-group">
                <label for="respostaErrada3">Terceira resposta errada</label>
                <input type="text" class="form-control" name="resposta-errada3" id="resposta-errada3" value="<?= $pergunta->getAlternativaErrada3() ?>">
            </div>
            <div class="form-group">
                <label for="respostaErrada4">Quarta resposta errada</label>
                <input type="text" class="form-control" name="resposta-errada4" id="resposta-errada4" value="<?= $pergunta->getAlternativaErrada4() ?>">
            </div>
            <label for="my-1 mr-2">Selecione o nivel de dificuldade</label>
            <select id="dificuldade" name="dificuldade" class="custom-select col-sm-2 col-lg-2">
                <option value="1">Facíl</option>
                <option value="2">Médio</option>
                <option value="3">Difícil</option>
            </select>
            <br>
            Selecione uma imagem: <input name="foto" type="file" id="foto">
            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'foto']) ?>
            <br />
            <input id="submiter" class="btn btn-primary center-block" type="submit" value="Editar" />
        </form>
    </div>
</div>
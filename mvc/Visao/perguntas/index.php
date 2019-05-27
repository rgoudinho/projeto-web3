<div class="center-block site ">
    <table class="table">
        <?php
        use Controlador\PerguntaControlador;
        if (empty($perguntas)) : ?>
            <tr>
                <td colspan="99" class="text-center">Nenhum pergunta encontrada encontrada.</td>
            </tr>
        <?php endif ?>
        <?php foreach ($perguntas as $pergunta) : ?>

            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="usuario"><?= $pergunta->getId_usuario() ?></h5>
                    <p class="pergunta"><?= $pergunta->getPergunta() ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <?php
                    $controlador = new PerguntaControlador();
                    $alt = $controlador->embaralhaPerguntas($pergunta);
                    ?>
                    <li class="list-group-item"><?= $alt[1] ?></li>
                    <li class="list-group-item"><?= $alt[2] ?></li>
                    <li class="list-group-item"><?= $alt[3] ?></li>
                    <li class="list-group-item"><?= $alt[4] ?></li>
                    <li class="list-group-item"><?= $alt[5] ?></li>
                </ul>
            </div>
        <?php endforeach ?>
    </table>
</div>
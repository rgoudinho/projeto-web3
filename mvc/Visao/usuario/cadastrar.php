<div class="bg-light col-xs-12 col-sm-8 col-md-4 centraliza-login-e-cadastro">
    <h1 class="text-center">Cadastrar</h1>
    <form action="<?= URL_RAIZ . 'usuario/cadastrar' ?>" method="post">
        <div class="form-group <?= $this->getErroCss('nome') ?>">
            <label for="nome">Nome</label>
            </br>
            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'nome']) ?>
            <input type="name" name="nome" class="form-control" id="nome" placeholder="Ronaldo Goudinho">
        </div>
        <div class="form-group <?= $this->getErroCss('email') ?>">
            <label class="control-label" for="email">Email *</label>
            </br>
            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'email']) ?>
            <input id="email" type="email" name="email" class="form-control" placeholder="email@example.com">
        </div>
        <div class="form-group <?= $this->getErroCss('senha') ?>">
            <label for="senha">Senha *</label>
            </br>
            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'senha']) ?>
            <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha">
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
    <p class="text-center">
        <a href="<?= URL_RAIZ . 'usuario/login' ?>" class="alert-link">Ir para a tela de Login</a>
    </p>
</div>
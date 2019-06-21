<div class="bg-light col-xs-12 col-sm-8 col-md-4 centraliza-login-e-cadastro">
    <h1 class="text-center">Logar</h1>
    <form action="<?= URL_RAIZ . 'usuario/login' ?>" method="post">
        <div class="form-group <?= $this->getErroCss('login') ?>">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="email@example.com">
        </div>
        <div class="form-group <?= $this->getErroCss('login') ?>">
            <label for="senha">Senha</label>
            <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha">
        </div>
        <div class="form-group text-danger text-center">
            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'login']) ?>
        </div>
        <button type="submit" class="btn btn-primary">Logar</button>
    </form>
    <p class="text-center">
        <a href="<?= URL_RAIZ . 'usuario/cadastrar' ?>" class="alert-link">Ir para a tela de Cadastro</a>
    </p>
</div>
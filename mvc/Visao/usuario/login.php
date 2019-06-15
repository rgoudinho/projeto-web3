
<div class="col-xs-12 col-sm-8 col-md-4 centraliza-login-e-cadastro">
    <form action="<?= URL_RAIZ . 'usuario/login' ?>" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="email@example.com">
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha">
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
        <p class="text-center">
            <a href="<?= URL_RAIZ . 'usuario/cadastrar' ?>">Cadastrar</a>
        </p>
    </form>
</div>
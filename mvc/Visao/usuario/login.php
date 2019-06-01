
<div class="col-xs-12 col-sm-8 col-md-4 centraliza">
    <form action="<?= URL_RAIZ . 'usuario/login' ?>" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="email@example.com">
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="dropdownCheck">
            <label class="form-check-label" for="dropdownCheck">
                Lembrar senha?
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
</div>
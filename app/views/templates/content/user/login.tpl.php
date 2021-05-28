<main class="form-signin p-3 m-auto">
    <form class="text-center" method="POST">
        <img class="mb-4" src="<?=IMG_URI.'logo.png'?>" alt="" width="50" height="50">
        <h1 class="h3 mb-3 fw-normal">Вход</h1>

        <div class="form-floating">
            <input type="text" class="form-control <?=$pageData['is_invalid']?>" id="floatingLogin" placeholder="Логин" name="login">
            <label for="floatingLogin">Логин</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control <?=$pageData['is_invalid']?>" id="floatingPassword" placeholder="Пароль" name="password">
            <label for="floatingPassword">Пароль</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Запомнить меня
            </label>
        </div>
        <?php if (!empty($pageData['error'])): ?>
            <div class="invalid-feedback my-3 d-block">
                <?=$pageData['error']?>
            </div>
        <?php endif;?>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>
        <p class="mt-4 mb-3 text-muted">© 2021</p>
    </form>
</main>
<aside class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark vh-100 position-fixed" id="sidebar">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <img class="me-3 filter-invert" src="<?= IMG_URI . 'logo.png' ?>" alt="" width="36" height="36">
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/"
               class="nav-link text-white <?= $pageData['controllerName'] == 'IndexController' ? 'active' : '' ?>"
               aria-current="page">
                <i class="bi bi-house-fill"></i>
                Главная
            </a>
        </li>
        <?php if (!empty($_SESSION['user'])): ?>
            <li class="nav-item">
                <a href="/reference/" class="nav-link text-white">
                    <i class="bi bi-question"></i>
                    Справка
                </a>
            </li>
            <li class="nav-item">
                <a href="/orders/" class="nav-link text-white">
                    <i class="bi bi-sliders"></i>
                    Заказы
                </a>
            </li>
            <?php if ($_SESSION['user']['LoginRoleID'] == USER_ROLES['MANAGER']): ?>
                <li class="nav-item">
                    <a href="/prices/" class="nav-link text-white">
                        <i class="bi bi-currency-dollar"></i>
                        Цены
                    </a>
                </li>
            <?php endif ?>
            <li class="nav-item">
                <a href="/handbook/" class="nav-link text-white">
                    <i class="bi bi-gear-fill"></i>
                    Справочники
                </a>
                <ul class="nav nav-pills flex-column ms-5 mb-2">
                    <li class="nav-item">
                        <a href="/handbook/prints/" class="text-white text-decoration-none"
                           aria-current="page">
                            Принты
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/handbook/sizes/" class="text-white text-decoration-none"
                           aria-current="page">
                            Размеры
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/handbook/materials/" class="text-white text-decoration-none"
                           aria-current="page">
                            Материалы
                        </a>
                    </li>
                    <?php if ($_SESSION['user']['LoginRoleID'] == USER_ROLES['MANAGER']): ?>
                        <li class="nav-item">
                            <a href="/handbook/partners/" class="text-white text-decoration-none"
                               aria-current="page">
                                Партнеры
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-white">
                    <i class="bi bi-graph-up"></i>
                    Аналитика
                </a>
                <ul class="nav nav-pills flex-column ms-5 mb-2">
                    <li class="nav-item">
                        <a href="/" class="text-white text-decoration-none"
                           aria-current="page">
                            Комиссия партнера
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
    <hr>
    <?php if (!empty($_SESSION['user'])): ?>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
               id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= IMG_URI ?>user_icon.svg" alt="" class="rounded-circle me-2" width="32" height="32">
                <strong><?= $_SESSION['user']['LoginName'] ?></strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1" style="">
                <li><a class="dropdown-item" href="/user">Профиль</a></li>
                <li><a class="dropdown-item" href="/user/logout">Выход</a></li>
            </ul>
        </div>
    <?php else: ?>
        <a class="btn btn-outline-light" href="/user/login">Вход</a>
    <?php endif; ?>
</aside>

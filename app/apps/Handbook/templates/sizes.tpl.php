<div class="container">
    <h1><?= $pageData['title'] ?></h1>
    <div>
        <div class="d-flex flex-row mb-3">
            <?php if ($sessUser->LoginRoleID == USER_ROLES['MANAGER']): ?>
                <a class="btn btn-primary h-max-content me-3" type="button" title="Добавить заказ" data-bs-toggle="modal" data-bs-target="#addRowModal">
                    <i class="bi bi-plus-square"></i>
                </a>
            <?php endif; ?>
        </div>
        <div class="card">
            <?php if (!empty($pageData['sizes'])): ?>
                <table class="table table-hover m-0">
                    <thead>
                    <tr>
                        <?php
                        foreach (array_keys($pageData['sizes'][0]) as $col):
                            ?>
                            <th scope="col"><?= $col ?></th>
                        <?php
                        endforeach;
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($pageData['sizes'] as $size):
                        ?>
                        <tr>
                            <th scope="row"><?= array_shift($size) ?></th>
                            <?php foreach ($size as $key => $col):
                                ?>
                                <td><?= $col ?></td>
                            <?php
                            endforeach;
                            ?>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="m-3">Ничего не найдено</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="modal fade" id="addRowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить заказ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3 d-flex flex-column">
                            <label class="form-label">Название размера</label>
                            <?php $key = 'SizeCodeSym' ?>
                            <label>
                                <input class="form-control" name="<?= $key ?>">
                            </label>
                        </div>
                        <div class="mb-3 d-flex flex-column">
                            <label class="form-label">Размер</label>
                            <?php $key = 'SizeCodeNum' ?>
                            <label>
                                <input class="form-control" name="<?= $key ?>">
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </div>
        </div>
    </div>

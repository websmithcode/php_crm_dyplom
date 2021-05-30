<div class="container">
    <h1><?= $pageData['title'] ?></h1>
    <div>
        <div class="d-flex flex-row mb-3">
            <a class="btn btn-primary h-max-content me-3" type="button" title="Добавить заказ" href="addpartner/">
                <i class="bi bi-plus-square"></i>
            </a>
        </div>
        <div class="card">
            <?php if (!empty($pageData['partners'])): ?>
                <table class="table table-hover m-0">
                    <thead>
                    <tr>
                        <?php
                        foreach (array_keys($pageData['partners'][0]) as $col):
                            ?>
                            <th scope="col"><?= $col ?></th>
                        <?php
                        endforeach;
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($pageData['partners'] as $partner):
                        ?>
                        <tr>
                            <th scope="row"><?= array_shift($partner) ?></th>
                            <?php foreach ($partner as $key => $col):
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
</div>

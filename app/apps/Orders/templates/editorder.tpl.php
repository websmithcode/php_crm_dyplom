<?php

use Core\Functions;

Functions::includeComponent('DateTimePicker');
?>
<div class="container">
    <div class="title d-flex">
        <a href="<?=Functions::getCurrentPath(-1)?>" class="btn btn-primary my-auto me-3"><i class="bi bi-arrow-left"></i></a>
        <h1><?= $pageData['title'] ?></h1>
    </div>
    <div>
        <div class="d-flex flex-row mb-3">
        </div>
            <?php if (!empty($pageData['order_rows'])): ?>
        <div class="card w-max-content">
                <form action="">
                <table class="table table-hover m-0">
                    <thead>
                    <tr>
                        <?php
                        foreach (array_keys($pageData['order_rows'][0]) as $col):
                            ?>
                            <th scope="col"><?= $col ?></th>
                        <?php
                        endforeach;
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($pageData['order_rows'] as $order_row):
                        $ID = array_shift($order_row);
                        ?>
                        <tr>
                            <th scope="row"><?= $ID ?></th>
                            <?php foreach ($order_row as $key => $col): ?>
                                <td>
                                    <label>
                                        <input class="form-control" type="text" value="<?= $col ?>">
                                    </label>
                                </td>
                            <?php
                            endforeach;
                            ?>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
                    <button class="btn btn-primary m-3">Сохранить</button>
                </form>
        </div>
            <?php else: ?>
        <div class="card">
                <p class="m-3">Ничего не найдено</p>
        </div>
            <?php endif; ?>
    </div>
</div>

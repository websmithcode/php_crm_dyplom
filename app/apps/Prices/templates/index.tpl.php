<?php

use Core\Functions;

Functions::includeComponent('DateTimePicker');
?>
<div class="container">
    <h1><?=$pageData['title']?></h1>
    <div>
        <div class="d-flex flex-row mb-3">
            <a class="btn btn-primary h-max-content me-3" type="button" title="Добавить заказ" href="addprice/">
                <i class="bi bi-plus-square"></i>
            </a>
            <button class="btn btn-primary h-max-content me-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFilters"
                    aria-expanded="false" aria-controls="collapseFilters">
                Фильтры
            </button>
            <div class="collapse w-100" id="collapseFilters">
                <div class="card card-body">
                    <form class="">
                        <div class="row">
                            <label class="form-label">Диапазон дат</label>
                            <div class="row">
                                <div class="input-group w-max-content">
                                    <div class="input-group-text">От</div>
                                    <?php new DateTimePicker('fromDate', 'fromTime'); ?>
                                </div>
                                <div class="input-group w-max-content">
                                    <div class="input-group-text">До</div>
                                    <?php new DateTimePicker('toDate', 'toTime'); ?>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a href="<?= Functions::getCurrentPath() ?>" class="btn btn-danger">Сбросить</a>
                            <button type="submit" class="btn btn-primary">Применить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <?php if (!empty($pageData['prices'])): ?>
                <table class="table table-hover m-0">
                    <thead>
                    <tr>
                        <?php
                        foreach (array_keys($pageData['prices'][0]) as $col):
                            ?>
                            <th scope="col"><?= $col ?></th>
                        <?php
                        endforeach;
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($pageData['prices'] as $price):
                        ?>
                        <tr>
                            <th scope="row"><?= array_shift($price) ?></th>
                            <?php foreach ($price as $key => $col):
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
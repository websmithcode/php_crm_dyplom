<?php

use Core\Functions;

Functions::includeComponent('DateTimePicker');
?>
<div class="container">
    <h1><?= $pageData['title'] ?></h1>
    <div>
        <div class="d-flex flex-row mb-3">
            <a class="btn btn-primary h-max-content me-3" type="button" title="Добавить цену" data-bs-toggle="modal" data-bs-target="#addPrice">
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
    <div class="modal fade" id="addPrice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить заказ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/prices/price" method="POST">
                        <div class="mb-3 d-flex flex-column">
                            <label class="form-label">Продукт</label>
                            <?php $key = 'ProductID' ?>
                            <label>
                                <select class="form-select" name="<?= $key ?>">
                                    <?php foreach ($pageData['products'] as $product): ?>
                                        <option value="<?= $product[$key] ?>"
                                        ><?=$product['PrintTypeName'] . ' ' . $product['MaterialName'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </label>
                        </div>
                        <div class="mb-3 d-flex flex-column">
                            <label class="form-label">Цена</label>
                            <label><input type="number" class="form-control" name="Price" value="0"></label>
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

<?php

use Core\Functions;

Functions::includeComponent('DateTimePicker');
?>
<div class="container">
    <h1><?= $pageData['title'] ?></h1>
    <div>
        <div class="d-flex flex-row mb-3">
            <a class="btn btn-primary h-max-content me-3" type="button" title="Добавить заказ" href="addorder/">
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
                        <?php if ($sessUser->LoginRoleID == USER_ROLES['MANAGER']): ?>
                            <div class="row">
                                <div class="input-group">

                                    <div class="form-floating flex-grow-1">
                                        <input class="form-control rounded-start rounded-0" id="partner"
                                               placeholder="Партнер"
                                               list="partnersDatalist"
                                               name="partner" value="<?= @$_GET['partner'] ?>">
                                        <label class="ms-3" for="partner">Партнер</label>
                                        <datalist id="partnersDatalist">
                                            <?php foreach ($pageData['partners'] as $p): ?>
                                                <option value="<?= $this->getPartnerOptionValue($p) ?>"></option>
                                            <?php endforeach; ?>
                                        </datalist>
                                    </div>
                                    <div class="partner-filter-info input-group-text hover-pointer"
                                         data-bs-toggle="popover">
                                        <i class="bi bi-info-circle"></i>
                                    </div>
                                </div>

                            </div>
                            <hr>
                        <?php endif; ?>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a href="<?= Functions::getCurrentPath() ?>" class="btn btn-danger">Сбросить</a>
                            <button type="submit" class="btn btn-primary">Применить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <?php if (!empty($pageData['orders'])): ?>
                <table class="table table-hover m-0">
                    <thead>
                    <tr>
                        <?php
                        foreach (array_keys($pageData['orders'][0]) as $col):
                            ?>
                            <th scope="col"><?= $col ?></th>
                        <?php
                        endforeach;
                        ?>
                        <th scope="col">Изменить</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($pageData['orders'] as $order):
                        $ID = array_shift($order);
                        ?>
                        <tr>
                            <th scope="row"><?= $ID ?></th>
                            <?php foreach ($order as $key => $col): ?>
                                <td><?= $col ?></td>
                            <?php
                            endforeach;
                            ?>
                            <td class="text-center"><a href="/orders/editorder?OrderID=<?= $ID ?>" class="btn btn-outline-warning"><i
                                            class="bi bi-pencil"></i></a></td>
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

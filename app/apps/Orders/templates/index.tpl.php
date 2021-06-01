<?php

use Core\Functions;

Functions::includeComponent('DateTimePicker');
?>
<div class="container">
    <h1><?= $pageData['title'] ?></h1>
    <div>
        <div class="d-flex flex-row mb-3">
            <a class="btn btn-primary h-max-content me-3" type="button" title="Добавить заказ" data-bs-toggle="modal" data-bs-target="#addOrder">
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
                        <th scope="col">Детали</th>
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
                            <td class="text-center"><a href="/orders/editorderdetails?OrderID=<?= $ID ?>" class="btn btn-outline-warning"><i class="bi bi-card-list"></i></a></td>
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
<div class="modal fade" id="addOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить заказ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/orders/order" method="POST">
                    <div class="mb-3 d-flex flex-column">
                        <label class="form-label">Дата заказа</label>
                        <?php new DateTimePicker('date', 'time', 'form-control w-max-content', true ,date("Y-m-d"), date("H:i:s") ) ?>
                    </div>
                    <div class="mb-3 d-flex flex-column">
                        <label class="form-label">Статус</label>
                        <?php $key = 'StateID' ?>
                        <label>
                            <select class="form-select" name="<?= $key ?>">
                                <?php foreach ($pageData['states'] as $state): ?>
                                    <option value="<?= $state[$key] ?>"
                                    ><?= $state['StateName'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>
                    <?php if ($sessUser->LoginRoleID == USER_ROLES['MANAGER']):?>
                    <div class="mb-3 d-flex flex-column">
                        <label class="form-label">Партнер</label>
                        <?php $key = 'PartnerID' ?>
                        <label>
                            <select class="form-select" name="<?= $key ?>">
                                <?php foreach ($pageData['partners'] as $partner): ?>
                                    <option value="<?= $partner[$key] ?>"
                                    ><?= $partner[$key] . '. ' . $partner['PartnerName'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>
                    <?php endif; ?>
                    <div class="mb-3 d-flex flex-column">
                        <label class="form-label">Клиент</label>
                        <?php $key = 'ClientID' ?>
                        <label>
                            <select class="form-select" name="<?= $key ?>">
                                <?php foreach ($pageData['clients'] as $client): ?>
                                    <option value="<?= $client[$key] ?>"
                                    ><?= $client[$key] . '. ' . $client['ClientSurname'] . ' ' . $client['ClientName'] . ' ' . $client['ClientMiddleName']?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
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

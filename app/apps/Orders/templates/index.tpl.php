<?php

use Core\Functions;

Functions::includeComponent('DateTimePicker');
?>
<div class="container">
    <h1>Заказы</h1>
    <div>
        <div class="d-flex flex-row mb-3">

            <button class="btn btn-primary h-max-content me-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFilters"
                    aria-expanded="false" aria-controls="collapseFilters">
                Фильтры
            </button>
            <div class="collapse w-100" id="collapseFilters">
                <div class="card card-body">
                    <form class="">
                        <div class="row">
                            <label class="form-label">
                                Диапазон дат
                            </label>
                            <div class="row">
                                <div class="input-group w-max-content">
                                    <div class="input-group-text">От
                                    </div><?php new DateTimePicker('fromDate', 'fromTime'); ?>
                                </div>
                                <div class="input-group w-max-content">
                                    <div class="input-group-text">До
                                    </div><?php new DateTimePicker('toDate', 'toTime'); ?>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <?php if ($_SESSION['user']['LoginRoleID'] == USER_ROLES['MANAGER']): ?>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                                        </svg>
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($pageData['orders'] as $order):
                        ?>
                        <tr>
                            <th scope="row"><?= array_shift($order) ?></th>
                            <?php foreach ($order as $key => $col):
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
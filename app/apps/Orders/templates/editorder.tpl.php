<?php

use Core\Functions;

Functions::includeComponent('DateTimePicker');
?>
<div class="container">
    <div class="title d-flex">
        <a href="<?= Functions::getCurrentPath(-1) ?>" class="btn btn-primary my-auto me-3"><i
                    class="bi bi-arrow-left"></i></a>
        <h1><?= $pageData['title'] ?></h1>
    </div>
    <div>
        <div class="d-flex flex-row mb-3">
        </div>
        <?php if (!empty($pageData['order_rows'])): ?>
            <div class="card w-max-content">
                <form method="get">
                    <table class="table table-hover m-0">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Материал</th>
                            <th scope="col">Тип принта</th>
                            <th scope="col">Размер</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Скидка %</th>
                            <th scope="col">Кол-во</th>
                            <th scope="col">Сумма</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($pageData['order_rows'] as $order_row):
                            ?>
                            <tr>
                                <th scope="row" class="id"><?= $order_row['OrderDetailID'] ?></th>
                                <td>
                                    <?php $key = 'MaterialID' ?>
                                    <label>
                                        <select class="form-select" name="<?= $key ?>">
                                            <?php foreach ($pageData['materials'] as $material): ?>
                                                <option value="<?= $material['MaterialID'] ?>"
                                                    <?= ($material['MaterialID'] == $order_row[$key] ? 'selected' : '') ?>
                                                >
                                                    <?= $material['MaterialName'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <?php $key = 'PrintTypeID' ?>
                                    <label>
                                        <select class="form-select" name="<?= $key ?>">
                                            <?php foreach ($pageData['printTypes'] as $printType): ?>
                                                <option value="<?= $printType['PrintTypeID'] ?>"
                                                    <?= ($printType['PrintTypeID'] == $order_row[$key] ? 'selected' : '') ?>
                                                >
                                                    <?= $printType['PrintTypeName'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <?php $key = 'SizeID' ?>
                                    <label>
                                        <select class="form-select" name="<?= $key ?>">
                                            <?php foreach ($pageData['sizes'] as $size): ?>
                                                <option value="<?= $size['SizeID'] ?>"
                                                    <?= ($size['SizeID'] == $order_row[$key] ? 'selected' : '') ?>
                                                >
                                                    <?= $size['SizeCodeSym'] . " - " . $size['SizeCodeNum'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <?php $key = 'Price' ?>
                                    <label>
                                        <input class="form-control" type="number" value="<?= $order_row[$key] ?>"
                                               name="<?= $key ?>">
                                    </label>
                                </td>
                                <td>
                                    <?php $key = 'DiscountID' ?>
                                    <label>
                                        <select class="form-select" name="<?= $key ?>">
                                            <?php foreach ($pageData['discounts'] as $discount): ?>
                                                <option value="<?= $discount['DiscountID'] ?>"
                                                    <?= ($discount['DiscountID'] == $order_row[$key] ? 'selected' : '') ?>
                                                        data-discount-value="<?= $discount['DiscountValue'] ?>"
                                                >
                                                    <?= $discount['DiscountName'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <?php $key = 'Quantity' ?>
                                    <label>
                                        <input class="form-control" type="number" value="<?= $order_row[$key] ?>"
                                               name="<?= $key ?>">
                                    </label>
                                </td>
                                <td>
                                    <?php $key = 'Summa' ?>
                                    <label>
                                        <input class="form-control" type="text" value="<?= $order_row[$key] ?>"
                                               name="<?= $key ?>"
                                               disabled
                                        >
                                    </label>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                        <a class="btn btn-primary m-3 w-max-content"><i class="bi bi-plus-lg"></i></a>
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

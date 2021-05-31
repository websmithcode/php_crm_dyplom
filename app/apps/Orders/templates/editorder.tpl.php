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
            <div class="card w-max-content min-w-100">
                <form method="post" action="<?= Functions::getCurrentPath(-1) ?>/updateOrder?<?=parse_url($_SERVER['REQUEST_URI'])['query'];?>">
                    <table class="table table-hover m-0">
                        <thead>
                        <tr>
                            <th scope="col" class="w-max-content">ID</th>
                            <th scope="col">Продукт</th>
                            <th scope="col" style="width: 200px">Тип</th>
                            <th scope="col" style="width: 200px">Размер</th>
                            <th scope="col" style="width: 130px">Цена</th>
                            <th scope="col" style="width: 200px">Скидка %</th>
                            <th scope="col" style="width: 90px">Кол-во</th>
                            <th scope="col" style="width: 130px">Сумма</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($pageData['order_rows'] as $order_row):
                            ?>
                            <tr data-order-detail-id="<?=$order_row['OrderDetailID']?>">
                                <th scope="row" class="id"><?= $order_row['OrderDetailID'] ?></th>
                                <td>
                                    <?php $key = 'ProductCostID' ?>
                                    <label>
                                        <select class="form-select" name="<?= $key ?>">
                                            <?php foreach ($pageData['productCostVariants'] as $productCost): ?>
                                                <option value="<?= $productCost['ProductCostID'] ?>"
                                                    <?= ($productCost['ProductCostID'] == $order_row[$key] ? 'selected' : '') ?>
                                                        data-price="<?=$productCost['Price']?>"
                                                ><?=$productCost['verboseName'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <?php $key = 'PrintID' ?>
                                    <label>
                                        <select class="form-select" name="<?= $key ?>">
                                            <?php foreach ($pageData['prints'] as $prints): ?>
                                                <option value="<?= $prints['PrintID'] ?>"
                                                    <?= ($prints['PrintID'] == $order_row[$key] ? 'selected' : '') ?>
                                                >
                                                    <?= $prints['PrintName'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <?php $key = 'SizeID' ?>
                                    <label class="w-100">
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
                                        <input class="form-control" type="text" value="<?= $order_row[$key] ?>"
                                               name="<?= $key ?>" disabled>
                                    </label>
                                </td>
                                <td>
                                    <?php $key = 'DiscountID' ?>
                                    <label class="w-100">
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
                    <button class="btn btn-primary m-3" type="submit">Сохранить</button>
                </form>
            </div>
        <?php else: ?>
            <div class="card">
                <p class="m-3">Ничего не найдено</p>
            </div>
        <?php endif; ?>
    </div>
</div>

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
                <form action="/orders/orderdetail">
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
                            <th scope="col" style="width: 50px">Удалить</th>
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
                                <td class="text-center">
                                    <button class="btn btn-danger delete-order-detail"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                    <a class="btn btn-primary m-3 w-max-content" data-bs-toggle="modal" data-bs-target="#addOrderDetail"><i class="bi bi-plus-lg"></i></a>
                    <button class="btn btn-primary m-3" type="submit">Сохранить</button>
                </form>
            </div>
        <?php else: ?>
            <div class="card">
                <p class="m-3">Ничего не найдено</p>
                <a class="btn btn-primary m-3 w-max-content" data-bs-toggle="modal" data-bs-target="#addOrderDetail"><i class="bi bi-plus-lg"></i></a>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="modal fade" id="addOrderDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить позицию</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/orders/orderdetail" method="POST">
                    <label>
                        <input type="text" value="<?=$_GET['OrderID']?>" name="OrderID" hidden>
                    </label>
                    <div class="mb-3">
                        <label class="w-100">Продукт:
                            <select class="form-select mt-2" name="ProductCostID">
                                <?php foreach ($pageData['productCostVariants'] as $productCost): ?>
                                    <option value="<?=$productCost['ProductCostID']?>">
                                        <?=$productCost['verboseName'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="w-100">Тип:
                            <select class="form-select mt-2" name="PrintID">
                                <?php foreach ($pageData['prints'] as $prints): ?>
                                    <option value="<?= $prints['PrintID'] ?>">
                                        <?= $prints['PrintName'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="w-100">Размер:
                            <select class="form-select mt-2" name="SizeID">
                                <?php foreach ($pageData['sizes'] as $size): ?>
                                    <option value="<?= $size['SizeID'] ?>">
                                        <?= $size['SizeCodeSym'] . " - " . $size['SizeCodeNum'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="w-100">Скидка:
                            <select class="form-select mt-2" name="DiscountID">
                                <?php foreach ($pageData['discounts'] as $discount): ?>
                                    <option value="<?= $discount['DiscountID'] ?>">
                                        <?= $discount['DiscountName'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="w-100">Кол-во:
                            <input class="form-control mt-2" type="number" name="Quantity" value="1">
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

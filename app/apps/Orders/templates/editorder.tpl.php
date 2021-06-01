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

    <div class="card p-4">
        <form action="/orders/order">
            <label>
                <input type="text" value="<?=$_GET['OrderID']?>" name="OrderID" hidden>
            </label>
            <div class="mb-3 d-flex flex-column">
                <label class="form-label">Дата заказа</label>
                <?php
                try {
                    $date = new DateTime($pageData['orderData']['OrderDate']);
                } catch (Exception $e) {
                    echo 'Date parse ERROR';
                    return;
                }
                ?>
                <?php new DateTimePicker('date', 'time', 'form-control w-max-content', true, date_format($date, "Y-m-d"), date_format($date, "H:i:s")) ?>
            </div>
            <div class="mb-3 d-flex flex-column">
                <label class="form-label">Статус</label>
                <?php $key = 'StateID' ?>
                <label>
                    <select class="form-select" name="<?= $key ?>">
                        <?php foreach ($pageData['states'] as $state): ?>
                            <option value="<?= $state[$key] ?>"
                                <?= $pageData['orderData'][$key] == $state[$key] ? 'selected' : '' ?>
                            ><?= $state['StateName'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>
            <div class="mb-3 d-flex flex-column">
                <label class="form-label">Партнер</label>
                <?php $key = 'PartnerID' ?>
                <label>
                    <select class="form-select" name="<?= $key ?>">
                        <?php foreach ($pageData['partners'] as $partner): ?>
                            <option value="<?= $partner[$key] ?>"
                                <?= $pageData['orderData'][$key] == $partner[$key] ? 'selected' : '' ?>
                            ><?= $partner[$key] . '. ' . $partner['PartnerName'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>
            <div class="mb-3 d-flex flex-column">
                <label class="form-label">Клиент</label>
                <?php $key = 'ClientID' ?>
                <label>
                    <select class="form-select" name="<?= $key ?>">
                        <?php foreach ($pageData['clients'] as $client): ?>
                            <option value="<?= $client[$key] ?>"
                                <?= $pageData['orderData'][$key] == $client[$key] ? 'selected' : '' ?>
                            ><?= $client[$key] . '. ' . $client['ClientSurname'] . ' ' . $client['ClientName'] . ' ' . $client['ClientMiddleName'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</div>

<?php
includeComponent('DateTimePickerComponent');

?>
<div class="container">
    <h1>Заказы</h1>
    <p>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilters"
                aria-expanded="false" aria-controls="collapseFilters">
            Фильтры
        </button>
    </p>
    <div class="collapse mb-3" id="collapseFilters">
        <div class="card card-body">
            <form class="">
                <div class="row">
                    <label class="form-label">
                        Диапазон дат
                    </label>
                    <div class="row">
                        <div class="input-group w-max-content">
                            <div class="input-group-text">От
                            </div><?php new DateTimePickerComponent('fromDate', 'fromTime'); ?>
                        </div>
                        <div class="input-group w-max-content">
                            <div class="input-group-text">До
                            </div><?php new DateTimePickerComponent('toDate', 'toTime'); ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a href="<?=getCurrentPath()?>" class="btn btn-danger">Сбросить</a>
                    <button type="submit" class="btn btn-primary">Применить</button>
                </div>
            </form>
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

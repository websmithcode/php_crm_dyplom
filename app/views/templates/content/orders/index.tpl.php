<div class="container">
    <h1>Заказы</h1>
    <div class="card">
    <table class="table table-hover m-0">
        <thead>
        <tr>
            <?php
            foreach (array_keys($pageData['orders'][0]) as $col):
            ?>
            <th scope="col"><?=$col?></th>
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
            <th scope="row"><?=array_shift($order)?></th>
            <?php foreach ($order as $key=>$col):
                ?>
                <td><?=$col?></td>
            <?php
            endforeach;
            ?>
        </tr>
        <?php
        endforeach;
        ?>
        </tbody>
    </table>
</div>
</div>

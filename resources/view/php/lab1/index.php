<?php

/**@var array $result **/
/**@var float $time **/
/**@var string $error **/
/**@var string $connectionType **/
/**@var string $command **/

$this->title = "Transport";

$keys =  current($result) ? array_keys(current($result)) : [];

$connection_types = [
     ['name' => 'odbc', 'label' => 'ODBC', 'default' => false],
     ['name' => 'jdbc', 'label' => 'JDBC', 'default' => true],
];

?>

<div class="container">
    <div class="row">
        <form action="/lab1/query" method="post">
            <div class="form-group">
                <label for="connectionType">Тип підключення:</label>
                <select class="form-control" id="connectionType" name="connectionType">
                    <?php foreach ($connection_types as $connect_type): ?>
                        <?php if ($connectionType == $connect_type['name']):?>
                            <option name="<?= $connect_type['name']?>" selected> <?= $connect_type['label']?></option>
                        <?php else: ?>
                            <option name="<?= $connect_type['name']?>"> <?= $connect_type['label']?></option>
                        <?php endif;?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="command">Запит:</label>
                <textarea class="form-control" id="command" name="command" rows="4"><?= $command ?? ''?></textarea>
            </div>
            <?php if (!empty($error)) :?>
                <div class="alert alert-secondary" role="alert">
                    <?= $error ?>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary mt-3 mb-3">Старт</button>
        </form>
    </div>
</div>


<div class="container">
    <?php if (!empty($result)):?>
        <table class="table table-bordered">
        <thead>
        <tr>
            <?php foreach ($keys as $th): ?>
                <th><?= $th ?></th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
<!--            --><?php //dd($result);?>
            <?php foreach ($result as $item): ?>
                <tr>
                    <?php foreach ($keys as $item_key): ?>
                        <td><?= $item[$item_key] ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
        <div class="container">
            <p class="mt-4">Час виконання запиту: <?= $time ?> seconds</p>
        </div>

    <?php else:?>
        <div>No result</div>
    <?php endif; ?>
</div>


<?php
use App\App;
/**@var array $result **/
/**@var float $time **/
/**@var string $error **/
/**@var string $connectionType **/
/**@var string $command **/

$this->title = "Lab 2";

$keys =  current($result) ? array_keys(current($result)) : [];



$connection_types = [
     ['name' => 'pdo', 'label' => 'Mysql', 'default' => false],
     ['name' => 'postgres', 'label' => 'Postgres', 'default' => true],
];


?>

<div class="container">
    <div class="row">
        <form action="/lab2/query" method="post">
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
    <?php endif; ?>
</div>

<?php if (!empty($all_db)) :?>

<div class="container roww">
            <?php foreach($all_db as $key_bd => $value_db): ?>

                <div class="col-sm-6 ">
                    <?php if ($key_bd == 'postgres'):?>
                        <p>Postgres</p>
                    <?php else:?>
                        <p>Mysql</p>
                    <?php endif;?>

                    <table class="table table-bordered">
                        <thead>
                            <tr>

                                <?php foreach (array_keys(current($value_db)) as $th): ?>
                                    <th><?= $th ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($value_db as $item): ?>

                                <tr>
                                    <?php foreach (array_keys(current($value_db)) as $item_key): ?>
                                        <td><?= $item[$item_key] ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>

            <div class="container">
                <p class="mt-4">Query execution time: <?= $time ?> seconds</p>
            </div>

    </div>
<?php endif; ?>


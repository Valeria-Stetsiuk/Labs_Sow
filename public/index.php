<?php

use app\App;

require_once '../bootstrap/bootstrap.php';
$config =  require_once sprintf('../config/main.php');

(new App($config))->run();
?>

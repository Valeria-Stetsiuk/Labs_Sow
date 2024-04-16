<?php

/**@var $styles **/
/**@var $page **/
/**@var $script **/
/**@var $title **/
use app\App;
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= $this->style ?? '';?>
    <?= $this->scripts ?? ''?>
    <title>
        <?= $this->title ?? '' ?>
    </title>
</head>
<body>
<div class="wrapper">
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item <?php echo App::getRouter()->getNameController() == 'site' ? 'active' : '' ?>">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item <?php echo App::getRouter()->getNameController() == 'lab1' ? 'active' : '' ?>">
                            <a class="nav-link" href="/lab1">Lab1</a>
                        </li>
                        <li class="nav-item <?php echo App::getRouter()->getNameController() == 'lab2' ? 'active' : '' ?>">
                            <a class="nav-link" href="/lab2">Lab2</a>
                        </li>
                    </ul>
                </div>

        </div>

    </header>
    <main>


        <div class="container">
            <?= $page ?>
        </div>
    </main>
    <footer></footer>
</div>
</body>

</html>
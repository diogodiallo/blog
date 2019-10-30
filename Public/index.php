<?php 

    const DEFAULT_APPLICATION = 'Frontend';

    if (!isset($_GET['app']) && !file_exists(__DIR__.'../App/'.$_GET['app'])) {
        $_GET['app'] = DEFAULT_APPLICATION;
    }

    // Load all folders

    require __DIR__.'/../Core/SplClassLoader.php';

    $coreLoader = new SplClassLoader('Core', __DIR__.'/..');
    $coreLoader->register();

    $appLoader = new SplClassLoader('App', __DIR__.'/..');
    $appLoader->register();

    $modelLoader = new SplClassLoader('Model', __DIR__.'/../Library');
    $modelLoader->register();

    $entityLoader = new SplClassLoader('Entity', __DIR__.'/../Library');
    $entityLoader->register();

    $formBuilderLoader = new SplClassLoader('FormBuilder', __DIR__.'/../Library');

    // Instantiate the class 

    $appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Application';
    $app = new $appClass;
    $app->run();
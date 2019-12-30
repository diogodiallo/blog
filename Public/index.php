<?php
const DEFAULT_APP = 'Frontend';
 
// If the application is not valid, we will load the default application which will generate a 404 error

if (!isset($_GET['app']) || !file_exists(__DIR__.'/../App/'.$_GET['app'])) $_GET['app'] = DEFAULT_APP;
 
// We start by including the class allowing us to record our autoloads
require __DIR__.'/../Library/Core/SplClassLoader.php';

//require '../vendor/autoload.php';
 
// We will then save the autoloads corresponding to each vendor (OCFram, App, Model, etc.)
$OCFramLoader = new SplClassLoader('Core', __DIR__.'/../Library');
$OCFramLoader->register();
 
$appLoader = new SplClassLoader('App', __DIR__.'/..');
$appLoader->register();
 
$modelLoader = new SplClassLoader('Model', __DIR__.'/../Library');
$modelLoader->register();
 
$entityLoader = new SplClassLoader('Entity', __DIR__.'/../Library');
$entityLoader->register();
 
$formBuilderLoader = new SplClassLoader('FormBuilder', __DIR__.'/../Library');
$formBuilderLoader->register();

$formBuilderLoader = new SplClassLoader('Mailer', __DIR__.'/../Library');
$formBuilderLoader->register();
 
 
// It only remains for us to deduce the name of the class and the instantiator
$appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Application';
 
$app = new $appClass;
$app->run();
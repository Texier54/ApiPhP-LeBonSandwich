<?php

require_once __DIR__.'/../src/vendor/autoload.php';

//Slim application instance
$conf = ['settings' => ['displayErrorDetails' => true]];
$app = new \Slim\App($conf);

//Eloquent ORM settings
require_once __DIR__.'/../src/config/db.php';

//Dependency Injection
require_once __DIR__.'/../src/config/private/dependencies.php';

//Routes definitions
require_once __DIR__.'/../src/config/private/routes.php';


$app->run();

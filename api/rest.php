<?php


require_once __DIR__.'/../src/vendor/autoload.php';


$config = parse_ini_file('../src/conf/lbs.db.conf.ini');

$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection( $config );
$db->setAsGlobal();
$db->bootEloquent();


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$error = require_once __DIR__.'/../src/conf/error.php';

$conf = ['settings' => ['displayErrorDetails' => true]];

//$conf = array_merge($conf, $error);
$app = new \Slim\App($conf);

$app->get('/hello/{name}', function (Request $req, Response $resp, $args) {
	$name = $args['name'];
	$resp->getBody()->write("Hello, $name");
	return $resp;
	}
);

$app->get('/categories[/]', function (Request $req, Response $resp, $args) {

	$c = new lbs\control\CatalogueController($this);
	return $c->getCategorie($req, $resp, $args);
}
);

$app->get('/categories/{id}', function (Request $req, Response $resp, $args) {

	$c = new lbs\control\CatalogueController($this);

	return $c->getDesc($req, $resp, $args);
	}
)->setName('catid');



$app->post('/categories[/]', function (Request $req, Response $resp, $args) {

	$c = new lbs\control\CatalogueController($this);

	return $c->createCategorie($req, $resp, $args);
	}
);

$app->run();
 
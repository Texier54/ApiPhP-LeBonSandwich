<?php


require_once __DIR__.'/../src/vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Slim application instance
$conf = ['settings' => ['displayErrorDetails' => true]];
$app = new \Slim\App($conf);

//Eloquent ORM settings
require_once __DIR__.'/db.php';

//Dependency Injection
require_once __DIR__.'/dependencies.php';

//Routes definitions
require_once __DIR__.'/routes.php';

$error = require_once __DIR__.'/../src/conf/error.php';


$app->get('/hello/{name}', function (Request $req, Response $resp, $args) {
	$name = $args['name'];
	$resp->getBody()->write("Hello, $name");
	return $resp;
	}
);

$app->get('/categories[/]', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);
	return $c->getCategorie($req, $resp, $args);
}
);

$app->get('/categories/{id}', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getDescCategorie($req, $resp, $args);
	}
)->setName('catid');



$app->get('/sandwichs/{id}', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getDescSandwich($req, $resp, $args);
	}
)->setName('sandid');



$app->get('/sandwichs[/]', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getSandwich($req, $resp, $args);
	}
);



$app->post('/categories[/]', function (Request $req, Response $resp, $args) {

	$c = new lbs\control\CatalogueController($this);

	return $c->createCategorie($req, $resp, $args);
	}
);

$app->put('/categories/{id}', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->updateCategorie($req, $resp, $args);
	}
);


$app->get('/categories/{id}/sandwichs', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getSandwichFromCategorie($req, $resp, $args);
	}
)->setName('sandFromCat');



$app->get('/sandwichs/{id}/categories', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getCategorieFromSandwich($req, $resp, $args);
	}
)->setName('catFromSand');



$app->get('/sandwichs/{id}/tailles', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getTailleFromSandwich($req, $resp, $args);
	}
)->setName('tailleFromSand');



$app->post('/commandes[/]', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->createCommande($req, $resp, $args);
	}
);


$app->get('/commandes/{id}', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getDescCommande($req, $resp, $args);
	}
)->setName('get_commande');


$app->run();
 
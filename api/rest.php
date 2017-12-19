<?php


require_once __DIR__.'/../src/vendor/autoload.php';

$config = parse_ini_file('../src/conf/lbs.db.conf.ini');

$db = new Illuminate\Database\Capsule\Manager();

$db->addConnection( $config );
$db->setAsGlobal();
$db->bootEloquent();


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Respect\Validation\Validator as v;
use \DavidePastore\Slim\Validation\Validation as Validation;

$error = require_once __DIR__.'/../src/conf/error.php';

$conf = ['settings' => ['displayErrorDetails' => true]];

//$conf = array_merge($conf, $error);
$app = new \Slim\App($conf);



function checkToken ( Request $rq, Response $rs, callable $next ) 
{
	// récupérer l'identifiant de cmmde dans la route et le token
	$id = $rq->getAttribute('route')->getArgument( 'id');
	$token = $rq->getQueryParam('token', null);

	// vérifier que le token correspond à la commande
	try 
	{
		\lbs\common\models\Commande::where('id', '=', $id)->where('token', '=',$token)->firstOrFail();

	} catch (ModelNotFoundException $e) {

		$rs= $rs->withStatus(404);

		$temp = array("type" => "error", "error" => '404', "message" => "Le token n'est pas valide");
			
		$rs->getBody()->write(json_encode($temp));
		return $rs;

	};

	return $next($rq, $rs);
};



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

	$validatorsCommandes = [
	'nom_client'    => v::StringType()->alpha()->length(3,30)->notEmpty(),
	'email_client'     => v::email()->notEmpty(),
	'livraison'   => [ 'date' => v::date('d-m-Y')->min( 'now' )->notEmpty(),
						'heure' =>v::date('h:i')->notEmpty(),
	] ];

$app->get('/commandes/{id}', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getDescCommande($req, $resp, $args);
	}
)->setName('comid')->add('checkToken')->add(new Validation( $validatorsCommandes));



	$validatorsComSand = [
	'sandwich'   => [ 'id_sandwich' => v::digit()->notEmpty(),
						'id_taille' =>v::digit()->notEmpty(),
							'qte'    => v::digit()->notEmpty(),
	] ];

$app->post('/commandes/{id}/sandwichs', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->createItem($req, $resp, $args);
	}
)->add('checkToken')->add(new Validation( $validatorsComSand));


$app->run();
 
<?php

require_once __DIR__.'/../src/vendor/autoload.php';

session_start();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Slim application instance
$conf = ['settings' => ['displayErrorDetails' => true]];
$app = new \Slim\App($conf);

//Eloquent ORM settings
require_once __DIR__.'/db.php';


use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Respect\Validation\Validator as v;
use \DavidePastore\Slim\Validation\Validation as Validation;

$error = require_once __DIR__.'/../src/conf/error.php';


// Fetch DI Container
$container = $app->getContainer();

// Register Twig View helper
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig('./templates', [
        'cache' => false
    ]);
    
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};

$container['csrf'] = function ($c) {
    return new \Slim\Csrf\Guard;
};



/************************************
        Routes
*************************************/


$app->get('/', function ($request, $response, $args) {

    if($_SESSION['pseudo'])
        $session = true;
    else
        $session = false;

    $arr = new \lbs\common\models\Categorie();

    $requete = $arr->get();

    return $this->view->render($response, 'index.html.twig', [
        'data' => $requete,
        'session' => $session,
    ]);
})->setName('liste');




$app->get('/categorie/{id}', function ($request, $response, $args) {

    if($_SESSION['pseudo'])
        $session = true;
    else
        $session = false;

    $arr = new \lbs\common\models\Categorie();

    $arr = $arr->where('id', '=', $args['id'])->firstOrFail();
    $requete = $arr->sandwichs()->select('id', 'nom', 'type_pain')->get();

    return $this->view->render($response, 'categorie.html.twig', [
        'data' => $requete,
        'session' => $session,
    ]);
})->setName('categorie');




$app->get('/connexion', function ($request, $response, $args) {

    if(isset($_SESSION['pseudo']))
        return $response->withRedirect($this->router->pathFor('liste'), 301);

    return $this->view->render($response, 'connexion.html.twig', []);

})->setName('connexion');




$app->get('/deconnexion', function ($request, $response, $args) {

    unset ($_SESSION['pseudo']);

    session_destroy();

    return $response->withRedirect($this->router->pathFor('liste'), 301);

})->setName('deconnexion');





$app->post('/connexion', function ($request, $response, $args) {

    $parsedBody = $request->getParsedBody();
    $arr = new \lbs\common\models\User();
            
    if(isset($parsedBody['pseudo']) && isset($parsedBody['password']))
    {
        
        try {

            $user = $arr->where('pseudo', '=', $parsedBody['pseudo'])->firstOrFail();

            if(password_verify($parsedBody['password'], $user->password))
            {

                $_SESSION['pseudo'] = $user->pseudo;

                return $response->withRedirect($this->router->pathFor('liste'), 301);
            }
            else
            {
                return $this->view->render($response, 'connexion.html.twig', []);
            }  
        } catch(\Exception $e) {
            return $this->view->render($response, 'connexion.html.twig', []);
        }


    }
    else 
    {
        return $this->view->render($response, 'connexion.html.twig', []);
    }

});




$app->get('/add_sandwich', function ($request, $response, $args) {

    if(!isset($_SESSION['pseudo']))
        return $response->withRedirect($this->router->pathFor('liste'), 301);

    if($_SESSION['pseudo'])
        $session = true;
    else
        $session = false;


    $arr = new \lbs\common\models\Categorie();
    $requetecateg = $arr->get();

    $arr = new \lbs\common\models\Taille();
    $requetetaille= $arr->get();


    $nameKey = $this->csrf->getTokenNameKey();
    $valueKey = $this->csrf->getTokenValueKey();
    $name = $request->getAttribute($nameKey);
    $value = $request->getAttribute($valueKey);

    return $this->view->render($response, 'addsand.html.twig', [
        'datacateg' => $requetecateg,
        'datataille' => $requetetaille,
        'session' => $session,
        'token' => $token,
        'nameKey' => $nameKey,
        'valueKey' => $valueKey,
        'name' => $name,
        'value' => $value,
    ]);

})->setName('addsand')->add($container->get('csrf'));




$app->post('/add_sandwich', function ($request, $response, $args) {

    if(!isset($_SESSION['pseudo']))
        return $response->withRedirect($this->router->pathFor('liste'), 301);

    if($_SESSION['pseudo'])
        $session = true;
    else
        $session = false;


    $sand = new \lbs\common\models\Sandwich();

    $sand->nom = $_POST['nom'];
    $sand->description = $_POST['description'];
    $sand->type_pain = $_POST['type'];
    $sand->img = $_POST['img'];
    $sand->save();

    return $response->withRedirect($this->router->pathFor('liste'), 301);


})->add($container->get('csrf'));



// Run app
$app->run();
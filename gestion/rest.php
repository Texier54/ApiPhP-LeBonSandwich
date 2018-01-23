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




// Define named route
$app->get('/categorie/{id}', function ($request, $response, $args) {

    $arr = new \lbs\common\models\Categorie();

    $arr = $arr->where('id', '=', $args['id'])->firstOrFail();
    $requete = $arr->sandwichs()->select('id', 'nom', 'type_pain')->get();

    return $this->view->render($response, 'categorie.html.twig', [
        'data' => $requete
    ]);
})->setName('categorie');




// Define named route
$app->get('/connexion', function ($request, $response, $args) {

    return $this->view->render($response, 'connexion.html.twig', []);

})->setName('connexion');



// Define named route
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

                return $response->withRedirect('/liste');
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





$app->get('/liste[/]', function ($request, $response, $args) {

    $arr = new \lbs\common\models\Categorie();

    $requete = $arr->get();

    return $this->view->render($response, 'index.html.twig', [
        'data' => $requete
    ]);
})->setName('liste');




// Run app
$app->run();
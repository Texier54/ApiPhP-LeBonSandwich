<?php

namespace lbs\api\control;

use lbs\common\models\Commande;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Respect\Validation\Validator as v;

// use Ramsey\Uuid\Uuid;
// use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

/**
* 
*/
class CommandeController extends BaseController
{
	// public function getCategories($request, $response, $args){

	// 	$categories = Category::all();

	// 	$response = $response->withStatus(201);
	// 	return $response->withJson($categories);
	// }

	// public function getCategory($request, $response, $args){

	// 	try{
	// 		$category = Category::findOrFail($args['id']);

	// 		return $response->withJson($category);
	// 	}
	// 	catch(ModelNotFoundException $e){
	// 		return $response->withJson(array(
	// 			'type' => 'error',
	// 			'error' => 404,
	// 			'message' => 'ressource non disponible : /categories/'.$args['id']
	// 		), 404);
	// 	}
	// }

	public function editCommande($request, $response, $args){
		$commande =  \lbs\common\models\Commande::where('id', '=', $args['id'])->first();

		$requestBody = $request->getParsedBody();

		if($request->getAttribute('has_errors')){
			$errors = $request->getAttribute('errors');
			$responseBody = [
				"type" => "error",
				"error" => 400,
				"message" => "Erreurs de validation",
				"errors" => $errors
			];
			return $response->withJson($responseBody)->withStatus(400);
		}else{
			$commande->nom = $requestBody['nom_client'];
			$commande->mail = $requestBody['mail_client'];
			//$commande->livraison = \Datetime::createFromFormat('d-m-Y H:i', $requestBody['livraison']);
			$commande->date = $requestBody['livraison']['date'];
			$commande->heure = $requestBody['livraison']['heure'];
			$commande->save();

			/*
			$commande->livraison = [
				"date" => date('d-m-Y', $commande->livraison->getTimestamp()),
				"heure" => date('H:i', $commande->livraison->getTimestamp())
			]; */

			return $response->withStatus(201)->withJson([
				"type" => "ressource",
				"commande" => $commande,
				"links" => ["self" => ["href" => $this->get('router')->pathFor('comid', ['id' => $commande->token])]]
			]);
		}

		return $response->withJson($commande);
	}

}

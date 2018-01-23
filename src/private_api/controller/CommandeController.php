<?php

namespace lbs\private_api\controller;

use lbs\common\models\Commande;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Respect\Validation\Validator as v;


/**
* Commande controller
*/
class CommandeController extends BaseController
{

	public function getCommandes($request, $response, $args){

		$sort_param = $request->getQueryParam('sort');
		$state_param = $request->getQueryParam('state');

		if(!is_null($state_param) && ($state_param === '0' || $state_param === '1' || $state_param === '2' || $state_param === '3' || $state_param === '4')){
			$commandes = Commande::where('etat', '=', $state_param);
		}else{
			$commandes = Commande::whereRaw('1 = 1');
		}

		if($sort_param == 'created_at'){

			//$commandes = Commande::orderBy('created_at', 'asc')->get();
			$commandes = $commandes->orderBy('created_at', 'asc')->get();
		}else{
			//TODO: trier par date de livraison
			//$commandes = Commande::all();
			$commandes = $commandes->get();
			$commandes = $commandes->sort(function($c1, $c2){
				$d1 = \DateTime::createFromFormat('d/m/Y h:i', $c1->date.' '.$c1->heure);
				$d2 = \DateTime::createFromFormat('d/m/Y h:i', $c2->date.' '.$c2->heure);
				return $d1 < $d2;
			});
		}
		$commandes_list = [];
		foreach ($commandes as $value) {
			$commandes_list[] = [
				"id" => $value->id,
				"nom" => $value->nom,
				"prenom" => $value->prenom,
				"mail" => $value->mail,
				"livraison" => [
					"date" => $value->date,
					"heure" => $value->heure
				],
				"etat" => $value->etat
				// "token" => $value->token,
				// "created_at" => $value->created_at,
				// "updated_at" => $value->updated_at
			];
		}
		$response_body = array(
			"type" => "collection",
			"meta" => [
				"count" => $commandes->count(),
				"date" => (new \Datetime())->format('m-d-Y')
			],
			"commandes" => $commandes_list
		);

		return $response->withJson($response_body);

	}

	public function getCommande($request, $response, $args){

		$commande = Commande::find($args['id']);

		$items = [];

		foreach ($commande->items as $value) {
			array_push($items, [
				"id" => $value->id,
				"taille_sandwich" => [
					"id" => $value->taille->id,
					"nom" => $value->taille->nom,
					"description" => $value->taille->description
				],
				"sandwich" => [
					"id" => $value->sandwich->id,
					"nom" => $value->sandwich->nom,
					"description" => $value->sandwich->description,
					"type_pain" => $value->sandwich->type_pain,
					"img" => $value->sandwich->img
				],
				"quantité" => $value->qte

			]);
		}

		$commande_finale[] = [
			"id" => $commande->id,
			"nom" => $commande->nom,
			"prenom" => $commande->prenom,
			"mail" => $commande->mail,
			"livraison" => [
				"date" => $commande->date,
				"heure" => $commande->heure
			],
			"etat" => $commande->etat,
			"items" => $items
		];

		$response_body = array(
			"type" => "ressource",
			"meta" => [
				"date" => (new \Datetime())->format('m-d-Y'),
				"local" => "fr-FR"
			],
			"commande" => $commande_finale
		);

		//$items = $commande->items;

		return $response->withJson($response_body);

	}


	public function editState($request, $response, $args){

		$commande = Commande::find($args['id']);

		$request_body = $request->getParsedBody();

		if($commande->state === 4){
			$response_body = [
				"type" => "error",
				"error" => 400,
				"message" => "Impossible de changer l'état d'une commande déjà livrée"
			];
			return $response->withJson($request_body)->withStatus(400);
		}else{
			if(!in_array($request_body['etat'], [2, 3, 4])){
				$response_body = [
					"type" => "error",
					"error" => 400,
					"message" => "La valeur de l'état n'est pas valide"
				];
				return $response->withJson($response_body)->withStatus(400);
			}else{
				if(($request_body['etat'] - 1) == $commande->etat){
					$commande->etat = $request_body['etat'];
					$commande->save();

					$commande_finale[] = [
						"id" => $commande->id,
						"nom" => $commande->nom,
						"prenom" => $commande->prenom,
						"mail" => $commande->mail,
						"livraison" => [
							"date" => $commande->date,
							"heure" => $commande->heure
						],
						"etat" => $commande->etat
					];

					$response_body = [
						"type" => "ressource",
						"meta" => [
							"date" => (new \Datetime())->format('m-d-Y'),
							"local" => "fr-FR"
						],
						"commande" => $commande_finale
					];

					return $response->withJson($response_body)->withStatus(201);
					
				}else{
					$response_body = [
						"type" => "error",
						"error" => 400,
						"message" => "Transition impossible"
					];
					return $response->withJson($response_body)->withStatus(400);
					}
			}
		}

	}

}
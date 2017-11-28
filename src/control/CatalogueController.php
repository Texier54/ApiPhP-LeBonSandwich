<?php

	namespace lbs\control;

	class CatalogueController {

	private $container;

		public function  __construct(\Slim\Container $c)
		{
			$this->container = $c;
		}

		public function getCategorie($req, $resp, $args) {

			// ajoute ou remplace
			$rs= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

			$arr = new \lbs\models\Sandwich();

			$arr = array('type' => 'collection', 'meta' => [ 'count' => 3, 'locale' => 'fr-FR'], 'categorie' => $arr->get());
			$rs->getBody()->write(json_encode($arr));

			return $rs;
		}

		public function getDesc($req, $resp, $args) {

			// ajoute ou remplace
			$rs= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

			$arr = new \lbs\models\Sandwich();

			try {
				$arr = $arr->where('id', '=', $args['id'])->firstOrFail();
				$temp = array('type' => 'collection', 'meta' => ['locale' => 'fr-FR'], 'categorie' => $arr);
			}
			catch(\Exception $e)
			{
				$url = $this->container['router']->pathFor('catid', [ 'id' => $args['id'] ]);

				$temp = array("type" => "error", "error" => '404', "message" => "ressource non disponible : ".$url);
			}
			
			$rs->getBody()->write(json_encode($temp));

			return $rs;


		}

		public function createCategorie($req, $resp, $args) {

			$parsedBody = $req->getParsedBody();



			if(isset($parsedBody['nom']) && isset($parsedBody['description']))
			{
				//return Write::json_error($rs, code:400, message:'Manque un truc');

				$categ = new \lbs\models\Categorie();
				$categ->nom = filter_var($parsedBody['nom'], FILTER_SANITIZE_STRING);
				$categ->description = filter_var($parsedBody['description'], FILTER_SANITIZE_STRING);

				try {
					$categ->save();
				} catch(\Exception $e) {
					echo 'erreur';
				}

				$resp= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

				$resp= $resp->withStatus(201);

				$resp = $resp->withHeader('Location', $this->container['router']->pathFor('catid', ['id' => $categ->id] ) );

				$resp->getBody()->write(json_encode($categ->toArray()));
				return $resp;
			}
		}
	}
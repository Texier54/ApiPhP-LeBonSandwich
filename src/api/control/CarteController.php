<?php

namespace lbs\api\control;

use lbs\common\models\Carte;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use \Firebase\JWT\JWT;

/**
* 
*/
class CarteController extends BaseController
{

	public function authenticate($request, $response, $args){
		$authorization_header = $request->getHeader('Authorization')[0];

		$tokenString = sscanf($authorization_header, 'Basic %s')[0];

		list($email, $password) = explode(':', base64_decode($tokenString));

		try{
			$carte = Carte::findOrFail($args['id']);

			if($carte->email != $email || !password_verify($password, $carte->password)){
				return $response->withJson(array(
					'type' => 'error',
					'error' => 401,
					'message' => 'Bad credentials'
				), 401);
			}

			$jwt = JWT::encode([
				'iss' => 'http://api.lbs.local',
				'iat' => time(),
				'exp' => time() + 3600,
				'carte' => $carte
			], 'secret', 'HS256');

			return $response->withJson(array('token' => $jwt));

		}catch(ModelNotFoundException $ex){
			return $response->withJson(array(
				'type' => 'error',
				'error' => 404,
				'message' => 'Ressource non trouvée /cartes/'.$args['id']
			), 404);
		}
			

		return $response->withJson(array('email' => $email, 'password' => $password));
	}

	public function getCarte($request, $response, $args){

		try{

			$carte = Carte::findOrFail($args['id']);

			$authorization_header = $request->getHeader('Authorization')[0];

			$jwt_token = sscanf($authorization_header, 'Bearer %s')[0];

			$decoded_token = JWT::decode($jwt_token, 'secret', array('HS256'));

			if($carte->id != $decoded_token->carte->id){
				return $response->withJson(array(
					'type' => 'error',
					'error' => 401,
					'message' => 'Accès refusé à la ressource /cartes/'.$args['id']
				), 401);
			}

			return $response->withJson([
				"id" => $carte->id,
			    "email" => $carte->email,
			    "date_creation" => $carte->date_creation,
			    "date_validite" => $carte->date_validite,
			    "nb_commandes" => $carte->nb_commandes
			]);

		}
		catch(ModelNotFoundException $ex){
			return $response->withJson(array(
				'type' => 'error',
				'error' => 404,
				'message' => 'Ressource non trouvée /cartes/'.$args['id']
			), 404);
		}
		catch(SignatureInvalidException $ex){
			return $response->withJson(array(
				'type' => 'error',
				'error' => 401,
				'message' => 'JWT token non valide'
			), 401);
		}
		catch(ExpiredException $ex){
			return $response->withJson(array(
				'type' => 'error',
				'error' => 401,
				'message' => 'JWT token expiré'
			), 401);
		}
		catch(BeforeValidException $ex){
			return $response->withJson(array(
				'type' => 'error',
				'error' => 401,
				'message' => 'token not yet valid'
			), 401);
		}


	}

}
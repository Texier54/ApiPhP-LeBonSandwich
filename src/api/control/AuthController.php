<?php

	namespace lbs\api\control;

	use Firebase\JWT\JWT;

	class AuthController {

	private $container;

		public function  __construct(\Slim\Container $c)
		{
			$this->container = $c;
		}

		public function authenticate($req, $resp, $args) {

			$rs= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

			if(!$req->hasHeader('Authorization')) {

				$rs = $rs->withHeader('WWW-authenticate', 'Basic realm="lbs api" ');
				$resp= $resp->withStatus(401);
				$temp = array("type" => "error", "error" => '401', "message" => "No Authorization in header");

				$rs->getBody()->write(json_encode($temp));

				return $rs;

			}

			$auth = base64_decode( explode( " ", $req->getHeader('Authorization')[0]) [1] );
			list($user, $pass) = explode(':', $auth);

			try {
				$carte = \lbs\common\models\Carte::select('id', 'nom', 'passwd')
					->where('id', '=', $args['id'])
					->where('nom', '=', $user)
					->firstOrFail();

				if(!password_verify($pass, $carte->passwd)) {
					throw new \Exception("Authentification incorrecte");

				}

			} catch(\Exception $e){

				$rs = $rs->withHeader('WWW-authenticate', 'Basic realm="lbs api" ');
				$resp= $resp->withStatus(401);
				$temp = array("type" => "error", "error" => '401', "message" => $e->getMessage());

				$rs->getBody()->write(json_encode($temp));

				return $rs;

			}

			$secret = 'lbs';

			$token = JWT::encode( [ 'iss'=>'http://api.lbs.local/auth',
				'aud'=>'http://api.lbs.local',
				'iat'=>time(), 
				'exp'=>time()+3600,
				'uid' =>  $carte->id], 
				$secret, 'HS512' );

			$resp= $resp->withStatus(201);

			$temp = array("token" => $token);

			$rs->getBody()->write(json_encode($temp));

			return $rs;
		}

		public function getCarte($request, $response, $args){

			try{

				$carte = \lbs\common\models\Carte::findOrFail($args['id']);
				$authorization_header = $request->getHeader('Authorization')[0];
				$jwt_token = sscanf($authorization_header, 'Bearer %s')[0];
				$decoded_token = JWT::decode($jwt_token, 'lbs', array('HS512'));

				if($carte->id != $decoded_token->uid){
					return $response->withJson(array(
						'type' => 'error',
						'error' => 401,
						'message' => 'Accès refusé à la ressource /cartes/'.$args['id']
					), 401);
				}
				return $response->withJson([
					"id" => $carte->id,
				    "date_creation" => $carte->date_creation,
				    "date_valide" => $carte->date_valide,
				    "cumul" => $carte->cumul
				]);
			} catch(\Illuminate\Database\Eloquent\ModelNotFoundException $ex){
				return $response->withJson(array(
					'type' => 'error',
					'error' => 404,
					'message' => 'Ressource non trouvée /cartes/'.$args['id']
				), 404);
			} catch(\Firebase\JWT\SignatureInvalidException $ex){
				return $response->withJson(array(
					'type' => 'error',
					'error' => 401,
					'message' => 'JWT token non valide'
				), 401);
			} catch(\Firebase\JWT\ExpiredException $ex){
				return $response->withJson(array(
					'type' => 'error',
					'error' => 401,
					'message' => 'JWT token expiré'
				), 401);
			} catch(\BeforeValidException $ex){
				return $response->withJson(array(
					'type' => 'error',
					'error' => 401,
					'message' => 'token not yet valid'
				), 401);
			}
		}


		public function payerCarte($request, $response, $args){

			$parsedBody = $request->getParsedBody();

			try{

				$carte = \lbs\common\models\Carte::findOrFail($args['id']);
				$authorization_header = $request->getHeader('Authorization')[0];
				$jwt_token = sscanf($authorization_header, 'Bearer %s')[0];
				$decoded_token = JWT::decode($jwt_token, 'lbs', array('HS512'));

				if($carte->id != $decoded_token->uid){
					return $response->withJson(array(
						'type' => 'error',
						'error' => 401,
						'message' => 'Accès refusé à la ressource /cartes/'.$args['id']
					), 401);
				}

				if(isset($parsedBody['carte_bc']) && isset($parsedBody['date_expiration_bc']))
				{
					$carte->cumul = $carte->cumul +1;
					$carte->save();
					return $response->withJson(array(
						'type' => 'message',
						'error' => 200,
						'message' => 'Paiement accépté'
					), 200);
				}
				else
				{

					$resp= $response->withStatus(400);

					$temp = array("type" => "error", "error" => '400', "message" => "Donnée manquante");
					
					$resp->getBody()->write(json_encode($temp));

					return $resp;	
				}


			} catch(\Illuminate\Database\Eloquent\ModelNotFoundException $ex){
				return $response->withJson(array(
					'type' => 'error',
					'error' => 404,
					'message' => 'Ressource non trouvée /cartes/'.$args['id']
				), 404);
			} catch(\Firebase\JWT\SignatureInvalidException $ex){
				return $response->withJson(array(
					'type' => 'error',
					'error' => 401,
					'message' => 'JWT token non valide'
				), 401);
			} catch(\Firebase\JWT\ExpiredException $ex){
				return $response->withJson(array(
					'type' => 'error',
					'error' => 401,
					'message' => 'JWT token expiré'
				), 401);
			} catch(\Firebase\JWT\BeforeValidException $ex){
				return $response->withJson(array(
					'type' => 'error',
					'error' => 401,
					'message' => 'token not yet valid'
				), 401);
			} catch(\DomainException $ex){
				return $response->withJson(array(
					'type' => 'error',
					'error' => 401,
					'message' => 'Domain Exception !!!!'
				), 401);
			} catch(\UnexpectedValueException $ex){
				return $response->withJson(array(
					'type' => 'error',
					'error' => 401,
					'message' => 'UnexpectedValueException'
				), 401);
			}
		}

		public function createCard($request, $response, $args){

	        if ($request->getAttribute( 'has_errors' )) {
	            $response= $response->withStatus(400);
	            $temp = array("type" => "error", "error" => '400', "message" => "Donnée manquante");
	            
	            $response->getBody()->write(json_encode($temp));
	            return $response;   
	        } 
	        else {
	            $parsedBody = $request->getParsedBody();
	            $carte = new \lbs\common\models\Carte();
	            $carte->nom = $parsedBody['nom'];
	            $carte->passwd = password_hash($parsedBody['password'], PASSWORD_DEFAULT);
		        $carte->cumul = '0';
		        $carte->date_creation = (new \Datetime())->format('Y-m-d H:i:s');
		        $carte->date_valide = (new \Datetime())->modify('+1 year')->format('Y-m-d H:i:s');
		                
	            try {
	                $carte->save();
	            } catch(\Exception $e) {
	                echo $e->getmessage();
				}
				
                $response= $response->withHeader( 'Content-type', "application/json;charset=utf-8");
                $response= $response->withStatus(201);
                $tab = [
                    'id' => $carte->id,
                    'nom' => $carte->nom,
                    'cumule' => $carte->cumul,
                    'date de validité' => $carte->date_valide,
                    'date de création' => $carte->date_creation
                ];
                $response->getBody()->write(json_encode($tab));
                return $response;
            }
        }

}
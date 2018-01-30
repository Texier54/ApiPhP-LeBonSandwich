<?php

	use \DavidePastore\Slim\Validation\Validation as Validation;
	use Respect\Validation\Validator as v;

	// $translator = function($message){
	// 	$messages = [
	// 		'These rules must pass for {{name}}' => 'Queste regole devono passare per {{name}}',
	// 		'{{name}} must be valid email' => '{{name}} doit être une adresse mail valide',
	// 		'{{name}} must not be blank' => 'Le champs {{name}} est obligatoire',
	// 		'{{name}} must be a valid date. Sample format: {{format}}' => 'La date de livraison doit être en format jj-mm-aaaa hh:'
	// 	];
	// 	return $messages[$message];
	// };

/*
	$commandeValidators = [
		"nom_client" => v::notBlank(),
		"mail_client" => v::notBlank()->email(),
		"livraison" => v::date('d-m-Y H:i')->min('now')
	]; */

	
	$validatorsCommandes = [
	'nom_client'    => v::StringType()->alpha()->length(3,30)->notEmpty(),
	'mail_client'     => v::email()->notEmpty(),
	'livraison'   => [ 'date' => v::date('d-m-Y')->min( 'now' )->notEmpty(),
						'heure' =>v::date('h:i')->notEmpty(),
	]];

	$app->put('/commandes/{id}[/]', 'CommandeController:editCommande')->setName('put_command')->add(new Validation($validatorsCommandes));
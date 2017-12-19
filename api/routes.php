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

	$commandeValidators = [
		"mail" => v::notBlank()->email(),
		"nom" => v::notBlank(),
		"prenom" => v::notBlank(),
		"livraison" => v::date('d-m-Y H:i')->min('now')
	];

	$app->put('/commandes/{id}[/]', 'CommandeController:editCommande')->setName('put_command')->add(new Validation($commandeValidators));
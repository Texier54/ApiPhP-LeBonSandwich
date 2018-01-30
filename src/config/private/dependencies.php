<?php

	//Dependency Injection

	use \lbs\private_api\controller\CommandeController;

	$container = $app->getContainer();

	$container['CommandeController'] = function($c){
		return new CommandeController($c);
	};
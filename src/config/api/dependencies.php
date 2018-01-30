<?php

	$container = $app->getContainer();

	$container['CommandeController'] = function($c){
		return new lbs\api\control\CommandeController($c);
	};

	$container['CarteController'] = function($c){
		return new lbs\api\control\CarteController($c);
	};

	// $container['CategoryController'] = function($c){
	// 	return new \lbs\control\CategoryController($c);
	// };

	// //Error handlers

	// $container['notFoundHandler'] = function ($c) {
	//     return function ($request, $response) use ($c) {
	//         return $c['response']
	//             ->withStatus(400)
	//             ->withHeader('Content-type', 'application/json')
	//             ->withJson(array(
	//             		'type' => 'error',
	//             		'error' => 400,
	//             		'message' => 'Route not found'
	//             		));
	//     };
	// };

	// $container['notAllowedHandler'] = function ($c) {
	//     return function ($request, $response, $methods) use ($c) {
	//         return $c['response']
	//             ->withStatus(405)
	//             ->withHeader('Allow', implode(', ', $methods))
	//             ->withHeader('Content-type', 'application/json')
	//             ->withJson(array(
	//             		'type' => 'error',
	//             		'error' => 405,
	//             		'message' => 'Allowed methods: '.implode(', ', $methods)
	//             		));
	//     };
	// };


	// $container['phpErrorHandler'] = function ($c) {
	//     return function ($request, $response, $error) use ($c) {
	//         return $c['response']
	//             ->withStatus(500)
	//             ->withHeader('Content-type', 'application/json')
	//             ->withJson(array(
	//             		'type' => 'error',
	//             		'error' => 500,
	//             		'message' => 'Internal Server Error'
	//             		));
	//     };
	// };
<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/commandes[/]', 'CommandeController:getCommandes')->setName('p_get_commandes');

$app->get('/commandes/{id}[/]', 'CommandeController:getCommande')->setName('p_get_commande');

$app->patch('/commandes/{id}/edit_state[/]', 'CommandeController:editState')->setName('p_edit_state');
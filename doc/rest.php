<?php

/**
 * File:  rest.php
 * Creation Date: 24/10/2017
 * description:
 *
 * @author: Islam/Batiste
 */

/**
 * @api {get} /categories  accéder à tout les catégories
 * @apiGroup Categories
 * @apiName GetCategories
 * @apiVersion 0.1.0
 *

 *
 * @apiDescription Accès à tout les ressources de type catégories :
 * permet d'accéder à la représentation des ressources categorie.
 * Retourne une représentation json des ressources, incluant leur nom et description.
 *
 *
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "collection,
 *        "meta" ; { "count" : 12, "locale" : "fr-FR" },
 *        categorie : {
 *            "id"  : 1 ,
 *            "nom" : "bio12",
 *            "description" : "sandwichs ingrédients bio et locaux"
 *        }
 *     }
 *
 */

$app->get('/categories[/]', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);
	return $c->getCategorie($req, $resp, $args);
}
);

/**
 * @api {get} /categories/{id}  accéder à une catégorie
 * @apiGroup Categories
 * @apiName GetCategorie
 * @apiVersion 0.1.0
 *

 *
 * @apiDescription Accès à une ressource de type catégorie :
 * permet d'accéder à la représentation de la ressource categorie désignée.
 * Retourne une représentation json de la ressource, incluant son nom et
 * sa description.
 * Le résultat inclut un lien pour accéder à la liste des sandwichs de cette catégorie.
 *
 * @apiParam {Number} id Identifiant unique de la catégorie
 *
 *
 * @apiSuccess (Succès : 200) {String} type type de la réponse, ici resource
 * @apisuccess (Succès : 200) {Object} meta méta-données sur la réponse
 * @apisuccess (Succès : 200) {Tring}  meta.date date de production de la réponse
 * @apisuccess (Succès : 200) {Object} categorie la ressource categorie retournée
 * @apiSuccess (Succès : 200) {Number} categorie.id Identifiant de la catégorie
 * @apiSuccess (Succès : 200) {String} categorie.nom Nom de la catégorie
 * @apiSuccess (Succès : 200) {String} categorie.description Description de la catégorie
 * @apiSuccess (Succès : 200) {Object} links liens vers les ressources associées à la catégorie
 * @apisuccess (Succès : 200) {Link}   links.sandwichs lien vers les sandwichs de la catégorie
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "resource,
 *        "meta" ; { "date" : "31-12-2017" },
 *        categorie : {
 *            "id"  : 4 ,
 *            "nom" : "végétarien",
 *            "description" : "sandwichs végétariens - peuvent contenir des produits laitiers"
 *        },
 *        links : {
 *            "sandwichs" : { "href" : "/categories/4/sandwichs" }
 *        }
 *     }
 *
 * @apiError (Erreur : 404) CategorieNotFound Categorie inexistante
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 404 Not Found
 *
 *     {
 *       "type" : "error',
 *       "error" : 404,
 *       "message" : ressource non disponible : /categories/42/"
 *     }
 */

$app->get('/categories/{id}', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getDescCategorie($req, $resp, $args);
	}
)->setName('catid');


/**
 * @api {get} /sandwichs/{id}  accéder à un sandwich
 * @apiGroup Sandwich
 * @apiName GetSandwich
 * @apiVersion 0.1.0
 *

 *
 * @apiDescription Accès à une ressource de type sandwich :
 * permet d'accéder à la représentation de la ressource sandwich désignée.
 * Retourne une représentation json de la ressource, incluant son nom,
 * sa description, son type de pain et une image.
 * Le résultat inclut un lien pour accéder à la liste des categories et les tailles de ce sandwich.
 *
 * @apiParam {Number} id Identifiant unique de la catégorie
 *
 *
 * @apiSuccess (Succès : 200) {String} type type de la réponse, ici resource
 * @apisuccess (Succès : 200) {Object} meta méta-données sur la réponse
 * @apisuccess (Succès : 200) {Tring}  meta.locale langue de la réponse
 * @apisuccess (Succès : 200) {Object} sandwich la ressource sandwich retournée
 * @apiSuccess (Succès : 200) {Number} sandwich.id Identifiant du sandwich
 * @apiSuccess (Succès : 200) {String} sandwich.nom Nom du sandwich
 * @apiSuccess (Succès : 200) {String} sandwich.description Description du sandwich
 * @apiSuccess (Succès : 200) {String} sandwich.type_pain Type de pain du sandwich
 * @apiSuccess (Succès : 200) {String} sandwich.img Description de la catégorie
 * @apisuccess (Succès : 200) {Object} categorie la ressource categorie retournée
 * @apiSuccess (Succès : 200) {Number} categorie.id Identifiant de la catégorie
 * @apiSuccess (Succès : 200) {String} categorie.nom Nom de la catégorie
 * @apiSuccess (Succès : 200) {String} categorie.pivot Pivot de la catégorie
 * @apiSuccess (Succès : 200) {Number} categorie.pivot.sand_id Id du sandwich du pivot de la categorie
 * @apiSuccess (Succès : 200) {Number} categorie.pivot.cat_id Id de la categorie du pivot
 * @apisuccess (Succès : 200) {Object} tailles la ressource tailles retournée
 * @apiSuccess (Succès : 200) {Number} tailles.id Identifiant de la taille
 * @apiSuccess (Succès : 200) {String} tailles.nom Nom de la taille
 * @apiSuccess (Succès : 200) {String} tailles.prix Prix de la taille
 * @apiSuccess (Succès : 200) {Object} links liens vers les ressources associées au sandwichs
 * @apisuccess (Succès : 200) {Link}   links.categories lien vers les catégorie du sandwichs
 * @apisuccess (Succès : 200) {Link}   links.href route du lien vers les catégorie du sandwichs
 * @apisuccess (Succès : 200) {Link}   links.tailles lien vers la tailles du sandwich
 * @apisuccess (Succès : 200) {Link}   links.href route du lien vers la tailles du sandwichs
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "collection,
 *        "meta" ; { "locale" : "fr-FR" },
 *        sandwich : {
 *            "id"  : 4 ,
 *            "nom" : "végétarien",
 *            "description" : "n sandwich de bucheron : frites, fromage, saucisse, steack, lard grillé, mayo",
 *            "type_pain" : "sandwichs végétariens - peuvent contenir des produits laitiers",
 *            "img" : "null"
 *        },
 *        categories : {
 *            "id"  : 3 ,
 *            "nom" : "traditionnel",
 *            "pivot" : {
 *            	"sand_id" : "4",
 *            	"cat_id" : "3"
 * 			  }
 *        },
 *        tailles : {
 *            "id"  : 4 ,
 *            "nom" : "complet",
 *            "prix" : "6.00"
 *        },
 *        links : {
 *            "categories" : {
 *            	"href" : "/rest.php/sandwichs/4/categories"
 * 			  },
 *            "tailles" : {
 *            	"href" : "/rest.php/sandwichs/4/tailles"
 * 			  }
 *        }
 *     }
 *
 * @apiError (Erreur : 404) SandwichNotFound Sandwich inexistante
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 404 Not Found
 *
 *     {
 *       "type" : "error",
 *       "error" : 404,
 *       "message" : "ressource non disponible : /sandwich/4/"
 *     }
 */
$app->get('/sandwichs/{id}', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getDescSandwich($req, $resp, $args);
	}
)->setName('sandid');


/**
 * @api {get} /sandwichs  accéder à tout les sandwichs
 * @apiGroup Sandwich
 * @apiName GetSandwichs
 * @apiVersion 0.1.0
 *

 *
 * @apiDescription Accès à tout les ressources de type sandwichs :
 * permet d'accéder à la représentation des ressources categorie.
 * Retourne une représentation json des ressources, incluant leur nom et description.
 *
 *
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "collection,
 *        "meta" ; { "count" : 111, "size" : 10, "locale" : "fr-FR" },
 *        sandwichs : {
 *            "id"  : 4 ,
 *            "nom" : "le bucheron",
 *            "type_pain" : "baguette campagne"
 *        },
 *        "links" : {
 *        	"href" : "/rest.php/sandwichs/4"
 * 		  }
 *     }
 *
 */

$app->get('/sandwichs[/]', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getSandwich($req, $resp, $args);
	}
);


/**
 * @api {post} /categories/  créer une catégorie
 * @apiGroup Categories
 * @apiName CreateCategorie
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Création d'une ressource de type Catégorie.
 * La catégorie est ajoutée dans la base, son identifiant est créé.
 * Le nom et la description de la catégorie doivent être fournis.
 * La réponse retournée indique l'uri de la nouvelle ressource dans le header Location: et contient
 * la représentation de la nouvelle ressource.
 *
 *
 * @apiParam  (request parameters) {String} nom Nom de la nouvelle catégorie
 * @apiParam  (request parameters) {String} description Description de la catégorie
 * @apiHeader (request headers) {String} Content-Type:=application/json format utilisé pour les données transmises
 *
 * @apiParamExample {request} exemple de paramètres
 *     {
 *       "nom"         : "chaud",
 *       "description" : "Tous nos sandwichs chauds"
 *     }
 *
 * @apiExample Exemple de requête :
 *    POST /categories/ HTTP/1.1
 *    Host: api.lbs.local
 *    Content-Type: application/json;charset=utf8
 *
 *    {
 *       "nom"         : "chaud",
 *       "description" : "Tous nos sandwichs chauds"
 *    }
 *
 * @apiSuccess (Réponse : 201) {json} categorie représentation json de la nouvelle catégorie
 *
 * @apiHeader (response headers) {String} Location: uri de la ressource créée
 * @apiHeader (response headers) {String} Content-Type: format de représentation de la ressource réponse
 *
 * @apiSuccessExample {response} exemple de réponse en cas de succès
 *     HTTP/1.1 201 CREATED
 *     Location: http://api.lbs.local/categories/42
 *     Content-Type: application/json;charset=utf8
 *
 *     {
 *        "type" : "resource,
 *        "meta" ; { "date" : "31-12-2017" },
 *        categorie : {
 *            "id"  : 42 ,
 *            "nom" : "fromages",
 *            "description" : "Tous nos fromages, bio et au lait cru"
 *        },
 *        links : {
 *            "sandwichs" : { "href" : "/categories/42/sandwichs" }
 *        }
 *     }
 *
 * @apiError (Réponse : 400) MissingParameter paramètre manquant dans la requête
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 400 Bad Request
 *     {
 *       "type": "error",
 *       "error" : 400,
 *       "message" : "donnée manquante (description)"
 *     }
 */

$app->post('/categories[/]', function (Request $req, Response $resp, $args) {

	$c = new lbs\control\CatalogueController($this);

	return $c->createCategorie($req, $resp, $args);
	}
);

/**
 * @api {put} /categories/{id}  modifier une catégorie
 * @apiGroup Categories
 * @apiName UpdateCategorie
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription modification de la ressource Catégorie cible.
 * La catégorie doit exister, et est entièrement remplacée par celle transmise.
 * La requête doit obligatoirement fournir le nom et la description de la catégorie
 *
 *
 * @apiParam {Number} id identifiant de la catégorie ciblée
 * @apiParam  (request parameters) {String} nom Nom de la nouvelle catégorie
 * @apiParam  (request parameters) {String} description Description de la catégorie
 * @apiHeader (request headers) {String} Content-Type:=application/json format utilisé pour les données transmises
 *
 * @apiParamExample {request} exemple de paramètres
 *     {
 *       "nom"         : "chauds",
 *       "description" : "Tous nos sandwichs chauds"
 *     }
 *
 * @apiExample Exemple de requête :
 *    PUT /categories/8 HTTP/1.1
 *    Host: api.lbs.local
 *    Content-Type: application/json;charset=utf8
 *
 *    {
 *       "nom"         : "chaud",
 *       "description" : "Tous nos sandwichs chauds"
 *    }
 *
 * @apiSuccess (Réponse : 200) {json} categorie représentation json de la nouvelle catégorie
 *
 * @apiHeader (response headers) {String} Content-Type: format de représentation de la ressource réponse
 *
 * @apiSuccessExample {response} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *     Content-Type: application/json;charset=utf8
 *
 *     {
 *        "type" : "resource,
 *        "meta" ; { "date" : "31-12-2017" },
 *        categorie : {
 *            "id"  : 42 ,
 *            "nom" : "cahuds",
 *            "description" : "Tous nos sandwichs chauds
 *        },
 *        links : {
 *            "sandwichs" : { "href" : "/categories/42/sandwichs" }
 *        }
 *     }
 *
 * @apiError (Réponse : 400) MissingParameter paramètre manquant dans la requête
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur 400
 *     HTTP/1.1 400 Bad Request
 *     {
 *       "type": "error",
 *       "error" : 400,
 *       "message" : "donnée manquante (description)"
 *     }
 * @apiError (Réponse : 404) RessourceNotFound ressource catégorie inexistante
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur 404
 *     HTTP/1.1 404 Not Found
 *     {
 *       "type": "error",
 *       "error" : 404,
 *       "message" : "ressource demandée inexistante : /categories/42/"
 *     }
 */
$app->put('/categories/{id}', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->updateCategorie($req, $resp, $args);
	}
);


/**
 * @api {get} /categories/{id}/sandwichs  accéder au sandwich d'une categorie
 * @apiGroup Categories
 * @apiName GetSandwichFromCategorie
 * @apiVersion 0.1.0
 *

 *
 * @apiDescription Accès à une ressource de type catégorie :
 * permet d'accéder à la représentation de la ressource categories du sandwich désignée.
 * Retourne une représentation json de la ressource, incluant son nom et son type de pain.
 * Le résultat inclut un lien pour accéder à ce sandwichs précis.
 *
 * @apiParam {Number} id Identifiant unique de la catégorie
 *
 *
 * @apiSuccess (Succès : 200) {String} type type de la réponse, ici resource
 * @apisuccess (Succès : 200) {Object} meta méta-données sur la réponse
 * @apisuccess (Succès : 200) {Tring}  meta.count nombre de résultat
 * @apisuccess (Succès : 200) {Tring}  meta.date date de production de la réponse
 * @apisuccess (Succès : 200) {Object} sandwichs les ressources sandwich retournée
 * @apisuccess (Succès : 200) {Object} sandwich la ressource sandwich retournée
 * @apiSuccess (Succès : 200) {Number} sandwich.id Identifiant du sandwich
 * @apiSuccess (Succès : 200) {String} sandwich.nom Nom du sandwich
 * @apiSuccess (Succès : 200) {String} sandwich.type_pain Type de pain du sandwich
 * @apiSuccess (Succès : 200) {Object} links liens vers les ressources associées au sandwichs
 * @apisuccess (Succès : 200) {Link}   links.href route du lien vers les catégorie du sandwichs
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "collection,
 *        "meta" ; { "count" : "1", "date" : "31-12-2017" },
 *        sandwichs : {
 *        	sandwich : {
 *        	    "id"  : "3",
 *        	    "nom" : "jambon-beurre",
 *        	    "type_pain" : "baguette",
 *        	},
 *        	links : {
 *        		"href" : "/rest.php/sandwichs/4/tailles"
 *        	}
 * 		  }
 *     }
 *
 * @apiError (Erreur : 404) SandwichNotFoundFromCategorie SandwichFromCategorie inexistante
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 404 Not Found
 *
 *     {
 *       "type" : "error",
 *       "error" : 404,
 *       "message" : "ressource non disponible : categories/{id}/sandwich"
 *     }
 */

$app->get('/categories/{id}/sandwichs', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getSandwichFromCategorie($req, $resp, $args);
	}
)->setName('sandFromCat');

/**
 * @api {get} /sandwichs/{id}/categories  accéder au categorie d'un sandwich
 * @apiGroup Sandwich
 * @apiName getCategorieFromSandwich
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à une ressource de type sandwichs :
 * permet d'accéder à la représentation de la ressource sandwichs de la catégorie désignée.
 * Retourne une représentation json de la ressource, incluant son nom, description,
 * et son pivot.
 * Le résultat inclut un lien pour accéder à cette catégorie.
 *
 * @apiParam {Number} id Identifiant unique de la catégorie
 *
 *
 * @apiSuccess (Succès : 200) {String} type type de la réponse, ici resource
 * @apisuccess (Succès : 200) {Object} meta méta-données sur la réponse
 * @apisuccess (Succès : 200) {Tring}  meta.count nombre de résultat
 * @apisuccess (Succès : 200) {Tring}  meta.date date de production de la réponse
 * @apisuccess (Succès : 200) {Object} categories les ressources categories retournée
 * @apisuccess (Succès : 200) {Object} categorie la ressource categorie retournée
 * @apiSuccess (Succès : 200) {Number} categorie.id Identifiant du categorie
 * @apiSuccess (Succès : 200) {String} categorie.nom Nom du categorie
 * @apiSuccess (Succès : 200) {String} categorie.description Description de la catégorie
 * @apiSuccess (Succès : 200) {Number} categorie.sand_id Id du sandwich de la categorie
 * @apiSuccess (Succès : 200) {Number} categorie.cat_id Id de la categorie
 * @apiSuccess (Succès : 200) {Number} categorie.pivot.sand_id Id du sandwich du pivot de la categorie
 * @apiSuccess (Succès : 200) {Number} categorie.pivot.cat_id Id de la categorie du pivot
 * @apiSuccess (Succès : 200) {Object} links liens vers les ressources associées à la categorie
 * @apisuccess (Succès : 200) {Link}   links.href route du lien vers la catégorie du sandwich
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "collection,
 *        "meta" ; { "count" : "2", "date" : "31-12-2017" },
 *        categories : {
 *        	categorie : {
 *        	    "id"  : "3",
 *        	    "nom" : "traditionnel",
 *        	    "description" : "sandwichs traditionnels : jambon, pâté, poulet etc ..",
 *        	    "sand_id" : "4",
 *        	    "cat_id" : "3"
 *        	},
 *        	pivot : {
 *        		"sand_id" : "4",
 *        		"cat_id" : "3"
 *        	}
 * 		  },
 *        links : {
 *        	"href" : "/rest.php/sandwichs/4/tailles"
 *        }
 *     }
 *
 * @apiError (Erreur : 404) CategorieNotFoundInSandwich CategorieFromSandwich inexistante
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 404 Not Found
 *
 *     {
 *       "type" : "error",
 *       "error" : 404,
 *       "message" : "ressource non disponible : /sandwichs/{id}/categories"
 *     }
 */

$app->get('/sandwichs/{id}/categories', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getCategorieFromSandwich($req, $resp, $args);
	}
)->setName('catFromSand');

/**
 * @api {get} /sandwichs/{id}/taille  accéder aux tailles d'un sandwich
 * @apiGroup Sandwich
 * @apiName getTailleFromSandwich
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à une ressource de type sandwichs :
 * permet d'accéder à la représentation de la ressource sandwichs et ces tailles disponibles.
 * Retourne une représentation json de la ressource, incluant son nom, prix,
 * et son pivot.
 *
 * @apiParam {Number} id Identifiant unique de la catégorie
 *
 *
 * @apiSuccess (Succès : 200) {String} type type de la réponse, ici resource
 * @apisuccess (Succès : 200) {Object} meta méta-données sur la réponse
 * @apisuccess (Succès : 200) {Tring}  meta.count nombre de résultat
 * @apisuccess (Succès : 200) {Tring}  meta.date date de production de la réponse
 * @apisuccess (Succès : 200) {Object} tailles les ressources tailles retournée
 * @apisuccess (Succès : 200) {Object} taille la ressource taille retournée
 * @apiSuccess (Succès : 200) {Number} taille.id Identifiant de la taille
 * @apiSuccess (Succès : 200) {String} taille.nom Nom de la taille
 * @apiSuccess (Succès : 200) {String} taille.prix Prix de la taille
 * @apiSuccess (Succès : 200) {Number} taille.pivot.sand_id Id du sandwich du pivot de la taille
 * @apiSuccess (Succès : 200) {Number} taille.pivot.taille_id Id de la taille du pivot
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "collection,
 *        "meta" ; { "count" : "4", "date" : "31-12-2017" },
 *        tailles : {
 *        	taille : {
 *        	   "id"  : "1",
 *        	   "nom" : "petite faim",
 *        	   "prix" : "6.00",
 *        	   "sand_id" : "4",
 *        	   "cat_id" : "3"
 *        	   pivot : {
 *        	      "sand_id" : "4",
 *        	      "cat_id" : "3"
 *        	   }
 * 		  }
 *     }
 *
 * @apiError (Erreur : 404) TailleNotFoundInSandwich TailleFromSandwich inexistante
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 404 Not Found
 *
 *     {
 *       "type" : "error",
 *       "error" : 404,
 *       "message" : "ressource non disponible : /sandwichs/{id}/taille"
 *     }
 */

$app->get('/sandwichs/{id}/tailles', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getTailleFromSandwich($req, $resp, $args);
	}
)->setName('tailleFromSand');



$app->post('/commandes[/]', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->createCommande($req, $resp, $args);
	}
);




$app->post('/commandes/{id}/paiement', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->payerCommande($req, $resp, $args);
	}
)->add('checkToken');



$app->get('/commandes/{id}', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getDescCommande($req, $resp, $args);
	}
)->setName('comid')->add('checkToken')->add(new Validation( $validatorsCommandes));


$app->post('/commandes/{id}/sandwichs', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->createItem($req, $resp, $args);
	}
)->add(new Validation( $validatorsCommandes))->add('checkToken');


$app->get('/cartes/{id}/auth', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\AuthController($this);

	return $c->authenticate($req, $resp, $args);
	}
);




$app->get('/cartes/{id}', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\AuthController($this);

	return $c->getCarte($req, $resp, $args);
	}
);


$app->post('/cartes/{id}/paiement', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\AuthController($this);

	return $c->payerCarte($req, $resp, $args);
	}
);

<?php

/**
 * File:  rest.php
 * Creation Date: 24/10/2017
 * description:
 *
 * @author: Islam
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


/**
 * @api {post} /commandes/  créer une commande
 * @apiGroup Commandes
 * @apiName CreateCommandes
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Création d'une ressource de type commandes.
 * La commande est ajoutée dans la base, son identifiant et token sont créé.
 * Le nom du client, la description du client et la date et heure
 * de la commande doivent être fournis.
 * La réponse retournée indique l'id et le token de la nouvelle ressource et contient.
 *
 *
 * @apiParam  (request parameters) {String} nom_cient Nom du client de la commande
 * @apiParam  (request parameters) {String} mail_client Mail du client de la commande
 * @apiParam  (request parameters) {String} livraison la ressource livraison fournis
 * @apiParam  (request parameters) {String} livraison.date date de la commande
 * @apiParam  (request parameters) {String} livraison.heure heure de la commande
 * @apiHeader (request headers) {String} Content-Type:=application/json format utilisé pour les données transmises
 *
 * @apiParamExample {request} exemple de paramètres
 *     {
 *       "nom_client"  : "jean mi",
 *       "mail_client" : "jm@gmal.com",
 * 		 "livraison"   : {
 * 			"date"	: "7-12-2017",
 * 			"heure" : "12:30"
 * 		 }
 *     }
 *
 * @apiSuccess (Réponse : 201) {json} commande représentation json de la nouvelle commande
 *
 * @apiHeader (response headers) {String} Location: uri de la ressource créée et l'id
 * @apiHeader (response headers) {String} Content-Type: format de représentation de la ressource réponse
 *
 * @apiSuccessExample {response} exemple de réponse en cas de succès
 *     POST /commandes/ HTTP/1.1
 *    Host: api.lbs.local
 *    Content-Type: application/json;charset=utf8
 * 	  Location: /commandes/e3786989-e0d2-4cfb-a72f-455ca4a16beb
 *
 *    {
 *       "nom_client"  : "jean mi",
 *       "mail_client" : "jm@gmal.com",
 * 		 "livraison"   : {
 * 			"date"	: "7-12-2017",
 * 			"heure" : "12:30"
 * 		 }
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

$app->post('/commandes[/]', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->createCommande($req, $resp, $args);
	}
)->add(new Validation( $validatorsCommandes));

/**
 * @api {post} /commandes/{id}/paiement  payer une commande
 * @apiGroup Commandes
 * @apiName PayerCommandes
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Création d'une ressource de type commandes.
 * La commande est payer.
 * Le numéro de la carte bancaire et ça date d'expriation doivent être fournis.
 * La réponse retournée indique l'id et le token de la nouvelle ressource.
 *
 *
 * @apiParam  (request parameters) {String} carte_bc Numéro de la carte bancaire
 * @apiParam  (request parameters) {String} date_expiration_bc Date d'expriation de la carte bancaire
 *
 * @apiParamExample {request} exemple de paramètres
 *     {
 *       "carte_bc"  : "5555555555555555",
 *       "date_expiration_bc" : "1/22"
 *     }
 *
 * @apiSuccess (Réponse : 200) {json} commande Paiement accépté
 *
 * @apiHeader (response headers) {String} Location: uri de la ressource créée et l'id
 * @apiHeader (response headers) {String} Content-Type: format de représentation de la ressource réponse
 *
 * @apiSuccessExample {response} exemple de réponse en cas de succès
 *     POST /commandes/ HTTP/1.1
 *    Host: api.lbs.local
 *    Content-Type: application/json;charset=utf8
 * 	  Location: /commandes/e3786989-e0d2-4cfb-a72f-455ca4a16beb
 *
 *    {
 *       "carte_bc"  : "5555555555555555",
 *       "date_expiration_bc" : "1/22"
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


$app->post('/commandes/{id}/paiement', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->payerCommande($req, $resp, $args);
	}
)->add('checkToken');

/**
 * @api {get} /commandes/{id}  accéder à une commande
 * @apiGroup Commandes
 * @apiName GetCommandes
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à une ressource de type commande :
 * permet d'accéder à la représentation de la ressource commande.
 * Retourne une représentation json de la ressource, incluant son nom, mail, date,
 * et son pivot.
 *
 * @apiParam {Number} id Identifiant unique de la catégorie
 *
 *
 * @apiSuccess (Succès : 200) {String} type type de la réponse, ici resource
 * @apisuccess (Succès : 200) {Object} meta méta-données sur la réponse
 * @apisuccess (Succès : 200) {Tring}  meta.locale langue de la réponse
 * @apisuccess (Succès : 200) {Object} commande la ressource commande retournée
 * @apiSuccess (Succès : 200) {Number} commande.id Identifiant de la commande
 * @apiSuccess (Succès : 200) {String} commande.nom Nom de la commande
 * @apiSuccess (Succès : 200) {String} commande.mail Mail de la commande
 * @apiSuccess (Succès : 200) {Number} commande.date Date de la commande
 * @apiSuccess (Succès : 200) {Number} commande.heure Heure de la commande
 * @apiSuccess (Succès : 200) {Number} commande.etat Etat de la commande
 * @apiSuccess (Succès : 200) {Number} commande.token Token de la commande
 * @apiSuccess (Succès : 200) {Number} commande.carte Carte de la commande
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "collection,
 *        "meta" ; { "locale":"fr-FR" },
 *        "taille" : {
 *           "id"  : "1",
 *           "nom" : "commande1",
 *           "mail" : mail@gmail.com",
 *           "date" : "0000-00-00",
 *           "heure" : "00:00:00"
 *           "etat" : "0",
 *            "token" : "1356431355332",
 *            "carte" : "5555632179"
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
 *       "message" : "ressource non disponible : /commandes/{id}"
 *     }
 */

$app->get('/commandes/{id}', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->getDescCommande($req, $resp, $args);
	}
)->setName('comid');


/**
 * @api {post} /commandes/{id}/sandwichs  ajout un sandwich a la commande
 * @apiGroup Commandes
 * @apiName PutSandwichToCart
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Création d'une ressource de type commandes.
 * Le sandwich à été ajouter a la commande.
 * L'id du sandwich, sa taille et sa quantité doivent être fournis.
 * La réponse retournée indique l'id et le token de la nouvelle ressource.
 *
 *
 * @apiParam  (request parameters) {String} sandwich.id_sandwich Id du sandwich a ajouté
 * @apiParam  (request parameters) {String} sandwich.id_taille Taille du sandwich a ajouté
 * @apiParam  (request parameters) {String} sandwich.qte Quantité du sandwich a ajouté
 *
 * @apiParamExample {request} exemple de paramètres
 *     {
 * 		 sandwich : {
 *       	"id_sandwich"  : "1",
 *       	"id_taille"  : "1",
 *       	"qte" : "1"
 * 		 }
 *     }
 *
 * @apiSuccess (Réponse : 200) {json} commande Paiement accépté
 *
 * @apiHeader (response headers) {String} Location: uri de la ressource créée et l'id
 * @apiHeader (response headers) {String} Content-Type: format de représentation de la ressource réponse
 *
 * @apiSuccessExample {response} exemple de réponse en cas de succès
 *    POST /commandes/{id}/sandwichs HTTP/1.1
 *    Host: api.lbs.local
 *    Content-Type: application/json;charset=utf8
 * 	  Location: /commandes/e3786989-e0d2-4cfb-a72f-455ca4a16beb/sandwichs
 *
 *    {
 * 		 sandwich : {
 *       	"id_sandwich"  : "1",
 *       	"id_taille"  : "1",
 *       	"qte" : "1"
 * 		 }
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

$app->post('/commandes/{id}/sandwichs', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\CatalogueController($this);

	return $c->createItem($req, $resp, $args);
	}
)->add(new Validation( $validatorsCommandes))->add('checkToken');


/**
 * @api {get} /cartes/{id}/auth  authentification
 * @apiGroup Cartes
 * @apiName AuthentificationCartes
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à une ressource de type cartes :
 * permet d'accéder à la représentation de la ressource sandwichs et ces tailles disponibles.
 * Retourne une représentation json de la ressource, incluant son nom, prix,
 * et son pivot.
 *
 * @apiParam {Number} id Identifiant unique de la catégorie
 *
 *
 * @apiSuccess (Succès : 200) {String} type type de la réponse, ici resource
 * @apisuccess (Succès : 200) {Object} auth la ressource auth retournée
 * @apiSuccess (Succès : 200) {Number} auth.id Identifiant de l'auth
 * @apiSuccess (Succès : 200) {String} auth.nom Nom de l'auth
 * @apiSuccess (Succès : 200) {String} auth.passwd Mot de passe de l'auth
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "collection,
 *        "id"  : "1",
 *        "nom" : "jean",
 *        "passwd" : "jeanforlife"
 *     }
 *
 * @apiError (Erreur : 404) MissingParameter paramètre manquant dans la requête
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 404 Not Found
 *
 *     {
 *       "type" : "error",
 *       "error" : 404,
 *       "message" : "ressource non disponible : /cartes/{id}/auth"
 *     }
 */

$app->get('/cartes/{id}/auth', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\AuthController($this);

	return $c->authenticate($req, $resp, $args);
	}
);


/**
 * @api {get} /cartes/{id}  accéder à une carte
 * @apiGroup Cartes
 * @apiName GetCartes
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à une ressource de type carte :
 * permet d'accéder à la représentation de la ressource carte.
 * Retourne une représentation json de la ressource, incluant son nom, mail, date,
 * et son pivot.
 *
 * @apiParam {Number} id Identifiant unique de la catégorie
 *
 *
 * @apiSuccess (Succès : 200) {String} type type de la réponse, ici resource
 * @apisuccess (Succès : 200) {Object} meta méta-données sur la réponse
 * @apisuccess (Succès : 200) {Tring}  meta.locale langue de la réponse
 * @apisuccess (Succès : 200) {Object} carte la ressource carte retournée
 * @apiSuccess (Succès : 200) {Number} carte.id Identifiant de la carte
 * @apiSuccess (Succès : 200) {String} carte.date_creation Date de création de la carte
 * @apiSuccess (Succès : 200) {String} carte.date_valide Date de validité de la carte
 * @apiSuccess (Succès : 200) {Number} carte.cumul Cumul de la carte
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *
 *     {
 *        "type" : "collection,
 *        "meta" ; { "locale":"fr-FR" },
 *        "carte" : {
 *           "id"  : "1",
 *           "date_creation" : "0000-00-00",
 *           "date_valide" : 0000-00-00",
 *           "cumul" : "23"
 *     }
 *
 * @apiError (Erreur : 401) RefusedAccess accès refusé à la ressource
 * @apiError (Erreur : 404) MissingParameter paramètre manquant dans la requête
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 404 Not Found
 *
 *     {
 *       "type" : "error",
 *       "error" : 404,
 *       "message" : "ressource non disponible : /cartes/{id}"
 *     }
 */

$app->get('/cartes/{id}', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\AuthController($this);

	return $c->getCarte($req, $resp, $args);
	}
);

/**
 * @api {post} /cartes/{id}/paiement  payer avec la carte
 * @apiGroup Cartes
 * @apiName BuyWithCard
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Création d'une ressource de type cartes.
 * La commande à été ajouter payer avec la carte.
 * Le numéro de la carte bancaire et sa date d'expiration doivent être fournis.
 * La réponse retournée indique le cumul ajouté de la nouvelle ressource.
 *
 *
 * @apiParam  (request parameters) {String} carte_bc Numéro de la carte bancaire
 * @apiParam  (request parameters) {String} date_expiration_bc Date d'expiration de la carte bancaire
 *
 * @apiParamExample {request} exemple de paramètres
 *     {
 *     		"carte_bc"  : "5454693217981245",
 *     		"date_expiration_bc"  : "975"
 *     }
 *
 * @apiSuccess (Réponse : 200) {json} commande Paiement accépté
 *
 * @apiHeader (response headers) {String} Location: uri de la ressource créée et l'id
 * @apiHeader (response headers) {String} Content-Type: format de représentation de la ressource réponse
 *
 * @apiSuccessExample {response} exemple de réponse en cas de succès
 *    POST /cartes/{id}/paiement HTTP/1.1
 *    Host: api.lbs.local
 *    Content-Type: application/json;charset=utf8
 * 	  Location: /cartes/e3786989-e0d2-4cfb-a72f-455ca4a16beb/paiement
 *
 *    {
 *     		"carte_bc"  : "5454693217981245",
 *     		"date_expiration_bc"  : "975"
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

$app->post('/cartes/{id}/paiement', function (Request $req, Response $resp, $args) {

	$c = new lbs\api\control\AuthController($this);

	return $c->payerCarte($req, $resp, $args);
	}
);

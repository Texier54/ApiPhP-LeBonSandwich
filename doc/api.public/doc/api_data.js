define({ "api": [
  {
    "type": "get",
    "url": "/cartes/{id}/auth",
    "title": "authentification",
    "group": "Cartes",
    "name": "AuthentificationCartes",
    "version": "0.1.0",
    "description": "<p>Accès à une ressource de type cartes : permet d'accéder à la représentation de la ressource sandwichs et ces tailles disponibles. Retourne une représentation json de la ressource, incluant son nom, prix, et son pivot.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant unique de la catégorie</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>type de la réponse, ici resource</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "auth",
            "description": "<p>la ressource auth retournée</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "auth.id",
            "description": "<p>Identifiant de l'auth</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "auth.nom",
            "description": "<p>Nom de l'auth</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "auth.passwd",
            "description": "<p>Mot de passe de l'auth</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n\n{\n   \"type\" : \"collection,\n   \"id\"  : \"1\",\n   \"nom\" : \"jean\",\n   \"passwd\" : \"jeanforlife\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 Not Found\n\n{\n  \"type\" : \"error\",\n  \"error\" : 404,\n  \"message\" : \"ressource non disponible : /cartes/{id}/auth\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Cartes"
  },
  {
    "type": "post",
    "url": "/cartes/{id}/paiement",
    "title": "payer avec la carte",
    "group": "Cartes",
    "name": "BuyWithCard",
    "version": "0.1.0",
    "description": "<p>Création d'une ressource de type cartes. La commande à été ajouter payer avec la carte. Le numéro de la carte bancaire et sa date d'expiration doivent être fournis. La réponse retournée indique le cumul ajouté de la nouvelle ressource.</p>",
    "parameter": {
      "fields": {
        "request parameters": [
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "carte_bc",
            "description": "<p>Numéro de la carte bancaire</p>"
          },
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "date_expiration_bc",
            "description": "<p>Date d'expiration de la carte bancaire</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de paramètres",
          "content": "{\n\t\t\"carte_bc\"  : \"5454693217981245\",\n\t\t\"date_expiration_bc\"  : \"975\"\n}",
          "type": "request"
        }
      ]
    },
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "type": "json",
            "optional": false,
            "field": "commande",
            "description": "<p>Paiement accépté</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "   POST /cartes/{id}/paiement HTTP/1.1\n   Host: api.lbs.local\n   Content-Type: application/json;charset=utf8\n\t  Location: /cartes/e3786989-e0d2-4cfb-a72f-455ca4a16beb/paiement\n\n   {\n    \t\t\"carte_bc\"  : \"5454693217981245\",\n    \t\t\"date_expiration_bc\"  : \"975\"\n    }",
          "type": "response"
        }
      ]
    },
    "header": {
      "fields": {
        "response headers": [
          {
            "group": "response headers",
            "type": "String",
            "optional": false,
            "field": "Location:",
            "description": "<p>uri de la ressource créée et l'id</p>"
          },
          {
            "group": "response headers",
            "type": "String",
            "optional": false,
            "field": "Content-Type:",
            "description": "<p>format de représentation de la ressource réponse</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"type\": \"error\",\n  \"error\" : 400,\n  \"message\" : \"donnée manquante (description)\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Cartes"
  },
  {
    "type": "get",
    "url": "/cartes/{id}",
    "title": "accéder à une carte",
    "group": "Cartes",
    "name": "GetCartes",
    "version": "0.1.0",
    "description": "<p>Accès à une ressource de type carte : permet d'accéder à la représentation de la ressource carte. Retourne une représentation json de la ressource, incluant son nom, mail, date, et son pivot.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant unique de la catégorie</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>type de la réponse, ici resource</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "meta",
            "description": "<p>méta-données sur la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Tring",
            "optional": false,
            "field": "meta.locale",
            "description": "<p>langue de la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "carte",
            "description": "<p>la ressource carte retournée</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "carte.id",
            "description": "<p>Identifiant de la carte</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "carte.date_creation",
            "description": "<p>Date de création de la carte</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "carte.date_valide",
            "description": "<p>Date de validité de la carte</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "carte.cumul",
            "description": "<p>Cumul de la carte</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n\n{\n   \"type\" : \"collection,\n   \"meta\" ; { \"locale\":\"fr-FR\" },\n   \"carte\" : {\n      \"id\"  : \"1\",\n      \"date_creation\" : \"0000-00-00\",\n      \"date_valide\" : 0000-00-00\",\n      \"cumul\" : \"23\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 401": [
          {
            "group": "Erreur : 401",
            "optional": false,
            "field": "RefusedAccess",
            "description": "<p>accès refusé à la ressource</p>"
          }
        ],
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 Not Found\n\n{\n  \"type\" : \"error\",\n  \"error\" : 404,\n  \"message\" : \"ressource non disponible : /cartes/{id}\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Cartes"
  },
  {
    "type": "post",
    "url": "/categories/",
    "title": "créer une catégorie",
    "group": "Categories",
    "name": "CreateCategorie",
    "version": "0.1.0",
    "description": "<p>Création d'une ressource de type Catégorie. La catégorie est ajoutée dans la base, son identifiant est créé. Le nom et la description de la catégorie doivent être fournis. La réponse retournée indique l'uri de la nouvelle ressource dans le header Location: et contient la représentation de la nouvelle ressource.</p>",
    "parameter": {
      "fields": {
        "request parameters": [
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "nom",
            "description": "<p>Nom de la nouvelle catégorie</p>"
          },
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Description de la catégorie</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de paramètres",
          "content": "{\n  \"nom\"         : \"chaud\",\n  \"description\" : \"Tous nos sandwichs chauds\"\n}",
          "type": "request"
        }
      ]
    },
    "header": {
      "fields": {
        "request headers": [
          {
            "group": "request headers",
            "type": "String",
            "optional": false,
            "field": "Content-Type:",
            "defaultValue": "application/json",
            "description": "<p>format utilisé pour les données transmises</p>"
          }
        ],
        "response headers": [
          {
            "group": "response headers",
            "type": "String",
            "optional": false,
            "field": "Location:",
            "description": "<p>uri de la ressource créée</p>"
          },
          {
            "group": "response headers",
            "type": "String",
            "optional": false,
            "field": "Content-Type:",
            "description": "<p>format de représentation de la ressource réponse</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Exemple de requête :",
        "content": "POST /categories/ HTTP/1.1\nHost: api.lbs.local\nContent-Type: application/json;charset=utf8\n\n{\n   \"nom\"         : \"chaud\",\n   \"description\" : \"Tous nos sandwichs chauds\"\n}",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Réponse : 201": [
          {
            "group": "Réponse : 201",
            "type": "json",
            "optional": false,
            "field": "categorie",
            "description": "<p>représentation json de la nouvelle catégorie</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 201 CREATED\nLocation: http://api.lbs.local/categories/42\nContent-Type: application/json;charset=utf8\n\n{\n   \"type\" : \"resource,\n   \"meta\" ; { \"date\" : \"31-12-2017\" },\n   categorie : {\n       \"id\"  : 42 ,\n       \"nom\" : \"fromages\",\n       \"description\" : \"Tous nos fromages, bio et au lait cru\"\n   },\n   links : {\n       \"sandwichs\" : { \"href\" : \"/categories/42/sandwichs\" }\n   }\n}",
          "type": "response"
        }
      ]
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"type\": \"error\",\n  \"error\" : 400,\n  \"message\" : \"donnée manquante (description)\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./test.php",
    "groupTitle": "Categories"
  },
  {
    "type": "post",
    "url": "/categories/",
    "title": "créer une catégorie",
    "group": "Categories",
    "name": "CreateCategorie",
    "version": "0.1.0",
    "description": "<p>Création d'une ressource de type Catégorie. La catégorie est ajoutée dans la base, son identifiant est créé. Le nom et la description de la catégorie doivent être fournis. La réponse retournée indique l'uri de la nouvelle ressource dans le header Location: et contient la représentation de la nouvelle ressource.</p>",
    "parameter": {
      "fields": {
        "request parameters": [
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "nom",
            "description": "<p>Nom de la nouvelle catégorie</p>"
          },
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Description de la catégorie</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de paramètres",
          "content": "{\n  \"nom\"         : \"chaud\",\n  \"description\" : \"Tous nos sandwichs chauds\"\n}",
          "type": "request"
        }
      ]
    },
    "header": {
      "fields": {
        "request headers": [
          {
            "group": "request headers",
            "type": "String",
            "optional": false,
            "field": "Content-Type:",
            "defaultValue": "application/json",
            "description": "<p>format utilisé pour les données transmises</p>"
          }
        ],
        "response headers": [
          {
            "group": "response headers",
            "type": "String",
            "optional": false,
            "field": "Location:",
            "description": "<p>uri de la ressource créée</p>"
          },
          {
            "group": "response headers",
            "type": "String",
            "optional": false,
            "field": "Content-Type:",
            "description": "<p>format de représentation de la ressource réponse</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Exemple de requête :",
        "content": "POST /categories/ HTTP/1.1\nHost: api.lbs.local\nContent-Type: application/json;charset=utf8\n\n{\n   \"nom\"         : \"chaud\",\n   \"description\" : \"Tous nos sandwichs chauds\"\n}",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Réponse : 201": [
          {
            "group": "Réponse : 201",
            "type": "json",
            "optional": false,
            "field": "categorie",
            "description": "<p>représentation json de la nouvelle catégorie</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 201 CREATED\nLocation: http://api.lbs.local/categories/42\nContent-Type: application/json;charset=utf8\n\n{\n   \"type\" : \"resource,\n   \"meta\" ; { \"date\" : \"31-12-2017\" },\n   categorie : {\n       \"id\"  : 42 ,\n       \"nom\" : \"fromages\",\n       \"description\" : \"Tous nos fromages, bio et au lait cru\"\n   },\n   links : {\n       \"sandwichs\" : { \"href\" : \"/categories/42/sandwichs\" }\n   }\n}",
          "type": "response"
        }
      ]
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"type\": \"error\",\n  \"error\" : 400,\n  \"message\" : \"donnée manquante (description)\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Categories"
  },
  {
    "type": "get",
    "url": "/categories/{id}",
    "title": "accéder à une catégorie",
    "group": "Categories",
    "name": "GetCategorie",
    "version": "0.1.0",
    "description": "<p>Accès à une ressource de type catégorie : permet d'accéder à la représentation de la ressource categorie désignée. Retourne une représentation json de la ressource, incluant son nom et sa description. Le résultat inclut un lien pour accéder à la liste des sandwichs de cette catégorie.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant unique de la catégorie</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>type de la réponse, ici resource</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "meta",
            "description": "<p>méta-données sur la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Tring",
            "optional": false,
            "field": "meta.date",
            "description": "<p>date de production de la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "categorie",
            "description": "<p>la ressource categorie retournée</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "categorie.id",
            "description": "<p>Identifiant de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "categorie.nom",
            "description": "<p>Nom de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "categorie.description",
            "description": "<p>Description de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "links",
            "description": "<p>liens vers les ressources associées à la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "links.sandwichs",
            "description": "<p>lien vers les sandwichs de la catégorie</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n\n{\n   \"type\" : \"resource,\n   \"meta\" ; { \"date\" : \"31-12-2017\" },\n   categorie : {\n       \"id\"  : 4 ,\n       \"nom\" : \"végétarien\",\n       \"description\" : \"sandwichs végétariens - peuvent contenir des produits laitiers\"\n   },\n   links : {\n       \"sandwichs\" : { \"href\" : \"/categories/4/sandwichs\" }\n   }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "CategorieNotFound",
            "description": "<p>Categorie inexistante</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 Not Found\n\n{\n  \"type\" : \"error',\n  \"error\" : 404,\n  \"message\" : ressource non disponible : /categories/42/\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./test.php",
    "groupTitle": "Categories"
  },
  {
    "type": "get",
    "url": "/categories/{id}",
    "title": "accéder à une catégorie",
    "group": "Categories",
    "name": "GetCategorie",
    "version": "0.1.0",
    "description": "<p>Accès à une ressource de type catégorie : permet d'accéder à la représentation de la ressource categorie désignée. Retourne une représentation json de la ressource, incluant son nom et sa description. Le résultat inclut un lien pour accéder à la liste des sandwichs de cette catégorie.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant unique de la catégorie</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>type de la réponse, ici resource</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "meta",
            "description": "<p>méta-données sur la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Tring",
            "optional": false,
            "field": "meta.date",
            "description": "<p>date de production de la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "categorie",
            "description": "<p>la ressource categorie retournée</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "categorie.id",
            "description": "<p>Identifiant de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "categorie.nom",
            "description": "<p>Nom de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "categorie.description",
            "description": "<p>Description de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "links",
            "description": "<p>liens vers les ressources associées à la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "links.sandwichs",
            "description": "<p>lien vers les sandwichs de la catégorie</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n\n{\n   \"type\" : \"resource,\n   \"meta\" ; { \"date\" : \"31-12-2017\" },\n   categorie : {\n       \"id\"  : 4 ,\n       \"nom\" : \"végétarien\",\n       \"description\" : \"sandwichs végétariens - peuvent contenir des produits laitiers\"\n   },\n   links : {\n       \"sandwichs\" : { \"href\" : \"/categories/4/sandwichs\" }\n   }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "CategorieNotFound",
            "description": "<p>Categorie inexistante</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 Not Found\n\n{\n  \"type\" : \"error',\n  \"error\" : 404,\n  \"message\" : ressource non disponible : /categories/42/\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Categories"
  },
  {
    "type": "get",
    "url": "/categories",
    "title": "accéder à tout les catégories",
    "group": "Categories",
    "name": "GetCategories",
    "version": "0.1.0",
    "description": "<p>Accès à tout les ressources de type catégories : permet d'accéder à la représentation des ressources categorie. Retourne une représentation json des ressources, incluant leur nom et description.</p>",
    "success": {
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n\n{\n   \"type\" : \"collection,\n   \"meta\" ; { \"count\" : 12, \"locale\" : \"fr-FR\" },\n   categorie : {\n       \"id\"  : 1 ,\n       \"nom\" : \"bio12\",\n       \"description\" : \"sandwichs ingrédients bio et locaux\"\n   }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Categories"
  },
  {
    "type": "get",
    "url": "/categories/{id}/sandwichs",
    "title": "accéder au sandwich d'une categorie",
    "group": "Categories",
    "name": "GetSandwichFromCategorie",
    "version": "0.1.0",
    "description": "<p>Accès à une ressource de type catégorie : permet d'accéder à la représentation de la ressource categories du sandwich désignée. Retourne une représentation json de la ressource, incluant son nom et son type de pain. Le résultat inclut un lien pour accéder à ce sandwichs précis.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant unique de la catégorie</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>type de la réponse, ici resource</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "meta",
            "description": "<p>méta-données sur la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Tring",
            "optional": false,
            "field": "meta.count",
            "description": "<p>nombre de résultat</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Tring",
            "optional": false,
            "field": "meta.date",
            "description": "<p>date de production de la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "sandwichs",
            "description": "<p>les ressources sandwich retournée</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "sandwich",
            "description": "<p>la ressource sandwich retournée</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "sandwich.id",
            "description": "<p>Identifiant du sandwich</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "sandwich.nom",
            "description": "<p>Nom du sandwich</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "sandwich.type_pain",
            "description": "<p>Type de pain du sandwich</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "links",
            "description": "<p>liens vers les ressources associées au sandwichs</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "links.href",
            "description": "<p>route du lien vers les catégorie du sandwichs</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "    HTTP/1.1 200 OK\n\n    {\n       \"type\" : \"collection,\n       \"meta\" ; { \"count\" : \"1\", \"date\" : \"31-12-2017\" },\n       sandwichs : {\n       \tsandwich : {\n       \t    \"id\"  : \"3\",\n       \t    \"nom\" : \"jambon-beurre\",\n       \t    \"type_pain\" : \"baguette\",\n       \t},\n       \tlinks : {\n       \t\t\"href\" : \"/rest.php/sandwichs/4/tailles\"\n       \t}\n\t\t  }\n    }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "SandwichNotFoundFromCategorie",
            "description": "<p>SandwichFromCategorie inexistante</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 Not Found\n\n{\n  \"type\" : \"error\",\n  \"error\" : 404,\n  \"message\" : \"ressource non disponible : categories/{id}/sandwich\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Categories"
  },
  {
    "type": "put",
    "url": "/categories/{id}",
    "title": "modifier une catégorie",
    "group": "Categories",
    "name": "UpdateCategorie",
    "version": "0.1.0",
    "description": "<p>modification de la ressource Catégorie cible. La catégorie doit exister, et est entièrement remplacée par celle transmise. La requête doit obligatoirement fournir le nom et la description de la catégorie</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identifiant de la catégorie ciblée</p>"
          }
        ],
        "request parameters": [
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "nom",
            "description": "<p>Nom de la nouvelle catégorie</p>"
          },
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Description de la catégorie</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de paramètres",
          "content": "{\n  \"nom\"         : \"chauds\",\n  \"description\" : \"Tous nos sandwichs chauds\"\n}",
          "type": "request"
        }
      ]
    },
    "header": {
      "fields": {
        "request headers": [
          {
            "group": "request headers",
            "type": "String",
            "optional": false,
            "field": "Content-Type:",
            "defaultValue": "application/json",
            "description": "<p>format utilisé pour les données transmises</p>"
          }
        ],
        "response headers": [
          {
            "group": "response headers",
            "type": "String",
            "optional": false,
            "field": "Content-Type:",
            "description": "<p>format de représentation de la ressource réponse</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Exemple de requête :",
        "content": "PUT /categories/8 HTTP/1.1\nHost: api.lbs.local\nContent-Type: application/json;charset=utf8\n\n{\n   \"nom\"         : \"chaud\",\n   \"description\" : \"Tous nos sandwichs chauds\"\n}",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "type": "json",
            "optional": false,
            "field": "categorie",
            "description": "<p>représentation json de la nouvelle catégorie</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\nContent-Type: application/json;charset=utf8\n\n{\n   \"type\" : \"resource,\n   \"meta\" ; { \"date\" : \"31-12-2017\" },\n   categorie : {\n       \"id\"  : 42 ,\n       \"nom\" : \"cahuds\",\n       \"description\" : \"Tous nos sandwichs chauds\n   },\n   links : {\n       \"sandwichs\" : { \"href\" : \"/categories/42/sandwichs\" }\n   }\n}",
          "type": "response"
        }
      ]
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ],
        "Réponse : 404": [
          {
            "group": "Réponse : 404",
            "optional": false,
            "field": "RessourceNotFound",
            "description": "<p>ressource catégorie inexistante</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur 400",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"type\": \"error\",\n  \"error\" : 400,\n  \"message\" : \"donnée manquante (description)\"\n}",
          "type": "json"
        },
        {
          "title": "exemple de réponse en cas d'erreur 404",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"type\": \"error\",\n  \"error\" : 404,\n  \"message\" : \"ressource demandée inexistante : /categories/42/\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Categories"
  },
  {
    "type": "put",
    "url": "/categories/{id}",
    "title": "modifier une catégorie",
    "group": "Categories",
    "name": "UpdateCategorie",
    "version": "0.1.0",
    "description": "<p>modification de la ressource Catégorie cible. La catégorie doit exister, et est entièrement remplacée par celle transmise. La requête doit obligatoirement fournir le nom et la description de la catégorie</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>identifiant de la catégorie ciblée</p>"
          }
        ],
        "request parameters": [
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "nom",
            "description": "<p>Nom de la nouvelle catégorie</p>"
          },
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Description de la catégorie</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de paramètres",
          "content": "{\n  \"nom\"         : \"chauds\",\n  \"description\" : \"Tous nos sandwichs chauds\"\n}",
          "type": "request"
        }
      ]
    },
    "header": {
      "fields": {
        "request headers": [
          {
            "group": "request headers",
            "type": "String",
            "optional": false,
            "field": "Content-Type:",
            "defaultValue": "application/json",
            "description": "<p>format utilisé pour les données transmises</p>"
          }
        ],
        "response headers": [
          {
            "group": "response headers",
            "type": "String",
            "optional": false,
            "field": "Content-Type:",
            "description": "<p>format de représentation de la ressource réponse</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Exemple de requête :",
        "content": "PUT /categories/8 HTTP/1.1\nHost: api.lbs.local\nContent-Type: application/json;charset=utf8\n\n{\n   \"nom\"         : \"chaud\",\n   \"description\" : \"Tous nos sandwichs chauds\"\n}",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "type": "json",
            "optional": false,
            "field": "categorie",
            "description": "<p>représentation json de la nouvelle catégorie</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\nContent-Type: application/json;charset=utf8\n\n{\n   \"type\" : \"resource,\n   \"meta\" ; { \"date\" : \"31-12-2017\" },\n   categorie : {\n       \"id\"  : 42 ,\n       \"nom\" : \"cahuds\",\n       \"description\" : \"Tous nos sandwichs chauds\n   },\n   links : {\n       \"sandwichs\" : { \"href\" : \"/categories/42/sandwichs\" }\n   }\n}",
          "type": "response"
        }
      ]
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ],
        "Réponse : 404": [
          {
            "group": "Réponse : 404",
            "optional": false,
            "field": "RessourceNotFound",
            "description": "<p>ressource catégorie inexistante</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur 400",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"type\": \"error\",\n  \"error\" : 400,\n  \"message\" : \"donnée manquante (description)\"\n}",
          "type": "json"
        },
        {
          "title": "exemple de réponse en cas d'erreur 404",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"type\": \"error\",\n  \"error\" : 404,\n  \"message\" : \"ressource demandée inexistante : /categories/42/\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./test.php",
    "groupTitle": "Categories"
  },
  {
    "type": "post",
    "url": "/commandes/",
    "title": "créer une commande",
    "group": "Commandes",
    "name": "CreateCommandes",
    "version": "0.1.0",
    "description": "<p>Création d'une ressource de type commandes. La commande est ajoutée dans la base, son identifiant et token sont créé. Le nom du client, la description du client et la date et heure de la commande doivent être fournis. La réponse retournée indique l'id et le token de la nouvelle ressource et contient.</p>",
    "parameter": {
      "fields": {
        "request parameters": [
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "nom_cient",
            "description": "<p>Nom du client de la commande</p>"
          },
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "mail_client",
            "description": "<p>Mail du client de la commande</p>"
          },
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "livraison",
            "description": "<p>la ressource livraison fournis</p>"
          },
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "livraison.date",
            "description": "<p>date de la commande</p>"
          },
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "livraison.heure",
            "description": "<p>heure de la commande</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de paramètres",
          "content": "    {\n      \"nom_client\"  : \"jean mi\",\n      \"mail_client\" : \"jm@gmal.com\",\n\t\t \"livraison\"   : {\n\t\t\t\"date\"\t: \"7-12-2017\",\n\t\t\t\"heure\" : \"12:30\"\n\t\t }\n    }",
          "type": "request"
        }
      ]
    },
    "header": {
      "fields": {
        "request headers": [
          {
            "group": "request headers",
            "type": "String",
            "optional": false,
            "field": "Content-Type:",
            "defaultValue": "application/json",
            "description": "<p>format utilisé pour les données transmises</p>"
          }
        ],
        "response headers": [
          {
            "group": "response headers",
            "type": "String",
            "optional": false,
            "field": "Location:",
            "description": "<p>uri de la ressource créée et l'id</p>"
          },
          {
            "group": "response headers",
            "type": "String",
            "optional": false,
            "field": "Content-Type:",
            "description": "<p>format de représentation de la ressource réponse</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Réponse : 201": [
          {
            "group": "Réponse : 201",
            "type": "json",
            "optional": false,
            "field": "commande",
            "description": "<p>représentation json de la nouvelle commande</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "    POST /commandes/ HTTP/1.1\n   Host: api.lbs.local\n   Content-Type: application/json;charset=utf8\n\t  Location: /commandes/e3786989-e0d2-4cfb-a72f-455ca4a16beb\n\n   {\n      \"nom_client\"  : \"jean mi\",\n      \"mail_client\" : \"jm@gmal.com\",\n\t\t \"livraison\"   : {\n\t\t\t\"date\"\t: \"7-12-2017\",\n\t\t\t\"heure\" : \"12:30\"\n\t\t }\n    }",
          "type": "response"
        }
      ]
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"type\": \"error\",\n  \"error\" : 400,\n  \"message\" : \"donnée manquante (description)\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Commandes"
  },
  {
    "type": "get",
    "url": "/commandes/{id}",
    "title": "accéder à une commande",
    "group": "Commandes",
    "name": "GetCommandes",
    "version": "0.1.0",
    "description": "<p>Accès à une ressource de type commande : permet d'accéder à la représentation de la ressource commande. Retourne une représentation json de la ressource, incluant son nom, mail, date, et son pivot.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant unique de la catégorie</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>type de la réponse, ici resource</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "meta",
            "description": "<p>méta-données sur la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Tring",
            "optional": false,
            "field": "meta.locale",
            "description": "<p>langue de la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "commande",
            "description": "<p>la ressource commande retournée</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "commande.id",
            "description": "<p>Identifiant de la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "commande.nom",
            "description": "<p>Nom de la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "commande.mail",
            "description": "<p>Mail de la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "commande.date",
            "description": "<p>Date de la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "commande.heure",
            "description": "<p>Heure de la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "commande.etat",
            "description": "<p>Etat de la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "commande.token",
            "description": "<p>Token de la commande</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "commande.carte",
            "description": "<p>Carte de la commande</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "HTTP/1.1 200 OK\n\n{\n   \"type\" : \"collection,\n   \"meta\" ; { \"locale\":\"fr-FR\" },\n   \"taille\" : {\n      \"id\"  : \"1\",\n      \"nom\" : \"commande1\",\n      \"mail\" : mail@gmail.com\",\n      \"date\" : \"0000-00-00\",\n      \"heure\" : \"00:00:00\"\n      \"etat\" : \"0\",\n       \"token\" : \"1356431355332\",\n       \"carte\" : \"5555632179\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "TailleNotFoundInSandwich",
            "description": "<p>TailleFromSandwich inexistante</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 Not Found\n\n{\n  \"type\" : \"error\",\n  \"error\" : 404,\n  \"message\" : \"ressource non disponible : /commandes/{id}\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Commandes"
  },
  {
    "type": "post",
    "url": "/commandes/{id}/paiement",
    "title": "payer une commande",
    "group": "Commandes",
    "name": "PayerCommandes",
    "version": "0.1.0",
    "description": "<p>Création d'une ressource de type commandes. La commande est payer. Le numéro de la carte bancaire et ça date d'expriation doivent être fournis. La réponse retournée indique l'id et le token de la nouvelle ressource.</p>",
    "parameter": {
      "fields": {
        "request parameters": [
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "carte_bc",
            "description": "<p>Numéro de la carte bancaire</p>"
          },
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "date_expiration_bc",
            "description": "<p>Date d'expriation de la carte bancaire</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de paramètres",
          "content": "{\n  \"carte_bc\"  : \"5555555555555555\",\n  \"date_expiration_bc\" : \"1/22\"\n}",
          "type": "request"
        }
      ]
    },
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "type": "json",
            "optional": false,
            "field": "commande",
            "description": "<p>Paiement accépté</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "    POST /commandes/ HTTP/1.1\n   Host: api.lbs.local\n   Content-Type: application/json;charset=utf8\n\t  Location: /commandes/e3786989-e0d2-4cfb-a72f-455ca4a16beb\n\n   {\n      \"carte_bc\"  : \"5555555555555555\",\n      \"date_expiration_bc\" : \"1/22\"\n    }",
          "type": "response"
        }
      ]
    },
    "header": {
      "fields": {
        "response headers": [
          {
            "group": "response headers",
            "type": "String",
            "optional": false,
            "field": "Location:",
            "description": "<p>uri de la ressource créée et l'id</p>"
          },
          {
            "group": "response headers",
            "type": "String",
            "optional": false,
            "field": "Content-Type:",
            "description": "<p>format de représentation de la ressource réponse</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"type\": \"error\",\n  \"error\" : 400,\n  \"message\" : \"donnée manquante (description)\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Commandes"
  },
  {
    "type": "post",
    "url": "/commandes/{id}/sandwichs",
    "title": "ajout un sandwich a la commande",
    "group": "Commandes",
    "name": "PutSandwichToCart",
    "version": "0.1.0",
    "description": "<p>Création d'une ressource de type commandes. Le sandwich à été ajouter a la commande. L'id du sandwich, sa taille et sa quantité doivent être fournis. La réponse retournée indique l'id et le token de la nouvelle ressource.</p>",
    "parameter": {
      "fields": {
        "request parameters": [
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "sandwich.id_sandwich",
            "description": "<p>Id du sandwich a ajouté</p>"
          },
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "sandwich.id_taille",
            "description": "<p>Taille du sandwich a ajouté</p>"
          },
          {
            "group": "request parameters",
            "type": "String",
            "optional": false,
            "field": "sandwich.qte",
            "description": "<p>Quantité du sandwich a ajouté</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de paramètres",
          "content": "    {\n\t\t sandwich : {\n      \t\"id_sandwich\"  : \"1\",\n      \t\"id_taille\"  : \"1\",\n      \t\"qte\" : \"1\"\n\t\t }\n    }",
          "type": "request"
        }
      ]
    },
    "success": {
      "fields": {
        "Réponse : 200": [
          {
            "group": "Réponse : 200",
            "type": "json",
            "optional": false,
            "field": "commande",
            "description": "<p>Paiement accépté</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "   POST /commandes/{id}/sandwichs HTTP/1.1\n   Host: api.lbs.local\n   Content-Type: application/json;charset=utf8\n\t  Location: /commandes/e3786989-e0d2-4cfb-a72f-455ca4a16beb/sandwichs\n\n   {\n\t\t sandwich : {\n      \t\"id_sandwich\"  : \"1\",\n      \t\"id_taille\"  : \"1\",\n      \t\"qte\" : \"1\"\n\t\t }\n    }",
          "type": "response"
        }
      ]
    },
    "header": {
      "fields": {
        "response headers": [
          {
            "group": "response headers",
            "type": "String",
            "optional": false,
            "field": "Location:",
            "description": "<p>uri de la ressource créée et l'id</p>"
          },
          {
            "group": "response headers",
            "type": "String",
            "optional": false,
            "field": "Content-Type:",
            "description": "<p>format de représentation de la ressource réponse</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Réponse : 400": [
          {
            "group": "Réponse : 400",
            "optional": false,
            "field": "MissingParameter",
            "description": "<p>paramètre manquant dans la requête</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"type\": \"error\",\n  \"error\" : 400,\n  \"message\" : \"donnée manquante (description)\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Commandes"
  },
  {
    "type": "get",
    "url": "/sandwichs/{id}",
    "title": "accéder à un sandwich",
    "group": "Sandwich",
    "name": "GetSandwich",
    "version": "0.1.0",
    "description": "<p>Accès à une ressource de type sandwich : permet d'accéder à la représentation de la ressource sandwich désignée. Retourne une représentation json de la ressource, incluant son nom, sa description, son type de pain et une image. Le résultat inclut un lien pour accéder à la liste des categories et les tailles de ce sandwich.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant unique de la catégorie</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>type de la réponse, ici resource</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "meta",
            "description": "<p>méta-données sur la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Tring",
            "optional": false,
            "field": "meta.locale",
            "description": "<p>langue de la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "sandwich",
            "description": "<p>la ressource sandwich retournée</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "sandwich.id",
            "description": "<p>Identifiant du sandwich</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "sandwich.nom",
            "description": "<p>Nom du sandwich</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "sandwich.description",
            "description": "<p>Description du sandwich</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "sandwich.type_pain",
            "description": "<p>Type de pain du sandwich</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "sandwich.img",
            "description": "<p>Description de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "categorie",
            "description": "<p>la ressource categorie retournée</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "categorie.id",
            "description": "<p>Identifiant de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "categorie.nom",
            "description": "<p>Nom de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "categorie.pivot",
            "description": "<p>Pivot de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "categorie.pivot.sand_id",
            "description": "<p>Id du sandwich du pivot de la categorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "categorie.pivot.cat_id",
            "description": "<p>Id de la categorie du pivot</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "tailles",
            "description": "<p>la ressource tailles retournée</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "tailles.id",
            "description": "<p>Identifiant de la taille</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "tailles.nom",
            "description": "<p>Nom de la taille</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "tailles.prix",
            "description": "<p>Prix de la taille</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "links",
            "description": "<p>liens vers les ressources associées au sandwichs</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "links.categories",
            "description": "<p>lien vers les catégorie du sandwichs</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "links.href",
            "description": "<p>route du lien vers les catégorie du sandwichs</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "links.tailles",
            "description": "<p>lien vers la tailles du sandwich</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "    HTTP/1.1 200 OK\n\n    {\n       \"type\" : \"collection,\n       \"meta\" ; { \"locale\" : \"fr-FR\" },\n       sandwich : {\n           \"id\"  : 4 ,\n           \"nom\" : \"végétarien\",\n           \"description\" : \"n sandwich de bucheron : frites, fromage, saucisse, steack, lard grillé, mayo\",\n           \"type_pain\" : \"sandwichs végétariens - peuvent contenir des produits laitiers\",\n           \"img\" : \"null\"\n       },\n       categories : {\n           \"id\"  : 3 ,\n           \"nom\" : \"traditionnel\",\n           \"pivot\" : {\n           \t\"sand_id\" : \"4\",\n           \t\"cat_id\" : \"3\"\n\t\t\t  }\n       },\n       tailles : {\n           \"id\"  : 4 ,\n           \"nom\" : \"complet\",\n           \"prix\" : \"6.00\"\n       },\n       links : {\n           \"categories\" : {\n           \t\"href\" : \"/rest.php/sandwichs/4/categories\"\n\t\t\t  },\n           \"tailles\" : {\n           \t\"href\" : \"/rest.php/sandwichs/4/tailles\"\n\t\t\t  }\n       }\n    }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "SandwichNotFound",
            "description": "<p>Sandwich inexistante</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 Not Found\n\n{\n  \"type\" : \"error\",\n  \"error\" : 404,\n  \"message\" : \"ressource non disponible : /sandwich/4/\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Sandwich"
  },
  {
    "type": "get",
    "url": "/sandwichs",
    "title": "accéder à tout les sandwichs",
    "group": "Sandwich",
    "name": "GetSandwichs",
    "version": "0.1.0",
    "description": "<p>Accès à tout les ressources de type sandwichs : permet d'accéder à la représentation des ressources categorie. Retourne une représentation json des ressources, incluant leur nom et description.</p>",
    "success": {
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "    HTTP/1.1 200 OK\n\n    {\n       \"type\" : \"collection,\n       \"meta\" ; { \"count\" : 111, \"size\" : 10, \"locale\" : \"fr-FR\" },\n       sandwichs : {\n           \"id\"  : 4 ,\n           \"nom\" : \"le bucheron\",\n           \"type_pain\" : \"baguette campagne\"\n       },\n       \"links\" : {\n       \t\"href\" : \"/rest.php/sandwichs/4\"\n\t\t  }\n    }",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Sandwich"
  },
  {
    "type": "get",
    "url": "/sandwichs/{id}/categories",
    "title": "accéder au categorie d'un sandwich",
    "group": "Sandwich",
    "name": "getCategorieFromSandwich",
    "version": "0.1.0",
    "description": "<p>Accès à une ressource de type sandwichs : permet d'accéder à la représentation de la ressource sandwichs de la catégorie désignée. Retourne une représentation json de la ressource, incluant son nom, description, et son pivot. Le résultat inclut un lien pour accéder à cette catégorie.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant unique de la catégorie</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>type de la réponse, ici resource</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "meta",
            "description": "<p>méta-données sur la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Tring",
            "optional": false,
            "field": "meta.count",
            "description": "<p>nombre de résultat</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Tring",
            "optional": false,
            "field": "meta.date",
            "description": "<p>date de production de la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "categories",
            "description": "<p>les ressources categories retournée</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "categorie",
            "description": "<p>la ressource categorie retournée</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "categorie.id",
            "description": "<p>Identifiant du categorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "categorie.nom",
            "description": "<p>Nom du categorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "categorie.description",
            "description": "<p>Description de la catégorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "categorie.sand_id",
            "description": "<p>Id du sandwich de la categorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "categorie.cat_id",
            "description": "<p>Id de la categorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "categorie.pivot.sand_id",
            "description": "<p>Id du sandwich du pivot de la categorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "categorie.pivot.cat_id",
            "description": "<p>Id de la categorie du pivot</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "links",
            "description": "<p>liens vers les ressources associées à la categorie</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Link",
            "optional": false,
            "field": "links.href",
            "description": "<p>route du lien vers la catégorie du sandwich</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "    HTTP/1.1 200 OK\n\n    {\n       \"type\" : \"collection,\n       \"meta\" ; { \"count\" : \"2\", \"date\" : \"31-12-2017\" },\n       categories : {\n       \tcategorie : {\n       \t    \"id\"  : \"3\",\n       \t    \"nom\" : \"traditionnel\",\n       \t    \"description\" : \"sandwichs traditionnels : jambon, pâté, poulet etc ..\",\n       \t    \"sand_id\" : \"4\",\n       \t    \"cat_id\" : \"3\"\n       \t},\n       \tpivot : {\n       \t\t\"sand_id\" : \"4\",\n       \t\t\"cat_id\" : \"3\"\n       \t}\n\t\t  },\n       links : {\n       \t\"href\" : \"/rest.php/sandwichs/4/tailles\"\n       }\n    }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "CategorieNotFoundInSandwich",
            "description": "<p>CategorieFromSandwich inexistante</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 Not Found\n\n{\n  \"type\" : \"error\",\n  \"error\" : 404,\n  \"message\" : \"ressource non disponible : /sandwichs/{id}/categories\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Sandwich"
  },
  {
    "type": "get",
    "url": "/sandwichs/{id}/taille",
    "title": "accéder aux tailles d'un sandwich",
    "group": "Sandwich",
    "name": "getTailleFromSandwich",
    "version": "0.1.0",
    "description": "<p>Accès à une ressource de type sandwichs : permet d'accéder à la représentation de la ressource sandwichs et ces tailles disponibles. Retourne une représentation json de la ressource, incluant son nom, prix, et son pivot.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identifiant unique de la catégorie</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Succès : 200": [
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>type de la réponse, ici resource</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "meta",
            "description": "<p>méta-données sur la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Tring",
            "optional": false,
            "field": "meta.count",
            "description": "<p>nombre de résultat</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Tring",
            "optional": false,
            "field": "meta.date",
            "description": "<p>date de production de la réponse</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "tailles",
            "description": "<p>les ressources tailles retournée</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Object",
            "optional": false,
            "field": "taille",
            "description": "<p>la ressource taille retournée</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "taille.id",
            "description": "<p>Identifiant de la taille</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "taille.nom",
            "description": "<p>Nom de la taille</p>"
          },
          {
            "group": "Succès : 200",
            "type": "String",
            "optional": false,
            "field": "taille.prix",
            "description": "<p>Prix de la taille</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "taille.pivot.sand_id",
            "description": "<p>Id du sandwich du pivot de la taille</p>"
          },
          {
            "group": "Succès : 200",
            "type": "Number",
            "optional": false,
            "field": "taille.pivot.taille_id",
            "description": "<p>Id de la taille du pivot</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas de succès",
          "content": "    HTTP/1.1 200 OK\n\n    {\n       \"type\" : \"collection,\n       \"meta\" ; { \"count\" : \"4\", \"date\" : \"31-12-2017\" },\n       tailles : {\n       \ttaille : {\n       \t   \"id\"  : \"1\",\n       \t   \"nom\" : \"petite faim\",\n       \t   \"prix\" : \"6.00\",\n       \t   \"sand_id\" : \"4\",\n       \t   \"cat_id\" : \"3\"\n       \t   pivot : {\n       \t      \"sand_id\" : \"4\",\n       \t      \"cat_id\" : \"3\"\n       \t   }\n\t\t  }\n    }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Erreur : 404": [
          {
            "group": "Erreur : 404",
            "optional": false,
            "field": "TailleNotFoundInSandwich",
            "description": "<p>TailleFromSandwich inexistante</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "exemple de réponse en cas d'erreur",
          "content": "HTTP/1.1 404 Not Found\n\n{\n  \"type\" : \"error\",\n  \"error\" : 404,\n  \"message\" : \"ressource non disponible : /sandwichs/{id}/taille\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./rest.php",
    "groupTitle": "Sandwich"
  }
] });

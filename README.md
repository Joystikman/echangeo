#Echangéo

Site web réalisé dans le cadre de mon projet de fin d'année et dont le but est d'offrir une plateforme de partage de services entre particulier.
Basé sur l'échange le but est de permettre à chacun de proposer ses services ou d'en demander.

Le site est réalisé avec Synfony2.8

##Création de la base de données
###Paramètres de connexion
Le fichier `app/config/parameters.yml` doit contenir les informations concernant le connexion à la base de données.
Il est créé sur le modèle du fichier `parameters.yml.dist`.

Exemple de paramètre utilisant les valeur pas défaut de phpMyAdmin :

	parameters:
		database_driver:   pdo_mysql
	    database_host:     127.0.0.1
	    database_port:     ~
	    database_name:     echangeo
	    database_user:     root
	    database_password: ~    
###Création des tables
Une fois la BD créée, on créé les table grâce à doctrine. Il faut exécuter la commande :
`php app/console doctrine:schema:update --force`

##Les Routes :
| Fonction               | Methodes    | Chemin                                 | Nom de la route                |
| -----------------------|-------------|----------------------------------------|--------------------------------|
| indexAction            | ANY         | /                                      | index                          |
| testAction             | ANY         | /test                                  | test                           |
| rechercheAction        | ANY         | /recherche                             | recherche_service              |

##Notes
Pensez à utiliser la commande `composer update` à chaque pull.

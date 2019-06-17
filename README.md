# Blog php

A blog created with PHP using Slim framework and Twig with CRUD Method and a Bootstrap Template.
  * Visitors : Can only read the articles and comments.
  * Members : Visitors who can add, edit and delete their own comments.
  * Authors : Members who can add, edit and delete their own articles.
  * Admins : Manage users, articles, comments and categories.
(More details in french below)

## Getting Started
CLone the repository with 
`git clone https://github.com/marween/blogphp.git` 

### Prerequisites

Be sure you have PHP and composer installed.


### Installing

You need to run `composer install` and  `npm install`to install the dependencies.


### Deployement

In 3 differents terminal tabs, run
* `docker-compose up` 
* `gulp` 
* `php -S localhost:8080 -t public`

### Use the website

The user registered is the admin, and you can log in with
* username : Admin
* password : j'aiunmotdepassegenial

### Known issues

### Useful links
  * Trello
  * Bootswatch (darkly)

## Team

* [Nadine T.](https://github.com/NadTr)
* [Anne-Magali S.](https://github.com/marween)
* [Jonathan B.](https://github.com/odaeyes)
* [Pauline R.](https://github.com/PaulineRoppe)


# blogphp




## Contraintes de l'exercice
* L'application devra être codée en PHP.
* Le PHP "vanilla" n'est pas autorisé. L'application devra fonctionner avec le framework [Slim](http://www.slimframework.com/) et être respectueuse des bonnes pratiques en vigueur en PHP quand on utilise ce type de framework. (Comme le fait de commencer chaque fichier PHP par `<?php` et de ne jamais refermer ce tag.)
* Le moteur de template [Twig](https://twig.symfony.com/) doit être utilisé pour la génération des pages HTML. Aucune autre solution ne peut être utilisée pour cela, y compris le fait de générer du HTML directement en PHP.
* **Le JavaScript est interdit**. A l'exception des cas suivants: des effets visuels mineurs ou pour le système de build (type Parcel, Gulp, Grunt, Webpack,...). Nous avons bien conscience qu'aucun site web moderne ne tourne plus sans JavaScript. Cette contrainte a pour but de vous permettre de comprendre comment fonctionne un site web "old school" en même temps que vous apprendrez le PHP et le SQL.
* L'application devra utiliser une base de données [PostgreSQL](https://www.postgresql.org/)
* Pour se connecter à la base de données l'application devra utiliser directement PDO (PHP Data Objects).
* En développement il faudra utiliser le serveur de développement fourni par PHP.
* Toujours en développement il faudra utiliser [Docker](https://www.docker.com/) pour la base de données avec un fichier docker-compose.yml qui vous sera fourni.
* Il est obligatoire d'utiliser des scripts automatisés pour le déploiement. (Par exemple en bash.)
* Utiliser Sass et un design qui ressemble à un blog...
* Pour les mots de passe **il est strictement obligatoire** (pas seulement chez BeCode mais aussi et surtout selon la loi Européenne) de les hasher avec un algorithme approprié. Le plus recommandé est [bcrypt](https://en.wikipedia.org/wiki/Bcrypt).

### Blog côté visiteurs
- Le blog comprendra au moins **8 articles**, au moins **3 catégories** et **4 auteurs** (ben oui, vous êtes 4...).
- La page d’accueil du blog doit afficher les 5 derniers articles.
- Chaque article comprendra :
	- un titre
	- un auteur (l'utilisateur qui a créé l'article)
	- un contenu texte
	- une date de publication
	- une ou plusieurs catégories affiliées. (un article au moins devra être affilié à plusieurs catégories)
- On doit pouvoir commenter les articles si on est loggé. (Un commentaire comprend un texte et le nom de l'auteur)
- On doit pouvoir afficher sur une page "categorie" les différents articles d’une seule catégorie.
- Idem pour les auteurs.
- La partie visiteur doit comporter des boutons "Login" et "Signup" pour se logger ou se créer un compte.
- Un utilisateur doit avoir un nom d'utilisateur et un mot de passe.

Pour les textes, vous pouvez utiliser du lorem ipsum.

BONUS: Ecrivez des textes originaux.

### Blog côté admin
- Connexion au blog avec un compte admin.
- Menu qui propose de nouvelles options quand on est connecté (exemple : liens vers la gestion des articles, des catégories, des auteurs)
- Un dashboard avec la liste de tous les articles, leurs catégories, leurs auteurs.
- Possibilité d'ajouter un article, une catégorie, un auteur. 
- Possibilité de modifier un article, une catégorie, un auteur, la date de publication.
- Possibilité de supprimer un article, une catégorie, un auteur, un commentaire (histoire qu'il n'y ait que des commentaires positifs ;) ).

#### Utilisateurs
- Possibilité d'administrer les utilisateurs.
  - Par défaut quand un utilisateur est créé il a juste le droit de commenter les articles.
  - Il faut fournir la possibilité d'ajouter le droit de rédaction d'article aux utilisateurs (donc de devenir auteur).    


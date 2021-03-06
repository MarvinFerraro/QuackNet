### Symfony
<br/>
<br/>

##### Prérequis
* PHP 7.3 (et la variable d'environnement mise en place)
* Un IDE
* Une invite de commande
* Composer d'installé dans le projet
* Une connexion internet.

<br/>
<br/>

##### Etapes l'environnement de travail

Installer composer. [Lien de composer](https://getcomposer.org/) <br/>
Installer npm. [Lien de npm](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm)  `npm install npm -g` <br/>

Télécharger Symfony sur le site et l'installer (Définir la variable d'environnement pour symfony). <br/>
* [Lien de Symfony](https://symfony.com/) <br/>
<br />

##### Etapes pour installation du projet

* Récupérer le projet depuis github. <br/>

* Rentrer dans le projet créer <br/>

* **Instalation des dépendences du projet**.
    1. Faire un `composer install` dans le project. <br/>

    2. Faire un `npm -install` . <br/>

* Ensuite modifier vos informations dans le .env pour les configurations de votre phpMyAdmin. <br/>

* Créer votre base de données en faisant un `php bin/console doctrine:database:create` <br/>

* Créer votre schema de base de données en faisant un `php bin/console doctrine:schema:create` <br/>

* Ensuite mettre à jour votre base de donnés avec les infos présentent dans le projet en faisant un `php bin/console doctrine:schema:update`
<br/>

###### Pour lancer votre projet.
Pour tester votre projet, vous pouvez faire un `symfony server:start` (`start -d` si vous voulez qu'il tourne en arrière-plan)
Et allez sur l'adresse donnée par symfony pour voir votre projet.

<br/>
<br/>


###### Si vous voulez faire un nouveau projet symfony.

Checker si les prérequis de Symfony sont respectés grâce à : `symfony check:requirements` <br/>

Créer un nouveau projet Symfony à l'endroit voulu : `symfony new nom_du_projet --full` <br/>

Installer l'ORM pack de Symfony avec Composer : `composer require symfony/orm-pack` <br/>

Voila symfony est installé et un projet vierge ready to go !. [Well done](https://tenor.com/view/goodjob-clap-nicework-great-gif-7248435)

<br/>
<br/>

##### Documentation
* [Lien de Symfony](https://symfony.com/)
* [Installation de Symfony(Doc)](https://symfony.com/doc/current/setup.html)
* [Doctrine](https://symfony.com/doc/current/doctrine.html)
* [Twig](https://twig.symfony.com/doc/2.x/)




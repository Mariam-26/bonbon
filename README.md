1. Installation de Composer
2. Installation de notre Symfony grâce à `composer create-project symfony/website-skeleton nomProjet`
3. Customisation du fichier .env avec nos identifiants et le nom de notre BDD.
4. `php bin/console doctrine:database:create` qui va envoyer notre nouvelle BDD vers phpMyAdmin
5. `php bin/console make:entity Nomtable` qui va permettre de créer la table de notre BDD
6. `php bin/console make:migration`qui enregistre les changements dans un fichier dans le dossier Migrations
7. `php bin/console doctrine:migrations:migrate`qui envoie les changements dans la BDD
8. Pour créer des controllers qui permettront de lancer des vues et définir ce qu'on y affiche on utilisera la commande `php bin/console make:controller NomController`
9. Pour lancer un serveur local , se rendre sur commander de mysql: `php -S localhost:8000 -t public`
10. Cette commande créera deux fichiers :
    1.Le controller dans lequel on pourra définir la route mais aussi le chemin d'accès au fichier en Twig
    2.Le template twig qu'on pourra personnaliser selon nos besoins
11. Pour faire un formulaire, on utilisera la commande `php bin/console make:form NomFormType` . Lorsque l'on fait cette commande, Symfony nous demande à partir de quelle entité on veut faire notre formulaire, dans l'exemple on précise Articles, et il génère 1 fichier dans lequel les champs de notre table sont décrits
12. La page générée (ici ArticlesFormType) peut être customisée pour y ajouter des options :
    1.  On peut dire le type de champs que l'on attend (TextTy, TeaxtareaType, CheckboxType, DateType, FileType, etc.)
    2.  On peut préciser directement dans ce fichier des classes
    3.  On peut dire que l'on veut recevoir des fichiers uniquement avec certaines extensions (par exemple, on accepte seulement les jpeg, jpg, gif et png)
    4.  On peut préciser si on veut une image en mode protrait ou encore en mode paysage
    5.  Et on peut définir les messages d'erreur si les données entrées dans le formulaire par l'utilisateur ne correspondent pas à ce que l'on attend
13. Pour faire une nav on fera un fichier externe (nav.html.twig) et sur lequel on fera un include pour qu'il soit présent sur notre fichier base.html.twig
14. Pour faire la table User (nomenclature générale) on utilisera la ligne de commande `php bin/console make:user`. Cette façon de faire, nous génère facilement une table adaptée à l'enregistrement et à l'authentification de nouveaux utilisateurs. Cette entité pourra être modifiée si on veut y ajouter des champs grâce à la ligne de commande `php bin/console make:entity User` => mise à jour de l'entité
15. Pr l'authentification, il existe une cmde : `php bin/console make:auth` (auth = authentification, ) Pr s'authentifier il ns demande plusieurs étapes
16. D'abord su quoi dt de baser notre authenticator (généramt on dira 1 => Login form authenticator)
17. Le nom de la classe
18. Le nom du controller

19. Cette méthode ns crée automatiquemt plusieurs fichiers (SecurityController => permet d'obtenir une méthode de connexion sécurisée // Ds le dossier Security, un fichier UserAuthenticator.php sr lequel il faudra faire ds modifications et qui permet de customisée des routes, etc // Ds les templates, ds un dossier security, un fichier login.html.twig ds lequel se trouve le formulaire de cxonnexion). En fin il a mis à jour un fichier très important : ds config / packages / security.yaml => l'authentification et le chemin pr la déconnexion.
20. Pr créer l'inscription, on utilise la ligne de cmde `php bin/console make:registration-form`. Un certain nombre de questions st ensuite posées  : notamt sr ou on vt être redirigé, quel nom on vt donner à ntre classe, etc. Plusieurs fichiers st générés :

21. RegistrationController
22. RegistrationFormType => il faudra faire bien attention à mettre ts ls champs pr l'inscription SANS l'id et le rôle // Pr un site de prod, il faudra penser à ajouter ls conditions d'Utilisation
23. Register.html.twig ds templates/registration
24. ATTENTTION suite à ds problèmes avec lz version 2.12 de ORM il faut des modififications ds le fichier COMPOSER.JSON

    1. A la ligne 13 :  ``"doctrine/orm": "^2.11",``
    2. A la ligne 97, rajouter  ``"doctrine/orm": "2.12.0"``
    3. Enfin ds le terminal, faire la ligne de commande `composer update` et vous pouver maintenant faire une entité
POUR INSERRER UN CONTENU
<p class="card-text">{{article.content | striptags | slice(0,70)}} ...</p>
{{ article.content | raw}}








 

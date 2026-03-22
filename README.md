# AuthentikATOR

[Programme d'authentification à double facteurs TOTP](https://github.com/luhan-gui/Authentikator) pour la plateforme Alizon.

## Documentation 

Utilisation de la librairie [OTPHP](https://github.com/spomky-labs/otphp) de [Spomky-Labs](https://github.com/spomky-labs)

## Vidéo de présentation

N'hésitez pas à consulter la vidéo de démonstration d'Authentikator [ici](https://www.youtube.com/watch?v=WQe56tWeVgQ) !

### Définition des pages par ordre d'accès

- [index.php](index.php) : Page de départ de l'authentification à deux facteurs (A2F) pour tester dans l'environnement.

- [A2F-pres.php](A2F-pres.php) : Page de présentation de l'authentification à deux facteurs (A2F) pour les utilisateurs d'Alizon, expliquant les avantages et les étapes d'activation de cette fonctionnalité de sécurité.

- [A2F-code.php](A2F-code.php) : Page de configuration de l'authentification à deux facteurs (A2F) pour les utilisateurs d'Alizon.

- [A2F-conf.php](A2F-conf.php) : Page de confirmation de l'activation de l'authentification à deux facteurs (A2F) pour les utilisateurs d'Alizon, informant les utilisateurs que leur compte est désormais protégé par l'A2F et fournissant des instructions sur la manière de gérer cette fonctionnalité de sécurité.

- [A2F-conn.php](A2F-conn.php) : Page de connexion de l'authentification à deux facteurs (A2F) pour les utilisateurs d'Alizon, permettant aux utilisateurs de saisir le code OTP généré par leur application d'authentification afin de vérifier leur identité et de les connecter sur leur compte. Cette page envoie le traitement du code OTP au backend pour validation et redirige les utilisateurs vers la page de confirmation en cas de succès.

- [A2F-fin.php](A2F-fin.php) : Page indiquant que l'utilisateur est connecté après avoir activé l'authentification à deux facteurs (A2F) dans le cadre de la démonstration d'Authentikator, avec des instructions pour garder la clé secrète et tester la désactivation de l'A2F.

- [A2F-supr.php](A2F-supr.php) : Page de suppression de l'authentification à deux facteurs (A2F) pour les utilisateurs d'Alizon, permettant aux utilisateurs de désactiver cette fonctionnalité de sécurité en suivant les étapes nécessaires pour supprimer l'A2F de leur compte Alizon.

- [A2F-confSupr.php](A2F-confSupr.php) : Page de confirmation de la désactivation de l'authentification à deux facteurs (A2F) pour les utilisateurs d'Alizon, informant les utilisateurs que leur compte n'est plus protégé par l'A2F et fournissant des instructions sur la manière de gérer cette fonctionnalité de sécurité.

- [A2F-term.php](A2F-term.php) : Page indiquant la fin de l'utilisation d'Authentikator après avoir testé la désactivation de l'authentificateur, avec des instructions pour consulter l'A2F sur le site d'Alizon et réessayer l'implémentation en retournant à l'accueil.

### Back-end

- [A2F-test.php](backend/A2F-test.php) : Programme de vérification du code OTP envoyé par le client pour l'activation de l'authentification à deux facteurs. Ce script reçoit les informations nécessaires (email, secret, OTP) via une requête GET en AJAX, vérifie la validité du code OTP en utilisant la bibliothèque OTPHP, et si le code est correct, il enregistre les informations dans la base de données PostgreSQL. En cas d'erreur ou de code incorrect, il renvoie un code de réponse HTTP 403 pour indiquer que l'accès est refusé.

- [A2F-testCon.php](backend/A2F-testCon.php) : Programme de vérification du code OTP envoyé par le client pour confirmer la connexion. Ce script reçoit les informations nécessaires (email, secret, OTP) via une requête GET en AJAX, vérifie la validité du code OTP en utilisant la bibliothèque OTPHP, et si le code est correct, il renvoie ok. En cas d'erreur ou de code incorrect, il renvoie un code de réponse HTTP 403 pour indiquer que l'accès est refusé.

- [A2F-testSupr.php](backend/A2F-testSupr.php) : Programme de vérification du code OTP envoyé par le client pour la désactivation de l'authentification à deux facteurs. Ce script reçoit les informations nécessaires (email, OTP) via une requête GET en AJAX, vérifie la validité du code OTP en utilisant la bibliothèque OTPHP, et si le code est correct, il supprime les informations associées à l'email de la base de données PostgreSQL pour désactiver l'A2F. En cas d'erreur ou de code incorrect, il renvoie un code de réponse HTTP 403 pour indiquer que l'accès est refusé.

## Base de données

- [authentikator.sql](sql/authentikator.sql) : Table servant au stockage de la clé secrète

## Script JS

- [inputs.js](script/inputs.js) : Script servant à vérifier les caractères rentrés dans les champs et à changer de champ lorsque l'un est complété.

## Lancement et utilisation

Lancer le script SQL dans une base PostgreSQL.
Lancer un serveur PHP local.

Pour commencer, l'utilisateur est invité à allez vers index.php, qui lui demandera une adresse email fictive pour simuler un compte Alizon.
En validant l'email, l'utilisateur se retrouve sur une page expliquant l'utilité d'un OTP.
Il peut ensuite générer une clé secrète ainsi qu'un QR code afin de configurer son appli d'OTP.
En confirmant la clé avec un code généré par l'application d'OTP, la configuration de l'A2F est réussi.
Il peut ensuite se connecter et confirmer la connexion avec un nouveau code OTP.
Après cela, il peut, s'il le souhaite, désactiver l'A2F en cliquant sur le bouton du même nom.
Il est donc redirigé vers la page de désactivation de l'A2F et rentre son code OTP une dernière fois afin de le désactiver.
Il peut ensuite rejoindre la page de fin le remerciant d'avoir testé Authentikator.


#### Développé par la SkibidiCorp 
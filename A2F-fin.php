<!-- 
    Fichier : A2F-fin.php
    Description : Page indiquant que l'utilisateur est connecté après avoir activé l'authentification à 
                deux facteurs (A2F) dans le cadre de la démonstration d'Authentikator, 
                avec des instructions pour garder la clé secrète et tester la désactivation de l'A2F.
    Auteur : SkibidiCorp - Luhan
    Date de création : 22/03/2026
    Libraries utilisées : X
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A2F - Fin</title>
    <link rel="stylesheet" href="style/style.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #064082;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Vous êtes connecté !</h1>
    Garder votre clé secrète pour la prochaine étape pour pouvoir désactiver l'A2F. <br>
    Vous pouvez tester la désactivation de l'A2F en cliquant sur le bouton ci-dessous :
    <a href="A2F-supr.php">Désactiver l'A2F</a>
</body>
</html>
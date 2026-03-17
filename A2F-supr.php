<!-- 
    Fichier : A2F-supr.php
    Description : Page de suppression de l'authentification à deux facteurs (A2F) pour les utilisateurs d'Alizon, 
                permettant aux utilisateurs de désactiver cette fonctionnalité de sécurité en suivant les étapes 
                nécessaires pour supprimer l'A2F de leur compte Alizon.
    Auteur : SkibidiCorp - Luhan
    Date de création : 17/03/2026
    Libraries utilisées : OTPHP (pour la génération de TOTP)
-->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Alizon - A2F</title>
</head>

<body>
    <main>
        <img class="logo" src="img/logo_alizon_front.svg" alt="Logo Alizon">
        <section class="container">
            <h4> Êtes-vous sûr de vouloir désactiver l'A2F ?</h4>
            <p>Désactiver l'A2F vous expose à un risque accru de compromission de votre compte, car vous ne bénéficierez
                plus de la protection supplémentaire offerte par l'authentification à deux facteurs. En désactivant
                cette fonctionnalité, vous ne serez plus tenu de fournir un code de vérification à six chiffres généré
                par votre application d'authentification lors de chaque connexion. Cela signifie que si quelqu'un
                parvient à obtenir votre mot de passe, il pourra accéder à votre compte sans aucune barrière
                supplémentaire. Nous vous recommandons vivement de maintenir l'A2F activé pour garantir la sécurité
                maximale de votre compte Alizon. Si vous avez des préoccupations ou des questions concernant la
                désactivation de l'A2F, n'hésitez pas à contacter notre support client pour obtenir de l'aide et des
                conseils sur la meilleure façon de protéger votre compte.
            </p>
        </section>
        <a class="bouton" href="A2F-code.php">Activer l'A2F</a>
        <a class="btnJaune" href="">Retour</a>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>

</html>
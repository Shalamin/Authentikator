<!-- 
    Fichier : index.php
    Description : Page de départ de l'authentification à deux facteurs (A2F) pour tester dans l'environnement.
    Auteur : SkibidiCorp - Luhan
    Date de création : 13/03/2026
    Libraries utilisées : X
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A2F-Index</title>
</head>
<body>
    <h1>Bonjour !</h1>
    Bienvenue sur la page de démonstration de l'authentification à deux facteurs (A2F). <br>
    Cette page sert à rentrer des informations pour tester l'implémentation de l'A2F. <br>
    Rentrer dans les champs suivants une adresse email afin de pouvoir tester l'implémentation de l'A2F. <br>
    <form>
        <input type="email" id="email" name="email" placeholder="Entrez votre adresse email" required>
        <button type="submit">Valider</button>
    </form>
    <script>
        // Récupérer les éléments du formulaire
        let inputEmail = document.getElementById("email");
        let submit= document.querySelector("button[type='submit']");

        // Fonction pour créer un cookie et rediriger vers la page de présentation de l'A2F
        function setCookie(name, value) {
            //Annuler comportement de base HTTP
            event.preventDefault();
            //Créer cookie
            document.cookie = `${name}=${encodeURIComponent(value)};`
            document.location.href = "A2F-pres.php"; 
        }
        //Écouteur bouton de validation
        submit.addEventListener("click", function(event) {
            //Récupère la valeur du formulaire
            let email = inputEmail.value;
            //Vérifie que l'email n'est pas vide
            if (email) {
                setCookie('email', email);
            } else {
                alert("Veuillez entrer un email valide.");
            }
        });
    </script>
</body>
</html>
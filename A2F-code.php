<!-- 
    Fichier : A2F-code.php
    Description : Page de configuration de l'authentification à deux facteurs (A2F) pour les utilisateurs d'Alizon.
    Auteur : SkibidiCorp - Luhan
    Date de création : 2025-03-09
    Libraries utilisées : OTPHP (pour la génération de TOTP)
-->


<?php
    session_start();

    // Charge les dépendances de Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use OTPHP\TOTP;
    use OTPHP\InternalClock;
    use OTPHP\Factory; 

    // Horloge pour génération de TOTP
    $clock = new InternalClock();

    // Ajout d'info dans la session pour test
    $_SESSION['email'] = "luhan@gmail.com";
    $email = $_SESSION['email'];

    //Génération du secret et du QR code pour l'utilisateur
    $totp = TOTP::generate($clock, 16);
    $totp = $totp->withLabel($email);
    $goqr_me = $totp->getQrCodeUri(
    'https://api.qrserver.com/v1/create-qr-code/?color=000000&bgcolor=FFFFFF&data=[DATA]&qzone=2&margin=0&size=300x300&ecc=M',
    '[DATA]');
    $secret = $totp->getSecret();
    require_once('_env.php');
    loadEnv('.env');
    //if (!isset($_SESSION['user_id'])) {
    //    header('Location: login.php');
    //    exit();
    //}
    
    if (isset($_POST['code1'], $_POST['code2'], $_POST['code3'], $_POST['code4'], $_POST['code5'], $_POST['code6'])) {
        
        $totp = TOTP::createFromSecret($secret);
        $code = $_POST['code1'] . $_POST['code2'] . $_POST['code3'] . $_POST['code4'] . $_POST['code5'] . $_POST['code6'];
        if ($totp->verify($code)) {
            $add=$bdd->prepare('INSERT INTO information (email, secret) VALUES (:email, :secret)')->execute(['email' => $email, 'secret' => $secret]);
            $add->execute();
            header('Location: A2F-conf.php');
            exit();
        } else {
            echo "<script>alert('Code de vérification incorrect. Veuillez réessayer.');</script>";
        }
    }
    
    //Récupérer les variables
    $host = getenv('PGHOST');
    $port = getenv('PGPORT');
    $dbname = getenv('PGDATABASE');
    $user = getenv('PGUSER');
    $password = getenv('PGPASSWORD');
    
    // Connexion à PostgreSQL

        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
        $bdd = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $bdd->query('set schema \'authentikator\'');
    $req = $bdd->prepare('SELECT secret FROM information WHERE email = :email');
    $req->execute(['email' => $email]);
    
?>
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
            <h4> Voici votre clé secrète : <?php echo $totp->getSecret(); ?></h4>
            <?php echo "<img src='{$goqr_me}' class='QR' alt='QR Code Alizon'>"; ?>
            <p> Veuillez entrer cette clé dans votre application d'authentification pour générer les codes de vérification à six chiffres nécessaires pour l'authentification à deux facteurs (A2F). Assurez-vous de conserver cette clé en lieu sûr, car elle est essentielle pour configurer votre compte Alizon avec l'application d'authentification. En cas de perte de cette clé, vous pourriez rencontrer des difficultés pour accéder à votre compte Alizon via l'A2F. </p>
            <p>Lorque vous avez entré la clé dans votre application d'authentification, veuillez rentrer votre code de vérification à six chiffres ci-dessous pour finaliser l'activation de l'authentification à deux facteurs (A2F) de votre compte Alizon.</p>
                <form action="A2F-code.php" method="post">
                    <h4>Insérer votre code</h4>
                    <div class="code">
                        <input class="chiffre" type="text" name="code1" placeholder="-">
                        <input class="chiffre" type="text" name="code2" placeholder="-">
                        <input class="chiffre" type="text" name="code3" placeholder="-">
                        <h1>-</h1>
                        <input class="chiffre" type="text" name="code4" placeholder="-">
                        <input class="chiffre" type="text" name="code5" placeholder="-">
                        <input class="chiffre" type="text" name="code6" placeholder="-">
                    </div>
                    <button class="bouton" type="submit">Valider</button>
                </form>
        </section>
        <a class="btnJaune" href="A2F-pres.php">Retour</a>
    </main>
    <?php include 'includes/footer.php';?>
    <script>
        // Récupère tous les champs .code et les convertit en tableau
        const inputs = Array.from(document.querySelectorAll('.code input'));
        const len = inputs.length;

        // Pour les 6 champs,
        inputs.forEach((input, i) => {
            // Limite à 1 caractère et force le clavier chiffre sur mobile
            input.setAttribute('maxlength', '1');
            input.setAttribute('inputmode', 'numeric');

            // Fonction utilitaire pour placer le focus sur l'index demandé (saturé à la fin)
            const focusNext = (idx) => {
            const next = Math.min(idx, len - 1);
            inputs[next].focus();
            };

            // Lorsqu'un utilisateur saisit quelque chose dans l'input
            input.addEventListener('input', (e) => {
            // garde que les chiffres
            let v = (input.value || '').replace(/\D/g, '');

            if (v.length === 1) {
                // Saisie d'un seul chiffre puis passe au champ suivant
                input.value = v;
                if (i < len - 1) inputs[i + 1].focus();
                return;
            }

            // Si plusieurs chiffres collés/saisis (coller d'un code entier), on répartit
            for (let k = 0; k < v.length && (i + k) < len; k++) {
                inputs[i + k].value = v.charAt(k);
            }
            const nextIndex = i + v.length;
            if (nextIndex < len) focusNext(nextIndex);
            else inputs[len - 1].focus();
            });

            // Gestion des touches (retour arrière, blocage des caractères non numériques)
            input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace') {
                e.preventDefault();
                if (input.value === '') {
                // Si champ vide, on efface et retourne sur le champ précédent
                if (i > 0) {
                    inputs[i - 1].value = '';
                    inputs[i - 1].focus();
                }
                } else {
                // Sinon, on efface simplement la valeur du champ
                input.value = '';
                }
                return;
            }
            // Bloque les touches non numériques
            if (e.key.length === 1 && !/\d/.test(e.key)) {
                e.preventDefault();
            }
            });
        });
    </script>
</body>
</html>
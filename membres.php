<!-- Page membres.php qui permet l'authentification de l'utilisateur -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <title>Membres</title>
</head>

    <!-- MENU DE NAVIGATION -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="membres.php">Membres <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="connexion.php">Connexion <span class="sr-only"></span></a>
                </li>
            </ul>
        </div>
    </nav>

<body>
    <h1 class="text-center">La page des membres</h1>

<?php 
    require_once("inc/db.php");

    //var_dump($_SESSION);

    if(!isset($_SESSION["estConnecte"])){

        // Récupération de l'information du form
        if(isset($_POST['unom']) && isset($_POST['umdp'])){
            $username = trim($_POST['unom']);
            $password = trim($_POST['umdp']);    

            // Vérifications de sécurité
            // Prevent sql injection
            $username = stripslashes($username);
            $password = stripslashes($password);

            // Htmlentities prevent script execution
            $username = htmlentities($username);
            $password = htmlentities($password);

            $username = mysqli_real_escape_string($connect, $username);
            $password = mysqli_real_escape_string($connect, $password);

            // Vérification dans la BD si c'est exact
            $query = "SELECT * FROM utilisateurs WHERE unom='$username' and umdp='$password'";

            $resultat = mysqli_query($connect, $query);

            $rangee = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
            $compteur = mysqli_num_rows($resultat);

        if($compteur == 1){
            $_SESSION['estConnecte'] = true;
            $_SESSION['usager'] = $username;
            $_SESSION['level'] = $rangee['level'];
        }else{
            echo "<br><br>
            <h2 style='color:red;'>
                <center> Connexion échouée: nom d'utilisateur ou mot de passe invalide. </center>
            </h2>
            <br><br>
            <a href='connexion.php'>Retour</a>";
        }

    }else{
        header("Location:index.php");
    }
}
?>
</body>
</html>
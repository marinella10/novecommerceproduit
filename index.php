<?php  session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet"> 

    <title>Produit my sql</title>
</head>
<body>

<header>
  <?php require_once 'menu.php'?>
</header>



<div class="text-center">
<h1> SITE ECOMMERCE DE MARINE</h1>
</div>

<div class="text-center">
    <img src="image/imageslogoe.jpg" alt="logo e-commerce" title="e-commerce">

</div>


<!-- ajouter un formulaire html avec la method post-->

<div class="container-fluid">
<form id="formulaire-connexion" method="post">


<div class="formulaire">
<div class="mb-3">
<label for="email" class="formulaire-label">Email</label>
<input type="email" class="formulaire-input" id="email" name="email" required>
</div>

<div class="mb-3">
<label for="password" class="formulaire-label">mot de passe</label>
<input type="password" class="formulaire-input" id="password" name="password" required>
</div>

<!--creer un lien-->
<a class="mdp" href="">mot de passe oublier?</a>
<br/>

<!--creer un bouton submit qui appelle le name -->
<button type="submit" name="btnConnect"class="btn-connexion" class="mt-3 btn-warning">connexion</button>
</div>
</div>



<?php
//creer la method post pourb récuperer le bouton btnconnect
if (isset($_POST['btnConnect'])){

    //fait un click, var_dump ($email);
    connection ();



}

// Créer une fonction de connexion 
function connection(){
//faille xss= on hydrate les données = Sanitizer
//trin- supprime les espaces (ou d'autres caracteres) en début et fin de cahine
//htmlspecialchars - convertit les caractères dpéciaux en entités HTML :: Cette fonction retourne une chaine de caractère avec ses notifications
$emailUtilisateur = trim(htmlspecialchars($_POST["email"]));
$passewordUtilisateur = trim(htmlspecialchars($_POST["password"]));



if(isset($emailUtilisateur) && !empty($emailUtilisateur) && isset($passewordUtilisateur) && !empty($passewordUtilisateur)){
    $email = "test@test.fr";
    $password = "test";

    // Les matchs de connexion 
    if($emailUtilisateur == $email && $passewordUtilisateur == $password){
        $_SESSION["email"] = $emailUtilisateur;
        header("Location: produit.php ");

    }else{
        echo "<p class='alert alert-danger p-3'> Erreur de connexion: merci de vérifier votre mail  et mot de passe</p>";
    } 

}else{
    echo "<div class='nt-3 container'>
    <p class='alert alert-danger p-3'> Erreur de connexion: merci de remplir tous les  champs</p>
    </div>";
}

var_dump($emailUtilisateur);
var_dump($passewordUtilisateur);

}



?>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
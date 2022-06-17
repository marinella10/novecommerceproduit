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

    <title>PHP CRUD CONNECTION</title>
    <title> Page Ajouter administrateur</title>
</head>
<body>

<header>
  <?php require_once 'menu.php'?>
</header>

<div class="container-fluid">
            <span class="mt-3 d-flex justify-content-around">
                <h3 class="mt-3 text-warning">BIENVENUE <?= $_SESSION['email'] ?></h3>
                <form method="post">
                    <button id="btn-deconnexion" name="btn-deconnexion" class="btn btn-danger">DECONNEXION</button>
                </form>
            </span>

<!--Creation formulaire traitement ajout d'adminitratreur-->
<div class="container" id="form-container">
<!--ajout de l'attribut enctype qui Permet de telecharger  tous type de fichier (.pdf, .txt, .jpg,.webp, etc...)-->

<form action="traitement_adminitrateur_ajouter.php"  id="form-login" method="post" enctype="multipart/form-data">
    <div class="text-center">
        <img src="image/imageslogoe.jpg" alt="logo e-commerce" title="ecommerce.com">
    </div>


    <div class="mb-3">
        <label for="email" class="form-label">email</label>
        <input type="text" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">password</label>
        <input type="text" class="form-control" id="password" name="password" required>
    </div>


    <!--ajout d'un bouton submit qui permet d'"envoyer less donner d'un formulaire-->
    <div class="d-flex justify-content-around">
        <button type="submit" name="btn-connexion" class="btn btn-warning">Ajouter</button>
        <a href="administrateur.php" class="btn btn-success">Annuler</a>
    </div>

</form>

<?php
//Deconnexion et destruction de la session $_SESSION['email']
function deconnexion(){
    var_dump("hello");
    echo "elloo";
    session_unset();
    session_destroy();
    header('Location: index.php');
}

//Click sur le bouton de deconnexion
if(isset($_POST['btn-deconnexion'])){
    deconnexion();

    }

?>

</body>
</html>
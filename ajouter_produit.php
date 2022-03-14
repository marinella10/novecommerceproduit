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
    <title> Page Ajouter produit</title>
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


<!--Creation formulaire traitement ajout de produit-->
<div class="container">
<!--ajout de l'attribut enctype qui Permet de telecharger  tous type de fichier (.pdf, .txt, .jpg,.webp, etc...)-->

<form action="traitement_produit_ajouter.php"  id="form-login" method="post" enctype="multipart/form-data">
    <div class="text-center">
        <img src="image/imageslogoe.jpg" alt="logo e-commerce" title="ecommerce.com">
    </div>
    <div class="mb-3">
        <label for="nom_produit" class="form-label">Nom du produit</label>
        <input type="text" class="form-control" id="nom_produit" name="nom_produit" required>
    </div>

    <div class="mb-3">
        <label for="descripttion_produit" class="form-label">Description</label>
        <textarea class="form-control" rows="5" id="descripttion_produit" name="description_produit" required></textarea>
    </div>

    <div class="mb-3">
        <label for="prix_produit" class="form-label">Prix du produit</label>

    <!--ajout de l'attribut step qui permet d'arrondir deux décimals apres la virgule-->
        <input type="number" step="0.01" class="form-control" id="prix_produit" name="prix_produit" required>
    </div>

    <div class="mb-3">
        <label for="stock_produit" class="form-label">Disponible</label>
        <select class="form-control" name="stock_produit" id="stock_produit" required>
            <option value="0">OUI</option>
            <option value="1">NON</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="date_depot" class="form-label">Date de dépot du produit</label>
        <input type="date" class="form-control" id="date_depot" name="date_depot" required>
    </div>

    <div class="mb-3">
        <label for="image_produit" class="form-label">Image du produit</label>
        <input type="file" class="form-control" id="image_produit" name="image_produit" required>
    </div>

    <div class="d-flex justify-content-around">
        <button type="submit" name="btn-connexion" class="btn btn-warning">Ajouter</button>
        <a href="produits.php" class="btn btn-success">Annuler</a>
    </div>
</form>

</div>
</div>

<?php
//Deconnexion et destruction de la session $_SESSION['email']
function deconnexion(){
    var_dump("hello");
    echo "elloo";
    session_unset();
    session_destroy();
    header('Location: ../index.php');
}

//Click sur le bouton de deconnexion
if(isset($_POST['btn-deconnexion'])){
    deconnexion();


}else{
echo "<a href='' class='btn btn-warning'>S'inscrire</a>";
header('Location: ../index.php');
}
?>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
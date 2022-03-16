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
    <title> TRAItement produit ajouter</title>
</head>
<body>

<header>
  <?php require_once 'menu.php'?>
</header>



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

<!--pour télécharger des fichiers de différents formats //Upload de fichier-->
<form enctype="multipart/form-data">

<!--input de type file + attribut name=""-->
<imput type="file" class="form-control"


<?php

// Verifier l'existance avec isset de ma superglobale $_FILES-->
if(isset($_FILES['image_produit'])){


    // Variable pour ajouter le repertoire de destination
    $repertoireDestination = "../assets/img/";
    //La photo uploader
    
    //  // viariable pour ajouter le repertoire de destination + la composante final d'un chemin(basename) et qui prend en paramettre en tableau associatif multidimentionnel
    $photo_produit = $repertoireDestination . basename($_FILES['image_produit']['name']);
    //Recup de l'image uploader
  
    //On assigne l'image uploader au repertoire de destination + la photo + son nom
    $_POST['image_produit'] = $photo_produit;

    
    //Les conditions de resussite
    //move_uploaded_file — Déplace un fichier téléchargé
    //On assigne a la photo un nom temporaire random en cas d'echec d'upload
    if(move_uploaded_file($_FILES['image_produit']['tmp_name'], $photo_produit)){
        echo "<p class='container alert alert-success'>Le fichier est valide et téléchargé avec succès !</p>";
    }else{
        echo "<p class='container alert alert-danger'>Erreur lors du téléchargement de votre fichier !</p>";
    }
}else{
    echo "<p class='container alert alert-danger'>Le fichier est invalide seul les format .png, .jpg, .bmp, .svg, .webp sont autorisé !</p>";
}


//Connexion a la base de donnée ecommer via PDO
//Les variable de phpmyadmin
$user = "root";
$pass = "";
//test d'erreur
try {
    /*
     * PHP Data Objects est une extension définissant l'interface pour accéder à une base de données avec PHP. Elle est orientée objet, la classe s’appelant PDO.
     */
    //Instance de la classe PDO (Php Data Object)
    $dbh = new PDO('mysql:host=localhost;dbname=ecommerce', $user, $pass);
    //Debug de pdo
    /*
     * L'opérateur de résolution de portée (aussi appelé Paamayim Nekudotayim) ou, en termes plus simples,
     * le symbole "double deux-points" (::), fournit un moyen d'accéder aux membres static ou constant, ainsi qu'aux propriétés ou méthodes surchargées d'une classe.
     */
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class='container alert alert-success text-center'>Vous êtes connectez a PDO MySQL</p>";

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

if($dbh){
    //Requète SQL de selection des produits
    $sql = "INSERT INTO `produits`(`id_produit`, `nom_produit`, `description_produit`, `prix_produit`, `stock_produit`, `date_depot`, `image_produit`) VALUES (?,?,?,?,?,?,?)";
    //Requète préparée = connexion + methode prepare + requete sql
    //Les requètes préparée lutte contre les injections SQL
    //PDO::prepare — Prépare une requête à l'exécution et retourne un objet
    $insert = $dbh->prepare($sql);
    //Bindé les paramètre
    //Liés les paramètre du formulaire a la table phpmyadmin
    //PDOStatement::bindParam — Lie un paramètre à un nom de variable spécifique
    $insert->bindParam(1, $_POST['id_produit']);
    $insert->bindParam(2, $_POST['nom_produit']);
    $insert->bindParam(3, $_POST['descripttion_produit']);
    $insert->bindParam(4, $_POST['prix_produit']);
    $insert->bindParam(5, $_POST['stock_produit']);
    $insert->bindParam(6, $_POST['date_depot']);
    $insert->bindParam(7, $_POST['image_produit']);

    //executer la requète préparée
    //PDOStatement::execute — Exécute une requête préparée
    //Elle execute la reqète passé dans un tableau de valeur
    $insert->execute(array(
        $_POST['id_produit'],
        $_POST['nom_produit'],
        $_POST['descripttion_produit'],
        $_POST['prix_produit'],
        $_POST['stock_produit'],
        $_POST['date_depot'],
        $_POST['image_produit']
    ));

    if($insert){
        echo "<p class='container alert alert-success'>Votre produit a été ajouté avec succès !</p>";
        echo "<a href='produits.php' class='container btn btn-success'>Voir mon produit</a>";
    }else{
        echo "<p class='alert alert-danger'>Erreur lors de l'ajout de produit</p>";
    }

}else{
    echo "<a href='' class='btn btn-warning'>S'inscrire</a>";
}
?>


    ?>














<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
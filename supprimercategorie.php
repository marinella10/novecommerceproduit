<?php
session_start();

if(isset($_SESSION["email"])){
echo "Bienvenue : " . $_SESSION["email"];
?>



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

    <title> PHP CRUD SUPPRIMER</title>

    <title>Produit my sql</title>
</head>
<body>

<header>
    <?php require_once 'menu.php'?>
</header>


<?php
// connexion de base de donnée ecomerce via PDO
// Les variables de phpmyadmin
$user = "root";
$pass = "";

//test d'erreur
try {
    //Instance de la classe PDO (Php Data Object)
    $dbh = new PDO('mysql:host=localhost;dbname=ecommerce', $user, $pass);
    /*
    * PHP Data Objects est une extension définissant l'interface pour accéder à une base de données avec php. elle est orientée objet, la clase s'appelant PDO.
    */
//Instance de la classe PDO (Php Data Object)
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class='container alert alert-success text-center'>Vous êtes connnectez à PDO My SQL</p>";


} catch (PDOException $e) {
    print "erreur!: " .$e->getMessage() . "<br/>";
    die();
}


if ($dbh) {
//Requète SQL de selection des produits
    $sql = "SELECT * FROM produits WHERE id_produit = ?";

    $id_produit = $_GET['id_produit'];
//Grace a PDO on accède à la methode query()
//Requète préparée
    $request = $dbh->prepare($sql);
//Lié les paramètres
    $request->bindParam(1, $id_produit);

//Execution de la requète
    $request->execute();
//Retourne un objet de resultats
    $details = $request->fetch(PDO::FETCH_ASSOC);

}
?>
<form method="post" id="form-delete">
    <p class="text-center text-danger">SUPPRIMER LE PRODUIT</p>
    <p class="text-center text-success"><?= $details['nom_produit'] ?></p>
    <p class="text-center text-warning"><?= $details['descripttion_produit'] ?></p>
    <p class="text-center text-info">
        <img src="<?= $details['image_produit'] ?>" class="img-thumbnail" alt="" title="" width="200"/>
    </p>

    <button type="submit" name="btn-supprimer" class="btn btn-success">confirmer la suppression</button>

</form>

<div class="d-flex justify-center">
    <button type="submit" name="btn-deconnexion">DECONNEXION</button>
    <a href="produit.php" class="btn btn-primary">Annuler</a>

</div>


<?php
if(isset($_POST['btn-supprimer'])){
    //ecrire une requete sql qui supprime votre categorie
    $sql ='DELETE FROM categorie WHERE id_categorie = ?';
//Créer une requète préparée pour lutter contre les injection sql

//créer une requête préparée pour lutter contre les injections SQL
    $supp = $dbh->prepare($sql);

//Récup de id du categorie du categorie
    $idcategorie = $_GET['id_categorie'];

//lié les paramétres du bouton à la requète SQL
    $supp->bindParam (1, $idcategorie);
    $supp->execute();

    if($supp){
        echo "<p class='container alert alert-success'>Votre categorie a bien été supprimer!</p>";
        echo "<div class='container'><a  href='produit.php' class='mt-3 btn-success'>RETOUR</a></div>";

        // On cache les datails du produit avec du CSS
        ?>
        <style>
            #form-delete {
                display: none;
            }
        </style>
        <?php
    }else{
        //Sinon message d'erreur et on recomence
        echo "<p class='alert alert-danger'>Erreur lors de la supression du produit !</p>";
        echo "<div class='container'><a href='produits.php' class='mt-3 btn btn-success'>RETOUR</a></div>";
    }
}

//0 - Une cles etrangère est une reference a une cle primaire d'une autre table
//1- Selectionne tous de la table produits
//2- Joint la table categories ou (table) produits.(cle etrangère) = (table) categories.(cle primaire)
//3 - Joint la table vendeurs ou (table) produits.(cle etrangère) =  (table) vendeurs.(cle primaire)
//4 - Joint la tablecommentaires ou (table) produits.(cle etrangère) = (table)  commentaires.(cle primaire)
//5 - On ajoute le prediquat where qui filtre les produits par id (cle primaire des produits)

$sql = "SELECT * FROM produits 
                    INNER JOIN categorie ON produits.id_categorie = categorie.id_categorie 
                    INNER JOIN vendeurs ON produits.id_vendeur = vendeurs.id_vendeur ";
$produits = $dbh->query($sql);


//lutte contre les injection SQL
$request = $dbh->prepare($sql);
//On recup l'id dans url enboyée par : depuis la page produits.php
/*
 <a href="produit_details.php?id_produit=<?= $produit['id_produit'] ?>" class="btn btn-success">Details du produits</a>
 */
$id = $_GET['id_produit'];
//On lie les paramètres
//Ici 1 = WHERE id_produit = ?
//et devient : $_GET['id_produit'];
$request->bindParam(1, $id);
//On execute la requète
$request->execute();
//On liste le resultat de la requète
$produit_details = $request->fetch();
//Debug
//var_dump($details_produit);

?>
<div class="container produit_details" id="produit_details">
    <div class="titre-produit-container">
        <h2 class="text-danger"><?= $produit_details['nom_produit']; ?></h2>
    </div>

    <div class="text-center">
        <img src="<?= $produit_details['image_produit'] ?>" alt="<?= $produit_details['nom_produit']; ?>" title="<?= $produit_details['nom_produit']; ?>" class="img-details-produit img-thumbnail">
    </div>

    <p class="mt-3">Catégories : <b class="text-info"><?= $produit_details["categorie"]; ?></b></p>
    <p class="text-info"><b>Description :</b></p>
    <em><?= $produit_details["descripttion_produit"]; ?></em>
    <p>Prix : <b class="text-success"><?= $produit_details["prix_produit"]; ?> €</b></p>
    <!--LES DATES-->
    <!--LE STOCK BOOL-->
    <!--LE NOM DES VENDEURS-->
    <p class="text-danger">Nom du vendeur : <?= $produit_details['nom_vendeur'] ?></p>
    <?php
    $date = new DateTime($produit_details['date_depot']);
    if($produit_details == true){
        echo "<p>En stock = OUI</p>";
    }else{
        echo "<p>En stock = NON</p>";
    }

    ?>
    <p>Date de depot : <?= $date->format("d/m/Y") ?></p>
    <a href="produit.php" class="btn btn-warning">Retour aux produits</a>

    <form method="post">
        <button type="submit" name="btn-delete" class="mt-3 btn btn-danger">Confirmer la suppression du produit</button>
    </form>



</div>

</div>
</div>

<?php
//Deconnexion et destruction de la session $_SESSION['email']
function deconnexion(){
    var_dump("hello");
    echo "elloo";
    session_unset();
    session_destroy();

}

//Click sur le bouton de deconnexion
if(isset($_POST['btn-deconnexion'])){
    deconnexion();
}

}else{
    header("Location: inde.=x.php");
}
?>

</body>
</html>


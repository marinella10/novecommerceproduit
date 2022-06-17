<?php
session_start();
//si tu es connecter
if (isset($_SESSION["email"])){
echo "Bienvenue : " . $_SESSION["email"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">


    <title> PHP CRUD CONNECTION </title>


</head>
<body>

<!-- appelle de la page menu -->
<header>
    <?php require_once 'menu.php' ?>
</header>


<!--bouton déconnexion-->
<form method="post">
    <button class="deconnexion" type="submit" name="btn-deconnexion">DECONNEXION</button>
</form>


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

// ci- dessous vous etes connectés à PDO est caché en utilisant un commmentaire en php


//echo "<p class='container alert alert-success text-center'>Vous êtes connnectez à PDO My SQL</p>";

} catch (PDOException $e) {
    print "erreur!: " . $e->getMessage() . "<br/>";
    die();
}


//Deconnexion et destruction de la session $_SESSION['email']
function deconnexion()
{
    var_dump("hello");
    echo "elloo";
    session_unset();
    session_destroy();
    header('Location: index.php');
}

//Click sur le bouton de deconnexion
if (isset($_POST['btn-deconnexion'])) {
    deconnexion();
}




if ($dbh) {
    //Requète SQL de selection des produits
    $sql = "SELECT * FROM produits";
    // Gràace à PDO on accède à la method query ()
    //PDO::query() prépare et exécute une requête préparée et, une fois exécutée, le jeu de résultats associé.
    $produits = $dbh->query("SELECT * FROM produits");

}

?>

<div class="container">

    <div class="text-center">
        <a href="ajouter_produit.php"class="btn btn-danger">Ajouter un produit</a>
    </div>

    <h3 class="mt-3 text-warning">Vos produits</h3>
    <div class="row">
<?php
            //0 - Une cles etrangère est une reference a une cle primaire d'une autre table
            //1- Selectionne tous de la table produits
            //2- Joint la table categories ou (table) produits.(cle etrangère) = (table) categories.(cle primaire)
            //3 - Joint la table vendeurs ou (table) produits.(cle etrangère) =  (table) vendeurs.(cle primaire)
            //4 - Joint la tablecommentaires ou (table) produits.(cle etrangère) = (table)  commentaires.(cle primaire)

            $sql = "SELECT * FROM produits 
                    INNER JOIN categorie ON produits.id_categorie = categorie.id_categorie 
                    INNER JOIN vendeurs ON produits.id_vendeur = vendeurs.id_vendeur ";
            $produits = $dbh->query($sql);

            foreach ($produits as $produit) {
                //Exemple de requète externe
                /*
                 Ce type de requête va nous permettre de récupérer toutes les données (relatives aux colonnes spécifiées) de la table de gauche
                 c’est-à-dire de notre table de départ ainsi que les données de la table de droite
                (table sur laquelle on fait la jointure) qui ont une correspondance dans la table de gauche.
                 */


                //ici on fait un requete sur la table vendeurs qui affiche tous les produits qui ont le vendeur LIDL
                //SELECT * FROM `vendeurs` LEFT JOIN produits ON vendeurs.id_vendeur = produits.vendeur_id WHERE vendeurs.nom_vendeur = "LIDL"
                ?>
                    <div class="mt-3 produits col-md-3 col-sm-12">
                        <div class="card p-5">
                            <div class="titre-produit-container">
                                <h2 class="text-primary"><?= $produit['nom_produit']; ?></h2>
                            </div>

                            <img src="<?= $produit['image_produit'] ?>" alt="<?= $produit['nom_produit']; ?>" title="<?= $produit['nom_produit']; ?>" class="img-produit img-thumbnail">
                            <p class="mt-3">Catégories : <b class="text-info"><?= $produit["type_categorie"]; ?></b></p>
                            <p class="text-info"><b>Description :</b></p>
                            <em><?= $produit["descripttion_produit"]; ?></em>
                            <p>Prix : <b class="text-success"><?= $produit["prix_produit"]; ?> €</b></p>
                            <!--LES DATES-->
                            <!--LE STOCK BOOL-->
                            <!--LE NOM DES VENDEURS-->
                            <p class="text-primary">Nom du vendeur : <?= $produit['nom_vendeur'] ?></p>
                            <!--le  tel du vendeur-->
                            <p class="text-primary">Tel du vendeur : <?= $produit['tel_vendeur'] ?></p>
                            <div class="text-center">
                                <a href="produit_details.php?id_produit=<?= $produit['id_produit'] ?>" class="btn btn-success">Details du produits</a>
                               <a href="editer_produit.php?id_produit=<?= $produit['id_produit'] ?>" class="mt-3 btn btn-info">Editer le produit</a>
                                <a href="supprimer.php?id_produit=<?= $produit['id_produit'] ?>" class="mt-3 btn btn-danger">Supprimer le produit</a>
                            </div>
                        </div>

                    </div>
                <?php
            }

?>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

<?php
}else{
    header("Location: ../index.php");
}
?>
</body>
</html>



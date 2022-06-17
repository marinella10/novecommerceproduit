<?php
//Demarrer la session php
session_start();
if(isset($_SESSION["email"])){

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
    <!doctype html>
    <html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->

        <link href="../assets/css/bootstrap.css" rel="stylesheet"/>
        <link href="../assets/css/styles.css" rel="stylesheet"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <title>PHP CRUD CONNEXION</title>
    </head>
    <body>
    <header>
       <?php
        require_once "menu.php";
        ?>
    </header>
    <div class="container-fluid">
            <span class="mt-3 d-flex justify-content-around">
                <h3 class="mt-3 text-warning">BIENVENUE <?= $_SESSION['email'] ?></h3>
                <form method="post">
                    <button id="btn-deconnexion" name="btn-deconnexion" class="btn btn-danger">DECONNEXION</button>
                </form>
            </span>




        <div class="container">

            <!--On passe ID pour le traitement-->
            <form method="post">
                <p class="text-center text-primary">DETAILS DU  PRODUIT</p>
                <p class="text-center text-primary"><?= $details['nom_produit'] ?></p>
                <p class="text-center text-primary"><?= $details['descripttion_produit'] ?></p>
                <p class="text-center text-primary">
                    <img src="<?= $details['image_produit'] ?>" class="img-thumbnail" alt="" title="" width="200"/>
                </p>

                <div class="d-flex justify-center">
                    <button type="submit" name="btn-deconnexion">DECONNEXION</button>
                    <a href="produit.php" class="btn btn-primary">Annuler</a>

                </div>
            </form>
        </div>
    </div>
    <?php
    //0 - Une cles etrangère est une reference a une cle primaire d'une autre table
    //1- Selectionne tous de la table produits
    //2- Joint la table categories ou (table) produits.(cle etrangère) = (table) categories.(cle primaire)
    //3 - Joint la table vendeurs ou (table) produits.(cle etrangère) =  (table) vendeurs.(cle primaire)
    //4 - Joint la tablecommentaires ou (table) produits.(cle etrangère) = (table)  commentaires.(cle primaire)
    //5 - On ajoute le prediquat where qui filtre les produits par id (cle primaire des produits)

    $sql = "SELECT * FROM produits 
                    INNER JOIN categorie ON produits.id_categorie = categorie.id_categorie 
                    INNER JOIN vendeurs ON produits.id_vendeur = vendeurs.id_vendeur ";


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
    <div class="container produit_details">
        <div class="titre-produit-container">
            <h2 class="text-danger"><?= $produit_details['nom_produit']; ?></h2>
        </div>

        <div class="text-center">
            <img src="<?= $produit_details['image_produit'] ?>" alt="<?= $produit_details['nom_produit']; ?>" title="<?= $produit_details['nom_produit']; ?>" class="img-details-produit img-thumbnail">
        </div>

        <p class="mt-3">Catégories : <b class="text-info"><?= $produit_details['type_categorie']; ?></b></p>
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
    </div>




    </body>
    </html>


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
    }

}else{
   header("Location: index.php");
}









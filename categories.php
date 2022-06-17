<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>


    <title> Categorie crud</title>


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


if ($dbh) {
    //Requète SQL de selection des
    $sql = "SELECT * FROM categorie INNER JOIN produits ON categorie.id_categorie = produits.id_categorie";
    // Gràace à PDO on accède à la method query ()
    //PDO::query() prépare et exécute une requête préparée et, une fois exécutée, le jeu de résultats associé.
$categories = $dbh->query($sql);

?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">categorie</th>
            <th scope="col">Nom</th>
            <th scope="col">Image</th>
        </tr>
        </thead>

        <tbody>
        <?php

        // Creer la boucle foreach + alias
        foreach ($categories as $category) {
        ?>
            <!--afficher la categorie-->
        <tr>
            <th scope="row"><?= $category['id_categorie']?></th>
            <td><?= $category['type_categorie']?></td>
            <td><?= $category['nom_produit']?></td>
            <td>
                <img src="<?= $category['image_produit']?>" alt="" title="" width="20%">
            </td>
            <td>
                <a href="categorie_editer.php?id_categorie=<?= $category['id_categorie']?>" type="submit" name="btn-delete" class="mt-3 btn btn-danger">Editer</a>
            </td>
        </tr>
        <?php
        }
        ?>

        </tbody>
    </table>
<?php
}
?>

<!--creation bouton editer et separer-->
<div class="text-center">

<button type="submit" name="btn-delete" class="mt-3 btn btn-warning">Séparer</button>
</div>

</body>
</html>








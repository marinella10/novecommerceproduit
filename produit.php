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
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/style.css">

  
<title> PHP CRUD CONNECTION </title>

    <title>Produit my sql et déconnection</title>
</head>
<body>

<header>

  <?php require_once 'menu.php'?>
</header>
<body>


<form method="post">
    <button class="deconnexion"type="submit" name="btn-deconnexion">DECONNEXION</button>
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
//echo "<p class='container alert alert-success text-center'>Vous êtes connnectez à PDO My SQL</p>";

} catch (PDOException $e) {
    print "erreur!: " .$e->getMessage() . "<br/>";
    die();
}

if ($dbh){
    //Requète SQL de selection des produits
    $sql = "SELECT * FROM produits";
    // Gràace à PDO on accède à la method query ()
    //PDO::query() prépare et exécute une requête préparée et, une fois exécutée, le jeu de résultats associé.
    $produits = $dbh->query("SELECT * FROM produits");

}

?>

<div class="container">
                <div class="text-center">
                <button type="button" class="btn btn-info">Ajouter un produit</button>
                    
                </div>

                <h3 class="mt-3 text-warning">Vos produits</h3>

                
                <div class="row">
                    <!--Pour chaque col on affiche une ligne de la table produits de la BDD ecommerce-->
                    <?php
                foreach ($produits as $produit){
                    $date_depot = new DateTime($produit['date_depot']);
                      ?>

                <div class="col-sm-12 col-lg-4 mt-5 py-3 mt-3">
                    <div class="card h-100 p-3 bg-secondery">
                        <div class="text-center">
                            <h4 class="title-carte text-danger"><?= $produit['nom_produit']?></h4>
                            <img src="<?= $produit['image_produit'] ?>" class="carte-img-top img-fluid" alt="<?= $produit['nom_produit'] ?>" title="<?= $produit['nom_produit']?>">
                        </div>

                        <div class="card-title text-center pt-3">
                        <p class="card-text text-danger fw-bold">PRIX: <?=$produit['prix_produit'] ?> €</p>

                        </div>
                    <div class="card-body text-center p-2 ">
                        <p class="CardText3 card-text"><?= $produit['nom_produit'] ?></p>
                        <p class="card-text">DISPONIBLE

                        <?php
                        //var_dump($produit['stock_produit']);
                        if($produit['stock_produit']== true){
                            echo "Oui";
                        }else{
                            echo "NON";
                        }
                       ?>
                       </p>
                       <p>Date de depot : <?= $date_depot->format("d/m/Y h:i:s") ?></p>
                      
                       <!-- Button trigger modal -->
    <div class="text-center">
<button type="button" class="btn btn-primary text-center" data-bs-toggle="modal" data-bs-target="#detail<?= $produit['id_produit']?>">
  détails popop
</button>
</div>
<!-- Modal -->
<div class="modal fade" id="detail<?= $produit['id_produit']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= $produit['nom_produit']?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
          <img src="<?= $produit['image_produit']?>">
        <p><?= $produit['descripttion_produit']?></p>
        <p><?= $produit['prix_produit']?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>







                       
                      

     
                    </br>
                    <div class="container-fluid d-flex justify-content-center py-3">

                   <a href="produit_details.php?id_produit=<?= $produit['id_produit'] ?>" class="mt-2 btn btn-success">Détails</a>
                   <
                       ="produit_details.php?id_produit=<?= $produit['id_produit'] ?>" class="mt-2 btn btn-warning">Editer</>
                   <a href="produit_details.php?id_produit=<?= $produit['id_produit'] ?>" class="mt-2 btn btn-danger">Supprimer</a>

                    </div>


                    </div>
                    </div>
                </div>
              
                <?php
                }
                ?>
                </div>

   
 
  
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

}else{
    echo "<a href='' class='btn btn-warning'>S'inscrire</a>";
    header('Location: index.php');
}

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>



a<?php
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

    <title>Produit my sql</title>
</head>




<body>
<header>

  <?php require_once 'menu.php'?>
</header>
<body>


<form method="post">
    <button type="submit" name="btn-deconnexion">DECONNEXION</button>
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
echo "<p class='container alert alert-success text-center'>Vous êtes connnectez à PDO My SQL</p>";

} catch (PDOException $e) {
    print "erreur!: " .$e->getMessage() . "<br/>";
    die();
}

if ($dbh){
  
    //Ecrire une requète SQL pour recuperer un seul produits
  
        $sql = "SELECT * FROM produits WHERE id_produit = ?";
        //Recuperer l'id du produit depuis URL
        $id_produit = $_GET['id_produit'];
        //echo "L'id du produit  = " .$id_produit;
        $requete = $dbh->prepare($sql);
        //Lie les paramètres id de url =  a ? de ma requète SQL
        //bindparam, c'est pour vérifier et sécuriser une variable avant de l'envoyer en sql
        //bindparam,pour parcourir la base de données
        $requete->bindParam(1, $id_produit);

        $requete->execute();

 //Stocker le resultat dans tableau associatif (cle/valeur) 
 //fetch() retourne les lignes une par une et qd il n'y en a plus, elle va retourner false donc genre l'operation s'arrête.
 // fetch () ça permet de parcourir des données
 $details = $requete->fetch(PDO::FETCH_ASSOC);

    }
    

?>

<div class="container">
                <div class="text-center">
                    <a href="ajouter_produit.php" class="mt-3 btn btn-outline-secondary">Ajouter un produit</a>
                </div>

                <h3 class="mt-3 text-warning">Vos produits</h3>

                <div class="row">
                    <!--Pour chaque col on affiche une ligne de la table produits de la BDD ecommerce-->
                    
                <p> <?php echo $details["nom_produit"]?></p>
                <p> <?php echo $details["descripttion_produit"]?></p>
                <p> <?php echo $details["prix_produit"]?></p>
                <p class="card-text">DISPONIBLE :
                                            <?php
                                            //var_dump($produit['stock_produit']);
                                            if($details['stock_produit'] == true){
                                                echo "OUI";
                                            }else{
                                                echo "NON";
                                            }
                                            ?>
                                        </p>

                </div>

        
               


           <!--rajout d'un lien a href pour retour a la page d'accueil (page des produits) et d'un bouton pour le panier-->
            <div class="container-fluid d-flex justify-content-center">
            <a href="produit.php" class="mt-2 btn btn-success">RETOUR</a>
             <a href="#" class="mt-2 btn btn-warning">Panier</a>
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
</body>
</html>

  





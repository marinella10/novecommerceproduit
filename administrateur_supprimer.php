<?php
session_start();

if(isset($_SESSION["email"])){
    echo "Bienvenue : " . $_SESSION["email"];
    ?>
   

<!DOCTYPE html>
<html lang="fr">
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
<body>


<form method="post">
    <p class="text-center text-danger">SUPPRIMER L'ADMINISTRATEUR</p>
    <p class="text-center text-danger"><?= $details['id_users'] ?></p>
    <p class="text-center text-danger"><?= $details['mail'] ?></p>
    <p class="text-center text-danger"><?= $details['password'] ?></p>
    <p class="text-center text-danger">
        <img src="<?= $details['image_produit'] ?>" class="img-thumbnail" alt="" title="" width="200"/>
    </p>

    <div class="d-flex justify-center"> 
    <button type="submit" name="btn-deconnexion">DECONNEXION</button>
    <a href="administrateur.php" class="btn btn-primary">Annuler</a>

    </div>

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

if (isset($_POST['btn-supprimer']));
//ecrire une requete sql qui supprime votre administrateur
$sql ='DELETE FROM utilisateur WHERE id_users= ?';
//Créer une requète préparée pour lutter contre les injection sql

//créer une requête préparée pour lutter contre les injections SQL
$supp = $dbh->prepare($sql);

//Récup de id du l'administrateur du site
$idProduit = $_GET['id_users'];

//lié les paramétres du bouton à la requète SQL 
$supp->bindParam (1, $idusers);
$supp->execute();

if($supp){
    echo "<p class='container alert alert-success'> L'utilisateur a bien été supprimer!</p>";
    echo "<div class='container'><a  href='produit.php' class='mt-3 btn-success'>RETOUR</a></div>";

    // On cache les datails de l'administrateur avec du CSS
    ?>
        <style>
            #form-delete {
                display: none;
            }
        </styles>
      <?php
    }else{
        //Sinon message d'erreur et on recomence
        echo "<p class='alert alert-danger'>Erreur lors de la supression de l'administrateur!</p>";
        echo "<div class='container'><a href='administrateur.php' class='mt-3 btn btn-success'>RETOUR</a></div>";
    }

}



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

</body>
</html>

  



  



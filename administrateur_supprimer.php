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

<?php
try {
    $db=new PDO("mysql:host=localhost;dbname=ecommerce;charset=UTF8", "root", "" );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "vous etes connectés";

}catch(PDOException $exception){
    echo "erreur de connection" .$exception->getMessage();
    die();
}

//Requète SQL

$sql = "DELETE FROM utilisateur WHERE id_users = ?";

//Stock et Recup de id dans l'url avec la super globale GET
$id = $_GET['id_users'];
//Requète préparée pour lutter contre les injection SQL
$delete = $db->prepare($sql);
//On lie le paramètre de la requète SQL (le ?) a l'id resup dans URL
$delete->bindParam(1, $id);
//On execute la requète et retourne un tableau associatif
$delete->execute();
//Si ca marche
if($delete == true){
?>
<div class="container">
    <?php
    //message de succès + bouton de retour
    echo "<p class='alert alert-success'>L'utilisateur a bien été supprimer</p>";
    echo "<a href='administrateur.php' class='btn btn-warning'>Retour</a>";
    ?>
</div>
<?php
//Sinon une erreur
}else{
    echo "<div class='container'><p class='alert alert-danger'>Erreur lors de la supression de l'administrateur</p></div>";
    var_dump($delete);
}

        }else{
            header("Location: ../index.php");
        }

        ?>



</body>
</html>

  



  



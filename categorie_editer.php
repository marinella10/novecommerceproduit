<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EDITER CATEGORIE</title>
</head>
<body>
<header>
    <?php
    require_once "menu.php";
    ?>
</header>
<div class="mt-4 container bg-main overflow-hidden">

    <div class="row g-2">
        <?php

        try {
            $dbh = new PDO('mysql:host=localhost;dbname=ecommerce;charset=UTF8', "root", "");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connexion a PDO";

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }

        $sql = "SELECT * FROM categorie WHERE id_categorie = ?";


        //lutte contre les injection SQL
        $request = $dbh->prepare($sql);
        //On recup l'id dans url enboyée par : depuis la page categorie.php

        $id = $_GET['id_categorie'];
        //On lie les paramètres
        //Ici 1 = WHERE id_categorie = ?
        //et devient : $_GET['id_categorie'];
        $request->bindParam(1, $id);
        //On execute la requète
        $request->execute();
        //On liste le resultat de la requète
        $categorie = $request->fetch();
        //Debug
        //var_dump($categorie_editer);

        ?>




         <div class="container">

            <!--On passe ID pour le traitement-->

            <form action="categorie_editer_traitement.php" id="form-update" method="post" enctype="multipart/form-data">
                <h3 class="text-info">EDITER LA CATEGORIE</h3>
                <div class="mb-3">
                    <label for="type_categorie" class="form-label">Type categorie</label>
                    <input type="text" class="form-control" id="type_categorie" name="type_categorie" value="<?= $categorie['type_categorie'] ?>" required>
                </div>


                <div class="text-center img-logo">
                    <img src="" alt="logo ecommerce" title="ecommerce.com">
                </div>

            </form>
</body>
</html>
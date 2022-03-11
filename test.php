<div class="row">
                    <!--Pour chaque col on affiche une ligne de la table produits de la BDD ecommerce-->
                    <?php
                foreach ($produits as $produit){
                    $date_depot = new DateTime($produit['date_depot']);
                      ?>

                <div class="col-sm-12 col-lg-4 mt-5 py-3">
                    <div class="carte p-3">
                        <div class="text-center">
                            <h4 class="title-carte text-info"><?= $produit['nom_produit']?></h4>
                            <img src="<?= $produit['image_produit'] ?>" class="carte-img-top img-fluid" alt="<?= $produit['nom_produit'] ?>" title="<?= $produit['nom_produit']?>">
                        </div>

                    <div class="card-body">
                        <p class="card-text1"><?= $produit['nom_produit'] ?></p>
                        <p class="card-text2 text-success fw-bold">PRIX: <?=$produit['prix_produit'] ?> €</p>
                        <p class="card-text3">DISPONIBLE

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
                       <em class="card-text">Date de dépot : <?= $produit['prix_produit'] ?></em>

                       

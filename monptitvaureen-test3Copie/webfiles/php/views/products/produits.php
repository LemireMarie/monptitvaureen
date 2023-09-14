<?php 
session_start();
require_once('../header.php');
require_once('../../actions/dbConnect.php');

if(!empty($conn)):
     //echo "Connexion BDD réussie"; 
?>
<body>
    <header>
        <div class="bg_header">
            <div class="header">
                <img src="../../../../src/img/logo2.jpg" alt="logo de la savonnerie">
                <nav>
                    <ul>
                        <li><a href="./index.php" title="redirection vers la page d'accueil">Accueil</a></li>
                        <li><a href="#" title="redirection vers la page sur nos produits">Nos&nbsp;produits</a></li>
                        <li><a href="./contact.php" title="redirection vers la page de contact">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main class="produits">
    <?php 
                $exec = $conn->query("SELECT * FROM products");
                if($exec != false):

                $res = $exec->fetchAll(PDO::FETCH_ASSOC);

                foreach($res as $tuple):
    ?>
        <div class="savon">
        <?php
                    if(!empty($_SESSION) && $_SESSION["connected"] === TRUE){
                        //var_dump($_SESSION);
                       // require_once("./ajout.php");//
                    ?>
                    <form action="./ajout.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $tuple["id"]; ?>">
                        <button type="submit">Ajouter</button>
                    </form>
                    <form action="../../actions/products/scriptDelete.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $tuple["id"]; ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                    <form action="./formUpdate.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $tuple["id"]; ?>">
                        <button type="submit">Modifier</button>
                    </form>

                    <img class="imgNom" src="<?= $tuple["imgNom"]; ?>" alt="logo du <?= $tuple["nom"]; ?>">   
                    <img class="img" src="<?= $tuple["img"]; ?>" alt="Notre savon le <?= $tuple["nom"]; ?>">
                    <p class="prix"><?= $tuple["prix"]; ?> €</p>
                    <p class="design"><?= $tuple["design"]; ?></p>
                <?php
                }
                else{    
                ?>  
                    <img class="imgNom" src="<?= $tuple["imgNom"]; ?>" alt="logo du <?= $tuple["nom"]; ?>">   
                    <img class="img" src="<?= $tuple["img"]; ?>" alt="Notre savon le <?= $tuple["nom"]; ?>">
                    <p class="prix"><?= $tuple["prix"]; ?> €</p>
                    <p class="design"><?= $tuple["design"]; ?></p>
                <?php
                }
                ?>               
        </div>
                <?php endforeach; ?>
    
                <?php else: ?>
                    <p>Requete SQL non valide.</p>
                <?php endif;?>    
    </main>
    <?php endif;?>
    <?php require("../footer.php"); ?>
<?php
session_start();
include "connexion_bd.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>

    <link rel="stylesheet" href="test.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                <?php
                  
                    
                  $sql0 =  "SELECT * FROM demandeur_cv where CIN='{$_SESSION['cin']}' ";
                  $sth0=$dbco->prepare($sql0);
                  $sth0->execute();
                  $result0 = $sth0->fetchAll(PDO::FETCH_ASSOC);
                   ob_start();
                  echo $result0[0]['photo'];
                  $image = imagecreatefromstring( $result0[0]['photo']); 
                 //You could also just output the $image via header() and bypass this buffer capture.
                  imagejpeg($image, null, 80); 
                  $data = ob_get_contents();
                  ob_end_clean();
              echo '<img  src="data:image/jpg;base64,' .  base64_encode($data)  . '" />';
                  ?>
                </li>

                <li>
                    <a href="dashbord_demandeur.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="cvdemandeur.php">
                        <span class="icon">
                            <ion-icon name="document-outline"></ion-icon>
                            
                        </span>
                        <span class="title">Mon CV</span>
                    </a>
                </li>

                <li>
                    <a href="offre_emp.php">
                        <span class="icon">
                            <ion-icon name="list-outline"></ion-icon>
                            
                        </span>
                        <span class="title">Offres d'emplois</span>
                    </a>
                </li>

                <li>
                    <a href="demandeur_condidatur.php">
                        <span class="icon">
                            <ion-icon name="checkmark-done-outline"></ion-icon>
                        </span>
                        <span class="title">Mes demandes</span>
                    </a>
                </li>

                

                <li>
                    <a href="sign_out.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Déconnexion</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                
</div>
<div class="cardspace">
<div class="cards">
<a href="cvdemandeur.php" style="text-decoration: none;">
    <div class="card" href="index.php">
        <div class="card_body" style="display: flex;align-items: center;justify-content: center;color: rgb(103, 101, 101);">
 <span class="cardtext" style="font-size: 29px;font-weight: bold;font-family: Arial, Helvetica, sans-serif;letter-spacing: 2px;"> Géré Votre CV</span>
        </div>
        <div class="card_bottom" style="display: flex;align-items: center;justify-content: space-between;">
            <span style="margin: 10px;font-size: 17px;font-weight: bold;color:  rgb(68, 67, 67);">Voir Details</span>
            <ion-icon name="caret-forward-outline" style="margin: 10px;font-size: 17px;font-weight: bold;color: rgb(68, 67, 67);"></ion-icon>
                    </div>
    </div>
</a>
</div>
<div class="cards">
<a href="offre_emp.php" style="text-decoration: none;"> 

    <div class="card">
        <div class="card_body" style="display: flex;align-items: center;justify-content: center;color: rgb(103, 101, 101);">
            <span class="cardtext" style="font-size: 29px;font-weight: bold;font-family: Arial, Helvetica, sans-serif;letter-spacing: 2px;"> Lister Les Offres D'emplois</span>
                   </div>
                   <div class="card_bottom" style="display: flex;align-items: center;justify-content: space-between;">
                    <span style="margin: 10px;font-size: 17px;font-weight: bold;color:  rgb(68, 67, 67);">Voir Details</span>
                    <ion-icon name="caret-forward-outline" style="margin: 10px;font-size: 17px;font-weight: bold;color: rgb(68, 67, 67);"></ion-icon>
                            </div>
    </div>
</a>
</div>
<div class="cards">
    <div class="card">
    <a href="demandeur_condidatur.php" style="text-decoration: none;">

        <div class="card_body" style="display: flex;align-items: center;justify-content: center;color: rgb(103, 101, 101);">
            <span class="cardtext" style="font-size: 29px;font-weight: bold;font-family: Arial, Helvetica, sans-serif;letter-spacing: 2px;">  Lister Les Condidatures</span>
                   </div>
        <div class="card_bottom" style="display: flex;align-items: center;justify-content: space-between;">
<span style="margin: 10px;font-size: 17px;font-weight: bold;color:  rgb(68, 67, 67);">Voir Details</span>
<ion-icon name="caret-forward-outline" style="margin: 10px;font-size: 17px;font-weight: bold;color: rgb(68, 67, 67);"></ion-icon>
        </div>
    </div>
</a>
</div>
</div>
               

           
        
    </div>
  </div>

    <!-- =========== Scripts =========  -->
    <script src="app.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
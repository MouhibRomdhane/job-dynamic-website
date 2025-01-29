<?php
session_start();
include "connexion_bd.php";

$etat_cond=array('Attente','Accepté','Réfusé');

$sql = "SELECT * from demandeur_offre where CIN='{$_SESSION['cin']}' ";
      $sth=$dbco->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC); 
      

 




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
 $sql0 =  "SELECT * FROM demandeur_cv where CIN= '{$_SESSION['cin']}' ";
 $sth0=$dbco->prepare($sql0);
 $sth0->execute();
 $result0 = $sth0->fetchAll(PDO::FETCH_ASSOC);
 $image = imagecreatefromstring($result0[0]['photo']); 
ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
 imagejpeg($image, null, 80); 
 $data = ob_get_contents();
 ob_end_clean();
echo '<img    src="data:image/jpg;base64,' .  base64_encode($data)  . '" />';
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
<?php
$etat;
 for($i=0;$i<count($result);$i++)
 {$codoffre=$result[$i]['code_offre'];
 
    $etat=$result[$i]['etatoffrre'];
    $sql1 = "SELECT * FROM offre_emploi where code_offre_emploi=$codoffre ";
	$sth1=$dbco->prepare($sql1);
	$sth1->execute();
	$result1 = $sth1->fetchAll(PDO::FETCH_ASSOC);
    //employeur
   $sql4="SELECT code_registre_commerce from employeur_offre where code_offre_emploi='$codoffre'";
   $sth4=$dbco->prepare($sql4);
        $sth4->execute();
        $result4 = $sth4->fetchAll(PDO::FETCH_ASSOC); 
        $text=$result4[0]['code_registre_commerce'];
       
    $sql5 =  "SELECT * FROM employeur where code_registre_commerce=$text";
        $sth5=$dbco->prepare($sql5);
        $sth5->execute();
        $result5 = $sth5->fetchAll(PDO::FETCH_ASSOC); 
        
        $image = imagecreatefromstring($result5[0]['photo']); 
       ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
        imagejpeg($image, null, 80); 
        $data = ob_get_contents();
        ob_end_clean();
     
        $str="<div class='company-box'> <div class='company'>" ;
        $str=$str."<img class='entr' src='data:image/jpg;base64," .  base64_encode($data)  . "' />  <div class='contenu'>";
        $str=$str." <h2>".$result1[0]['Titre']."</h2>
        <p style='color:gray'>". $result5[0]['nom_entreprise']."-<ion-icon name='location-outline'></ion-icon>".$result1[0]['adresse']." </p>
        <br>
        <p><strong>Salaire :</strong> ".$result1[0]['salaire_propose']." Dt</p>
        </div> 
         
        <div id='Button'>
        <button class='".$etat_cond[$etat]."' disabled>  ".$etat_cond[$etat]."</button>
        </div>
        </div>
        
        <span onclick='toz()' class='arrow'></span>
        <div class='details'>  
                    <br>          
                     
                    <strong>Experience : </strong>" .$result1[0]['nombre_annee_experience']." an(s)
             
                    
                    <strong>Sailire proposée : </strong>". $result1[0]['salaire_propose'] ."
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   
                    <br><p><strong>Description de l'emploi :</strong></p>
                    <p>".$result1[0]['description'] ." :</p>      </div>
                    </div>";
        
        echo $str;

 }


?>
 
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
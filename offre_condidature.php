<?php
include "connexion_bd.php";
session_start();
$codoffre=$_GET['codoffre'];
//systeme de scoring pour l'employeur 
$demandtab= array();
$sql = "SELECT * FROM demandeur_offre  where code_offre='$codoffre'";
	$sth=$dbco->prepare($sql);
	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
    for($i=0;$i<count($result);$i++)
    {//select code diplome pour demandeur
        $cin=$result[$i]['CIN'];
        $sql3 = "SELECT code_diplome  FROM diplome_demandeur where CIN='$cin'";
    $sth3=$dbco->prepare($sql3);
    $sth3->execute();
    $result3 = $sth3->fetchAll(PDO::FETCH_ASSOC);
//select code diplome pour l'offre
$sql4 = "SELECT  * FROM offre_emploi where code_offre_emploi='$codoffre'";
$sth4=$dbco->prepare($sql4);
$sth4->execute();
$result4 = $sth4->fetchAll(PDO::FETCH_ASSOC);
if($result3[0]['code_diplome']==$result4[0]['code_diplome'])
{
         $score=0;
        
        $sql2 = "SELECT * FROM offre_competance where code_offre__emploi='$codoffre' ";
        $sth2=$dbco->prepare($sql2);
        $sth2->execute();
        $result2 = $sth2->fetchAll(PDO::FETCH_ASSOC);
      for($j=0;$j<count($result2);$j++)
      {
        $codcompet=$result2[$j]['code_competence'];
        $sql3 = "SELECT * FROM competence_demandeur where CIN='$cin' and code_competence='$codcompet' ";
        $sth3=$dbco->prepare($sql3);
        $sth3->execute();
        $result3 = $sth3->fetchAll(PDO::FETCH_ASSOC); 
        if(count($result3)==1)
        $score+=5;

        
      }
      $sql3 = "SELECT * FROM demandeur_cv where CIN='$cin'  ";
      $sth3=$dbco->prepare($sql3);
      $sth3->execute();
      $result3 = $sth3->fetchAll(PDO::FETCH_ASSOC);
      $annexp1=$result3[0]['nombre_annees_experience'];
      $annexp2=$result4[0]['nombre_annee_experience'];
      
   
if($annexp1<$annexp2)
{
$score+=2*($annexp2-$annexp1);
}else
$score+=2;


$demandtab[$i]=array($score,$cin);


}

    }
    // Fonction de comparaison personnalisée pour un tri décroissant
function cmp($a, $b) {
    return $b[0] - $a[0];
}

// Tri du tableau en utilisant la fonction de comparaison personnalisée
usort($demandtab, "cmp");

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
                     
                  
                    
                     $sql0 =  "SELECT * FROM employeur where code_registre_commerce= '{$_SESSION['cd_reg']}' ";
                     $sth0=$dbco->prepare($sql0);
                     $sth0->execute();
                     $result0 = $sth0->fetchAll(PDO::FETCH_ASSOC);
                     $image = imagecreatefromstring($result0[0]['photo']); 
                    ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
                     imagejpeg($image, null, 80); 
                     $data = ob_get_contents();
                     ob_end_clean();
                 echo '<img  src="data:image/jpg;base64,' .  base64_encode($data)  . '" />';
                     ?>
                   
                  
                </li>

                <li>
                    <a href="dashbord_employeur.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="ajout_offre_emp.php">
                        <span class="icon">
                        <ion-icon name="add-circle-outline"></ion-icon>
                            
                        </span>
                        <span class="title">Ajouter une offre</span>
                    </a>
                </li>

                <li>
                    <a href="myoffre_employeur.php">
                        <span class="icon">
                            <ion-icon name="list-outline"></ion-icon>
                            
                        </span>
                        <span class="title">Mes offres</span>
                    </a>
                </li>

              

                

                <li>
                    <a href="sign_out.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Déconexion</span>
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
    for($i=0; $i<count($demandtab);$i++)
    {
$cin=$demandtab[$i][1];
        $sql3 = "SELECT * FROM demandeur_cv where CIN='$cin'  ";
        $sth3=$dbco->prepare($sql3);
        $sth3->execute();
        $result3 = $sth3->fetchAll(PDO::FETCH_ASSOC);
       
 $image = imagecreatefromstring($result3[0]['photo']); 
ob_start(); 
 imagejpeg($image, null, 80); 
 $data = ob_get_contents();
 ob_end_clean();

        $str=" <div class='company-box'>
        <div class='company'>
        <img  class='entr'  src='data:image/jpg;base64," .  base64_encode($data)  . "' />
        <div class='contenu'>
            <h2>".$result3[0]['nom']." ".$result3[0]['prenom']."</h2>
        <p style='color:gray'><ion-icon name='location-outline'></ion-icon>".$result3[0]['adresse'] ."</p>
        <br>
        <p><strong>Date de naissance :</strong>". $result3[0]['date_naissance']."</p>
        </div>
        
        
        </div>
        <a href='cvemployeur.php?cin=".$cin."&codeoffre=".$codoffre."'>
        <span  class='arrow2'></span>
    </a>
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
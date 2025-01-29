<?php
include "connexion_bd.php";
session_start();
$score=0;
//systeme de scoring pour le demandeur 
$offretab= array();
$sql = "SELECT * FROM offre_emploi ";
	$sth=$dbco->prepare($sql);
	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
    for($i=0;$i<count($result);$i++)
    {
        
        $sql3 = "SELECT code_diplome  FROM diplome_demandeur where CIN='{$_SESSION['cin']}'  ";
    $sth3=$dbco->prepare($sql3);
    $sth3->execute();
    $result3 = $sth3->fetchAll(PDO::FETCH_ASSOC);
    $codoffre=$result[$i]['code_offre_emploi'];

//pour verifier que le demandeur n'est pas deja postuler 
    $sql2 = "SELECT * FROM demandeur_offre where code_offre='$codoffre'and CIN='{$_SESSION['cin']}'";
    $sth2=$dbco->prepare($sql2);
    $sth2->execute();
    $result2 = $sth2->fetchAll(PDO::FETCH_ASSOC);
    if(count($result2)==0)
    {
if($result3[0]['code_diplome']==$result[$i]['code_diplome'])
{
         $score=0;
        $codoffre=$result[$i]['code_offre_emploi'];
        $sql2 = "SELECT * FROM offre_competance where code_offre__emploi='$codoffre' ";
        $sth2=$dbco->prepare($sql2);
        $sth2->execute();
        $result2 = $sth2->fetchAll(PDO::FETCH_ASSOC);
      for($j=0;$j<count($result2);$j++)
      {
        $codcompet=$result2[$j]['code_competence'];
        $sql3 = "SELECT * FROM competence_demandeur where CIN='{$_SESSION['cin']}' and code_competence='$codcompet' ";
        $sth3=$dbco->prepare($sql3);
        $sth3->execute();
        $result3 = $sth3->fetchAll(PDO::FETCH_ASSOC); 
        if(count($result3)==1)
        $score+=5;

    }
     
     
      $score+=$result[$i]['salaire_propose']/100;




$offretab[$i]=array($score,$codoffre);
 }

}

    }
    // Fonction de comparaison personnalisée pour un tri décroissant
function cmp($a, $b) {
    return $b[0] - $a[0];
}

// Tri du tableau en utilisant la fonction de comparaison personnalisée
usort($offretab, "cmp");

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
 
    for($i=0;$i<count($offretab);$i++)
    {
        $codeoffre=$offretab[$i][1];
        $sql5 =  "SELECT * FROM employeur where    code_registre_commerce= '{$_SESSION['cd_reg']}' ";
        $sth5=$dbco->prepare($sql5);
        $sth5->execute();
        $result5 = $sth5->fetchAll(PDO::FETCH_ASSOC); 
    $sql2 =  "SELECT * FROM offre_emploi where   code_offre_emploi='$codeoffre' ";
$sth2=$dbco->prepare($sql2);
$sth2->execute();
$result2 = $sth2->fetchAll(PDO::FETCH_ASSOC); 

 $image = imagecreatefromstring($result5[0]['photo']); 
ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
 imagejpeg($image, null, 80); 
 $data = ob_get_contents();
 ob_end_clean();

$str="<div class='company-box'> <div class='company'>" ;
$str=$str." <img  class='entr'  src='data:image/jpg;base64," .  base64_encode($data)  . "' /> <div class='contenu'>";
$str=$str." <h2>".$result2[0]['Titre']."</h2>
<p style='color:gray'>". $result5[0]['nom_entreprise']."-<ion-icon name='location-outline'></ion-icon>".$result2[0]['adresse']." </p>
<br>
<p><strong>Salaire :</strong> ".$result2[0]['salaire_propose']." Dt</p>
</div> 
 
<div id='Button'>
<a href='postuler.php?codoffre=".$codeoffre."'>
<button class='Postuler' name='postuler'>Postuler Maintenant</button>
</a></div></div>


<span onclick='toz()' class='arrow'></span>
<div class='details'>  
            <br>          
             
            <strong>Experience : </strong>" .$result2[0]['nombre_annee_experience']." an(s)";
            $text=$result2[0]['code_diplome'];
            $sql5 =  "SELECT `code_diplome`, `libelle_diplome` FROM `diplome` WHERE code_diplome='$text' ";
            $sth5=$dbco->prepare($sql5);
            $sth5->execute();
            $result5 = $sth5->fetchAll(PDO::FETCH_ASSOC);
            
       $str=$str."<strong> Diplome : </strong> ".$result5[0]['libelle_diplome']." 
            
            <strong>Sailire proposée : </strong>". $result2[0]['salaire_propose'] ."
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           
            <br><p><strong>Description de l'emploi :</strong></p>
            <p>".$result2[0]['description'] ." :</p>      </div>
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

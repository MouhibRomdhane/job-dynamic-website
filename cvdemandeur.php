<?php
include "connexion_bd.php";
session_start();


$tab_eatat = array("célibataire", "marié", "veuf");
$sql = "SELECT demandeur_cv.*,diplome_demandeur.code_diplome,universite_demandeur.code_uni
from demandeur_cv,diplome_demandeur,universite_demandeur
where demandeur_cv.CIN='{$_SESSION['cin']}' and demandeur_cv.CIN=diplome_demandeur.CIN and universite_demandeur.CIN=demandeur_cv.CIN;";
$sth=$dbco->prepare($sql);
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
$nompren =$result[0]['nom']." ".$result[0]['prenom'];
$mail=$result[0]['Mail'];
$numtel=$result[0]['num_telephone'];
$adress=$result[0]['adresse'];
$exper=$result[0]['nombre_annees_experience'];
$diplom=$result[0]['code_diplome'];
$univer=$result[0]['code_uni'];
$datenes=$result[0]['date_naissance'];
$etatcev=$tab_eatat[$result[0]['etat_civil']];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cvaffichage.css">
</head>
<body>
    <div class="cont">
        <div class="colorchange">
        <div class="column">
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
<div class="imgname">

<div class="aboutmecord">
    <h1>A Propos De Moi</h1>
    <div class="titletext">
    <h4>Nom & Prenom &nbsp; &nbsp;</h4>
    <?php
  echo "<span>".$nompren."</span>"; 
   ?>
    
</div>
<div class="titletext">
    <h4> Date de Naissance &nbsp; &nbsp;  </h4>
    <?php
  echo "<span>".$datenes."</span>"; 
   ?>
</div>
<div class="titletext">
    <h4> Experiance &nbsp; &nbsp;  </h4>
    <?php
  echo "<span>".$exper." ans </span>"; 
   ?>
</div>
<div class="titletext">
    <h4>Etat Civile &nbsp; &nbsp;  </h4>
    <?php
  echo "<span>".$etatcev."</span>"; 
   ?>
</div>


</div>
</div>
</div>
</div>
<h1>Education</h1>
<div class="column">

    <div class="box">
       
            <h2>Diplome</h2>

        
            <div class="contenu" style="left: 36px;">
            <?php
            $sql = "SELECT libelle_diplome from diplome where code_diplome=$diplom";
            $sth=$dbco->prepare($sql);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
  echo "<span>&#x2022;".$result[0]['libelle_diplome']."</span>"; 
   ?>
  
</div>
</div>
<div class="box">
    
        <h2>Université</h2>

   

        <div class="contenu" style="left: 40px;">
        <?php
            $sql = "SELECT libelle_universite from universite where code_universite=$univer";
            $sth=$dbco->prepare($sql);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
  echo "<span>&#x2022;".$result[0]['libelle_universite']."</span>"; 
   ?>
        </div>
</div>
</div>
<div class="column">

    <div class="box">
        <h1>Info contact</h1>
        
        
        <div class="cordination">
        <div class="icotext">
        <span class="icon">
        
        <ion-icon name="call-outline"></ion-icon>
        </span>
        <?php
  echo "<span>".$numtel."</span>"; 
   ?>
        </div>
        <div class="icotext">
        <span class="icon">
        <ion-icon name="mail-outline"></ion-icon>
        </span>
        <?php
  echo "<span>".$mail."</span>"; 
   ?>
        </div>
        <div class="icotext">
        <span class="icon">
        <ion-icon name="location-outline"></ion-icon>
        </span>
        <?php
  echo "<span>".$adress."</span>"; 
   ?>
         </div>
        </div>
        </div>
        <div class="box">
        
            <h1>Competence</h1>

       
        <div class="contenu" style="left: 36px;">


        <?php
            $sql = "SELECT code_competence from competence_demandeur where CIN='{$_SESSION['cin']}'";
            $sth=$dbco->prepare($sql);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            for($i=0;$i<count($result);$i++)
            {
               $codcom=$result[$i]['code_competence'];
                $sql2 = "SELECT libelle_competence from competence where code_competence='$codcom'";
                $sth2=$dbco->prepare($sql2);
                $sth2->execute();
                $result2 = $sth2->fetchAll(PDO::FETCH_ASSOC);
      echo "<span>&#x2022;".$result2[0]['libelle_competence']."</span>"; 
      
            }
  
   ?>

        </div>
    </div>

    </div>
    <div >
        <a href="cvcontrol.php" style="width: 100%">
        <button  type="submit" name="register" style="    height: 55px;
        width: 100%;
        color: #fff;
        font-size: 1rem;
        font-weight: 400;
        margin-top: 30px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #f1b401;
        border-radius: 8px;">
            Modifier
        </button></a>
    </div>




    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

<?php
session_start();
include "connexion_bd.php";

$sql =  "SELECT `code_registre_commerce`, `code_offre_emploi` FROM `employeur_offre`where code_registre_commerce= '{$_SESSION['cd_reg']}' ";
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
    <title>offres employeurs</title>

    <link rel="stylesheet" href="test.css">
    
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
    <div class="navigation">
            <ul>
                <li>
                  <img src="customer01.jpg" alt="">
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
 

    for($i=0;$i<count($result);$i++)
    {
        
        $codeoffre=$result[$i]['code_offre_emploi'];
        $sql5 =  "SELECT * FROM employeur where    code_registre_commerce= '{$_SESSION['cd_reg']}' ";
        $sth5=$dbco->prepare($sql5);
        $sth5->execute();
        $result5 = $sth5->fetchAll(PDO::FETCH_ASSOC);  
    $sql2 =  "SELECT * FROM offre_emploi where   code_offre_emploi='$codeoffre' ";
$sth2=$dbco->prepare($sql2);
$sth2->execute();
$result2 = $sth2->fetchAll(PDO::FETCH_ASSOC);    
  $str="<div class='company-box'> <div class='company'>" ;
$str=$str." <img class='entr' src='customer01.jpg'> <div class='contenu'>";
$str=$str." <h2>".$result2[0]['Titre']."
<p style='color:gray'>". $result5[0]['code_registre_commerce']."-".$result2[0]['adresse']." </p>
<br>
<br><br><br>
<p><strong>Salaire :</strong> ".$result2[0]['salaire_propose']." dt</p>
 </div>
<div id='iconsdelcon'>
<a  style='text-decoration: none;' href='deleateoffre.php?codoffre=".$codeoffre."'>
    <ion-icon name='trash-outline' class='delico' ></ion-icon>
</a>
</div>
<div id='iconsdelcon2'>
    <a style='text-decoration: none;' href='offre_condidature.php?codoffre=".$codeoffre."'>
   <ion-icon name='people-outline' class='condiico' ></ion-icon>
</a>
</div>

</div>

<span onclick='toz()' class='arrow'></span>
<div class='details'>  
            <br>          
             
            <strong>Experience : </strong>" .$result2[0]['nombre_annee_experience']." an(s)";
            $text=$result2[0]['code_diplome'] ;
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
  </div>

    <!-- =========== Scripts =========  -->
    <script src="app.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
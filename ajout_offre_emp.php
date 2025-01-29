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
<section class="container2">
    <header>Ajouter votre offre d'emploi</header>
    <form action="ajout_offre_emp.php" method="post" class="form">
      <div class="input-box">
        <label>Titre d'offre</label>
        <input type="text" name="titre" placeholder="Entrer le titre de l'offre" required />
      </div>

      <div class="input-box">
        <label>Description </label>
        <textarea name="description" placeholder="description de l'offre....." rows="5" cols="33"></textarea>
      </div>

      <div class="column">
        <div class="input-box">
          <label>Nombre d'années d'experience</label>
          <input name="anneexp"type="number" placeholder="Entrer nombre d'années d'experience" required />
        </div>
        <div class="input-box">
            <label>Salaire</label>
            <input name="salire" type="number" placeholder="Entrer salaire" required />
          </div>
      </div>
      
      
      <div class="column">
          <div class="input-box">
              <label>Diplome</label>
          <div class="select-box">
             
          <select id="diplome" name="diplome" required>
                <?php
                ob_start();
include "connexion_bd.php";
$sql3 = "SELECT * FROM  diplome ";
	$sth3=$dbco->prepare($sql3);
	$sth3->execute();
	$result3 = $sth3->fetchAll(PDO::FETCH_ASSOC);
  echo count($result3);
  for($i=0;$i<count($result3);$i++)
  {
       $str=" <option value='".$result3[$i]["code_diplome"]."'>".$result3[$i]["libelle_diplome"]."</option>";
                 echo $str;
  }
   ?>                 
                </select>
          </div>
      </div>
   
  
      <div class="input-box">
        <label>Adress</label>
        <input type="text" name="adresse" placeholder="Entrer votre address" required />
      </div>
  </div>
 
  <div class="input-box">
  
      <label>Compétence</label>
      <div class="checkbox-container">
        
        <?php
        ob_start();
  include "connexion_bd.php";
  $sql = "SELECT * FROM `competence` ";
      $sth=$dbco->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
  
    for($i=0;$i<count($result);$i++)
    {
     
      $str= "<label><input type='checkbox' name='competance[]' value='".$result[$i]["code_competence"]."'>".$result[$i]["libelle_competence"]."</label>";
   
      echo $str;
    }
  
  
  
  
        ?>
  
      </div>
</div>

  
     
      <button type="submit" name="Ajouter">Ajouter</button>
    </form>
  </section>
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
<?php
include "connexion_bd.php";
if(isset($_POST["Ajouter"]))
{
    $competance=$_POST['competance'];
    $adresse=$_POST['adresse'];
    $diplome=$_POST['diplome'];
    $salire=$_POST['salire'];
    $anneexp=$_POST['anneexp'];
    $description=$_POST['description'];
    $titre=$_POST['titre'];



// Préparer la requête SQL pour mettre à jour les informations du demandeur
$sql = "INSERT INTO `offre_emploi`( `Titre`, `description`, `code_diplome`, `nombre_annee_experience`, `salaire_propose`,adresse) VALUES ('$titre','$description','$diplome','$anneexp','$salire','$adresse')";
$sth=$dbco->prepare($sql);
$sth->execute();
//prendre le code d'offre ajouter pour remplir le tableau offre_competence
$sql2 = "SELECT * FROM `offre_emploi`";
$sth2=$dbco->prepare($sql2);
$sth2->execute();
$result = $sth2->fetchAll(PDO::FETCH_ASSOC);
$n=count($result)-1;
$code_offre=$result[$n]['code_offre_emploi'];
//insertion de competence de l'offre
 $commpet = $_POST['competance'];
 if(!empty($commpet)) 
{

 foreach ($_POST['competance'] as $checkbox) {
  $sth1=$dbco->prepare("INSERT INTO `offre_competance` VALUES ('$code_offre','$checkbox' )");
$sth1->execute();
}

}
//inserer l'offre dans table employeur_offre

$sth6=$dbco->prepare("INSERT INTO employeur_offres (`code_registre_commerce`, `code_offre_emploi`) VALUES ('123789','$code_offre-1')");
$sth6->execute();

header("Location:ajout_offre_emp.php");
		        exit();

}

?>
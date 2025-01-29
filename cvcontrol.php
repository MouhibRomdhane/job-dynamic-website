<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <link rel="stylesheet" href="cvform.css" />
  </head>
  <body>
    <section class="container">
      <header>Modifier Votre Curriculum Vitae</header>
      <form action="cvcontrol.php" class="form" method="post" id="form1">
        <div class="input-box">
          <label>Nom Et Prénom</label>
          <input type="text" name="nompren" id="nompren" placeholder="Entrer nom et prénom" required />
          <p id="erreurnompren"></p>
        </div>

        <div class="input-box">
          <label>Address Email </label>
          <input type="text" name="adrmail" id="adrmail" placeholder="Entrer address email " required />
          <p id="erreuremail"></p>
        </div>

        <div class="column">
          <div class="input-box">
            <label>Numéro De Téléphone</label>
            <input type="number" name="numtel" id="numtel" placeholder="Entrer numéro de téléphone" required />
            <p id="erreurnumtel"></p>
          </div>
          <div class="input-box">
            <label>Date De Naissance</label>
            <input type="date" name="datenais" id="datenais" placeholder="Entrer date de naissance" required />
            <p id="erreurage"></p>
          </div>
        </div>
        
        <div class="etatc-box">
          <h3>Etat civil</h3>
          <div class="etatc-option">
            <div class="etatc">
              <input type="radio" id="check-celib" name="etatcivil" value="0"  />
              <label for="check-celib" >Celibataire</label>
            </div>
            <div class="etatc">
              <input type="radio" id="check-marie" name="etatcivil"  value="1" />
              <label for="check-marie" >Marié</label>
            </div>
            <div class="etatc">
              <input type="radio" id="check-veuf" name="etatcivil"  value="2"/>
              <label for="check-veuf" >Veuf</label>
            </div>
          </div>
          <p id="erreurcivil"></p>
        </div>
        <div class="column">
            <div class="input-box">
                <label>Diplome</label>
            <div class="select-box">
               
                <select id="diplome" name="diplome" required>
                <option value="" selected disabled hidden>Choisir votre diplome</option>
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
            <p id="erreurdiplom"></p>
        </div>
     
    
    <div class="input-box">
        <label>Université</label>
    <div class="select-box">
       
        <select id="universite" name="universite" >
        <option value="" selected disabled hidden>Choisir votre universite</option>
        <?php
include "connexion_bd.php";
$sql3 = "SELECT * FROM  universite ";
	$sth3=$dbco->prepare($sql3);
	$sth3->execute();
	$result3 = $sth3->fetchAll(PDO::FETCH_ASSOC);
  echo count($result3);
  for($i=0;$i<count($result3);$i++)
  {
       $str=" <option value='".$result3[$i]["code_universite"]."'>".$result3[$i]["libelle_universite"]."</option>";
                 echo $str;
  }
   ?>                 
        </select>
    </div>
    <p id="erreuruniv"></p>
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
    <p id="erreurcompet"></p>
</div>
<div class="column">
<div class="input-box">
    <label>Nombere d'années d'expérience</label>
    <input type="number" name="exp_an" placeholder="Entrer Nombere d'années " required />
    <p id="erreurannee"></p>
  </div>


        <div class="input-box ">
          <label>Address</label>
          <input type="text" name="address" placeholder="Entrer votre address" required />
        
          </div>
</div>
          <div class="input-box">
           <center><label >Votre photo</label></center> 
            <div class="Neon Neon-theme-dragdropbox">
                <input style="z-index: 999; opacity: 0; width: 320px; height: 200px; position: absolute; right: 0px; left: 0px; margin-right: auto; margin-left: auto;" name="photo" id="filer_input2" multiple="multiple" type="file">
                <div class="Neon-input-dragDrop"><div class="Neon-input-inner"><div class="Neon-input-icon"><i class="fa fa-file-image-o"></i></div><div class="Neon-input-text"><h3>Drag&amp;Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="Neon-input-choose-btn blue">Browse Files</a></div></div>
                </div>
                <p id="erreurimage"></p>
          </div>
       
          <button type="submit" name="enregister">Enregistrer</button>
      </form>
     
    </section>

  </body>
  <script src="formcv.js"></script>
</html>
<?php
include "connexion_bd.php";
if(isset($_POST["enregister"]))
{

$date_naissance = $_POST["datenais"];
$adr_mail=$_POST["adrmail"];
$etatcivile = $_POST["etatcivil"];
$adresse = $_POST["address"];
$numtel = $_POST["numtel"];
$nb_exp = $_POST["exp_an"];
$code_uni = $_POST["universite"];
$code_dip = $_POST["diplome"];

$photos=$_POST["photo"];


// Préparer la requête SQL pour mettre à jour les informations du demandeur
$sql = "UPDATE `demandeur_cv` SET  `date_naissance`='$date_naissance', `etat_civil`='$etatcivile', `adresse`='$adresse', `num_telephone`='$numtel', `nombre_annees_experience`='$nb_exp', `Mail`='$adr_mail' WHERE `cin`='{$_SESSION['cin']}'";
$sth=$dbco->prepare($sql);
$sth->execute();
//supprimer les anciens donner de diplome demandeur
$sql = "DELETE FROM `diplome_demandeur` WHERE `CIN`='{$_SESSION['cin']}' ";
$sth=$dbco->prepare($sql);
$sth->execute();
//inserer new values
$sql1 = "INSERT INTO `diplome_demandeur` VALUES ('{$_SESSION['cin']}','$code_dip' )";
$sth1=$dbco->prepare($sql1);
$sth1->execute();
//supprimer anciens valeurs de competance demandeur
$sql = "DELETE FROM `universite_demandeur` WHERE `CIN`='{$_SESSION['cin']}' ";
$sth=$dbco->prepare($sql);
$sth->execute();
//ajouter new values
$sql1 = "INSERT INTO `universite_demandeur` VALUES ('{$_SESSION['cin']}','$code_uni' )";
$sth1=$dbco->prepare($sql1);
$sth1->execute();
//supprimer anciens valeurs de competance demandeur
$sql = "DELETE FROM `competence_demandeur` WHERE `CIN`='{$_SESSION['cin']}' ";
$sth=$dbco->prepare($sql);
$sth->execute();
 $commpet = $_POST['competance'];
 if(!empty($commpet)) 
{

 foreach ($_POST['competance'] as $checkbox) {
  $sth1=$dbco->prepare("INSERT INTO `competence_demandeur` VALUES ('{$_SESSION['cin']}','$checkbox' )");
$sth1->execute();
}

}
header("Location:dashbord_demandeur.php");
		        exit();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header></header>

    <section class="login">
        <div class="login_box">
            <div class="left">
                <div class="contactET">
                    <form action="" method="post">
                    <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
                        <input type="text" id="nom_et" placeholder="Nom de l'entreprise" name="et_nom"value="" required />
                        <input type="text" id="nom_ger" placeholder="Nom du gérant" name="ger_nom" required/>
                        <p id="erreurnomger"></p>
                        <input type="text" id="Prenom_ger" placeholder="Prénom du gérant" name="ger_pren"value="" required/>
                        <p id="erreurprenger"></p>
                        <input type="text" id="mail" placeholder="Email" name="ger_mail" required />
                        <p id="erreurmail"></p>
                        <input type="text" id="cd_reg" placeholder="Code du registre commerce" name="code_reg"value="" required/>
                        <input type="text" id="username" placeholder="Nom utilisateur" name="usern"value="" required/>
                        <input type="password" id="password" placeholder="Password" name="p_password" required/> 
                        <input type="password" id="conf_password" placeholder="Confirmer password" name="c_password" required/> 
                        <p id="erreurconfirmpass"></p>

                        <button class="submit" type="submit" name="button">REGISTER</button>
                      
                       
                     
                       
                    </form>
                </div>
            </div>
            <div class="right">
               
            </div>
        </div>
    </section>


 
</body>

</html>
<?php
include "connexion_bd.php";
if (isset($_POST['button'])) 
{

$et =$_POST['et_nom'];
$gernom =$_POST['ger_nom'];
$gerpren =$_POST['ger_pren'];
$germail =$_POST['ger_mail'];
$creg =$_POST['code_reg'];
$usern=$_POST['usern'];
$pass =$_POST['p_password'];
$sql = "SELECT * FROM employeur WHERE code_registre_commerce ='$creg' ";
	$sth=$dbco->prepare($sql);
	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
 $sql2 = "SELECT * FROM employeur WHERE pseudo='$usern' ";
$sth2=$dbco->prepare($sql2);
$sth2->execute();
$result2 = $sth2->fetchAll(PDO::FETCH_ASSOC);
    if(count($result)!=0)
    {
        header("Location: inscription_et.php?error=utilisateur deja existe");
	        exit();
    }
    else
     if(count($result2)!=0){
        header("Location: inscription_et.php?error=Nom utilisateur deja existe");
        exit();
    }
    else
    {
        $sql = "INSERT INTO `employeur`(`code_registre_commerce`, `nom_entreprise`, `nom_gerant`, `prenom_gerant`, `pseudo`, `pass_word`, `mail`) VALUES ('$creg','$et','$gernom','$gerpren','$usern','$pass','$germail') ";
        $sth=$dbco->prepare($sql);
        $sth->execute(); 
        header("Location: index.php");
        exit();
    }




}
?>
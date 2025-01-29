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
                <div class="contact">
                    <form action="" method="post">
                    <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
                        <input type="text" id="nom_emp" placeholder="Nom" name="emp_nom"value=""/>
                        <input type="text" id="Prenom_emp" placeholder="Prénom" name="emp_pren"value=""/>
                        <input type="text" id="n_cin" placeholder="CIN" name="cin"value=""/>
                        <input type="text" id="mail" placeholder="Email" name="emp_mail"/>
                        <input type="text" id="username" placeholder="Nom utilisateur" name="usern"value=""/>
                        <input type="password" id="password" placeholder="Password" name="p_password"/> 
                        <input type="password" id="conf_password" placeholder="Confirmer password" name="c_password"/> 

                        <button class="submit" name="button">REGISTER</button>
                      
                       
                        
                       
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

$nom =$_POST['emp_nom'];
$pren =$_POST['emp_pren'];
$cin =$_POST['cin'];
$mail =$_POST['emp_mail'];
$user =$_POST['usern'];
$pass =$_POST['p_password'];
$sql = "SELECT * FROM demandeur_cv WHERE CIN='$cin' ";
	$sth=$dbco->prepare($sql);
	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
 $sql2 = "SELECT * FROM demandeur_cv WHERE pseudo='$user' ";
$sth2=$dbco->prepare($sql2);
$sth2->execute();
$result2 = $sth2->fetchAll(PDO::FETCH_ASSOC);
    if(count($result)!=0)
    {
        header("Location: inscription_emp.php?error=utilisateur deja existe");
	        exit();
    }
    else
     if(count($result2)!=0){
        header("Location: inscription_emp.php?error=Nom utilisateur deja existe");
        exit();
    }
    else
    {
        $sql = "INSERT INTO `demandeur_cv`(`CIN`, `nom`, `prenom`, `pseudo`, `pass_word`,   `Mail`) VALUES ('$cin','$nom','$pren','$user','$pass','$mail') ";
        $sth=$dbco->prepare($sql);
        $sth->execute(); 
        header("Location: index.php");
        exit();
    }




}
?>
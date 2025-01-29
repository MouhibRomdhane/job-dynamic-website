

<?php 
session_start(); 
include "connexion_bd.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	
	   return $data;
	}

	$uname = validate($_POST['username']);
	$pass = $_POST['password'];

	if (empty($uname)) {
		header("Location: index.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
	$sql = "SELECT * FROM employeur WHERE pseudo='$uname' AND pass_word='$pass'";
	$sth=$dbco->prepare($sql);
	$sth->execute();
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);
	$sql1 = "SELECT * FROM demandeur_cv WHERE pseudo='$uname' AND pass_word='$pass'";
	$sth1=$dbco->prepare($sql1);
	$sth1->execute();
	$result2 = $sth1->fetchAll(PDO::FETCH_ASSOC);
	

		if (count($result2) === 1) {
			$_SESSION['cin'] = $result2[0]['CIN'];
          if ($result2[0]["adresse"] == "" ) {    	
            	
            	header("Location:cv.php");
		        exit();
            }else{
				header("Location:dashbord_demandeur.php");
		        exit();
			}
		}
		else if(count($result) === 1){
            $_SESSION['cd_reg'] = $result[0]['code_registre_commerce'];
			header("Location:dashbord_employeur.php");
			exit();
		}
		else{
			header("Location: index.php?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}


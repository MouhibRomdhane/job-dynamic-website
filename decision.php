<?php
include "connexion_bd.php";
$choix=$_GET['choix'];
$cin=$_GET['cin'];
$codoffre=$_GET['codoffre'];
if($choix=='1')
{
   $sql=" UPDATE `demandeur_offre` SET `etatoffrre`='1' WHERE CIN='$cin'and code_offre='$codoffre'";
   $sth=$dbco->prepare($sql);
	$sth->execute();
}
else
{
    $sql=" UPDATE `demandeur_offre` SET `etatoffrre`='2' WHERE CIN='$cin'and code_offre='$codoffre'";
    $sth=$dbco->prepare($sql);
	$sth->execute();
}
header("location:offre_condidature.php?codoffre=".$codoffre."");
exit();
?>
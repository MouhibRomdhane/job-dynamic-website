<?php
include "connexion_bd.php";
$codeofre=$_GET['codoffre'];
$sql="DELETE FROM `offre_emploi` WHERE code_offre_emploi='$codeofre'";
$sth=$dbco->prepare($sql);
$sth->execute();

header("location:myoffre_employeur.php");
exit();
?>
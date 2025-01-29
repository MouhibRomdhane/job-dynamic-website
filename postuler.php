<?php
session_start();
include "connexion_bd.php";

$codeoffre=$_GET['codoffre'];
$sql = "INSERT INTO demandeur_offre  value('$codeoffre','{$_SESSION['cin']}',0)  ";
      $sth=$dbco->prepare($sql);
      $sth->execute();
      

      header("Location:demandeur_condidature.php");
      exit();






?>
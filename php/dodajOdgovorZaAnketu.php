<?php
$status = 404;

if(isset($_POST['odg']))
{
    
    $odg =$_POST['odg'];
    $idAnkete =$_POST['idAnkete'];

    if($odg == " ")
    {
        $status=406;
    }
    if($odg == "")
    {
        $status=406;
    }
    if($idAnkete == "0")
    {
        $status = 406;
    }
    
    require_once("konekcija.php");
    $upit = "INSERT INTO anketa_odgovori(odgovor,idAnketa) VALUES(:odgovor,:id)";
    $rez= $kon->prepare($upit);
    $rez->bindParam(":odgovor",$odg);
    $rez->bindParam(":id",$idAnkete);
    
    try{
        $rez->execute();
        
        $status = 204;
        
    }catch(PDOException $e)
    {
        echo $e->getMessage();
        $status=500;
    }

    http_response_code($status);

}
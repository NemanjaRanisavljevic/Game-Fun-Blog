<?php
$status = 404;

if(isset($_POST['idAnkete']))
{
    $id = $_POST['idAnkete'];
    $pitanje = $_POST['pitanje'];
    $aktivna = $_POST['aktivna'];

    if($pitanje == " ")
    {
        $status=406;
    }
    if($pitanje == "")
    {
        $status=406;
    }
    
    require_once("konekcija.php");
    $upit = "UPDATE anketa SET pitanje=:p,aktivna=:a WHERE id_a=:id";
    $rez= $kon->prepare($upit);
    $rez->bindParam(":id",$id);
    $rez->bindParam(":p",$pitanje);
    $rez->bindParam(":a",$aktivna);
    
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
<?php
header("Content-type: aplication/json");
$status = 404;
$podaci = null;
if(isset($_POST['id']))
{
    $id =$_POST['id'];
    
    require_once("konekcija.php");
    $upit = "SELECT * FROM kategorije WHERE id=:id";
    $rez= $kon->prepare($upit);
    $rez->bindParam(":id",$id);
    
    try{
        $rez->execute();
        $podaci = $rez->fetch();
        $status = 200;
        
    }catch(PDOException $e)
    {
        echo $e->getMessage();
        $status=500;
    }

    
    
    echo json_encode($podaci);
    http_response_code($status);

}
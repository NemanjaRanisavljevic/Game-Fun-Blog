<?php
$status = 404;

if(isset($_POST['id']))
{
    $id =$_POST['id'];
    $naziv =$_POST['naziv'];

    if($naziv == " ")
    {
        $status=406;
    }
    if($naziv == "")
    {
        $status=406;
    }
    
    require_once("konekcija.php");
    $upit = "UPDATE kategorije SET naziv=:naziv WHERE id=:id";
    $rez= $kon->prepare($upit);
    $rez->bindParam(":id",$id);
    $rez->bindParam(":naziv",$naziv);
    
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
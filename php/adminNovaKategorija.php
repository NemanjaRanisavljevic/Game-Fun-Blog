<?php
$status = 404;

if(isset($_POST['naziv']))
{
    
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
    $upit = "INSERT INTO kategorije(naziv) VALUES(:naziv)";
    $rez= $kon->prepare($upit);
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
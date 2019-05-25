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
    $upit = "INSERT INTO anketa(pitanje,aktivna) VALUES(:pitanje,1)";
    $rez= $kon->prepare($upit);
    $rez->bindParam(":pitanje",$naziv);
    
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
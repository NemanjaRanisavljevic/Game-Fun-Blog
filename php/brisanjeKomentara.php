<?php

if(isset($_POST['id']))
{
    $id =$_POST['id'];
    
    require_once("konekcija.php");
    $upit="DELETE FROM komentari WHERE id=:id";
    $rez=$kon->prepare($upit);
    $rez->bindParam(":id",$id);
    try{
        $bool =$rez->execute();
        if($bool){
            $status=204;
        }
    }catch(PDOException $e)
    {
        $e->getMessage();
        $status = 500;
    }
    http_response_code($status);
}
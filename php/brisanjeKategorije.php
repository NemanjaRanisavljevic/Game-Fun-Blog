<?php
if(isset($_POST['id']))
{
    $id =$_POST['id'];
    
    require_once("konekcija.php");
    $upit="DELETE FROM komentari WHERE idKategirije=:id";
    $rez=$kon->prepare($upit);
    $rez->bindParam(":id",$id);
    try{
        $bool =$rez->execute();
        
        $upit2="DELETE FROM post WHERE idKategorija=:id";
        $rez1=$kon->prepare($upit2);
        $rez1->bindParam(":id",$id);
            try{
                $rez1->execute();
                
            }catch(PDOException $e)
            {
               echo $e->getMessage();
                $status = 500;
            }

        $upit3="DELETE FROM kategorije WHERE id=:id";
        $rez3=$kon->prepare($upit3);
        $rez3->bindParam(":id",$id);
            try{
                $rez3->execute();
                $status=204;
            }catch(PDOException $e)
            {
               echo $e->getMessage();
                $status = 500;
            }

        
    }catch(PDOException $e)
    {
        echo $e->getMessage();
        $status = 500;
    }
    http_response_code($status);
}
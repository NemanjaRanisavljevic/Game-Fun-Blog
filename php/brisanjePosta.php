<?php
if(isset($_POST['id']))
{
    $id =$_POST['id'];
    
    require_once("konekcija.php");
    $upit="DELETE FROM komentari WHERE postId=:id";
    $rez=$kon->prepare($upit);
    $rez->bindParam(":id",$id);
    try{
        $bool =$rez->execute();
        
        $upit2="DELETE FROM post WHERE idPost=:id";
        $rez1=$kon->prepare($upit2);
        $rez1->bindParam(":id",$id);
            try{
                $rez1->execute();
                $status=204;
            }catch(PDOException $e)
            {
                $e->getMessage();
                $status = 500;
            }
        
    }catch(PDOException $e)
    {
        $e->getMessage();
        $status = 500;
    }
    http_response_code($status);
}
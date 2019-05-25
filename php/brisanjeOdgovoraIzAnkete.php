<?php
if(isset($_POST['id']))
{
    $id =$_POST['id'];
    
    require_once("konekcija.php");
    $upit="DELETE FROM anketa_korisnik_odgovor WHERE idOdgovor=:id";
    $rez=$kon->prepare($upit);
    $rez->bindParam(":id",$id);
    try{
        $bool =$rez->execute();
        
        $upit2="DELETE FROM anketa_odgovori WHERE id_od=:id";
        $rez1=$kon->prepare($upit2);
        $rez1->bindParam(":id",$id);
            try{
                $rez1->execute();
                
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
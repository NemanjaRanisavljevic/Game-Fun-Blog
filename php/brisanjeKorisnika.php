<?php
if(isset($_POST['id']))
{   $status =404;
    $id =$_POST['id'];
    var_dump($id);
    require_once("konekcija.php");
    $upit="Delete FROM post WHERE idKorisnik=:id";
    $rez = $kon->prepare($upit);
    $rez->bindParam(":id",$id);
    try{
        $rez->execute();
        $upit2="Delete FROM komentari WHERE korisnikId=:id";
        $rez2 = $kon->prepare($upit2);
        $rez2->bindParam(":id",$id);
        $rez2->execute();

        $upit3="Delete FROM anketa_korisnik_odgovor WHERE idK=:id";
        $rez3 = $kon->prepare($upit3);
        $rez3->bindParam(":id",$id);
        $rez3->execute();

        $upit4="Delete FROM korisnik WHERE idKorisnik=:id";
        $rez4 = $kon->prepare($upit4);
        $rez4->bindParam(":id",$id);
        $rez4->execute();

        $status=204;
    }catch(PDOException $e)
    {
        $e->getMessage();
        $status=500;
    }
    http_response_code($status);
}

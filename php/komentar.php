<?php

$data = null;
if(isset($_POST['idPosta']))
{
    
    $status=404;
    $idPosta = $_POST['idPosta'];
    $idKorisnika = $_POST['idKorisnika'];
    $komentar = $_POST['komentar'];
    $katId = $_POST['idKat'];
   
    $regKomentar="/^[\w\s\d\.\,\:\!\?\@\*]{10,}$/";

    $greske = [];
    if(!preg_match($regKomentar,$komentar))
    {
        array_push($greske,"Komentar nije dobrar");
    }

    if(count($greske)>0)
    {
        $status=400;
    }else
    {
        require_once("konekcija.php");
        $upit="INSERT INTO komentari(sadrzaj,postId,korisnikId,idKategirije)VALUES(:komentar,:post,:korisnik,:idKat)";
        $rez=$kon->prepare($upit);
        $rez->bindParam(":komentar",$komentar);
        $rez->bindParam(":post",$idPosta);
        $rez->bindParam(":korisnik",$idKorisnika);
        $rez->bindParam(":idKat",$katId);
        
        try{
           
            $bool = $rez->execute();
            if($bool)
            {
                $upit2 ="SELECT * FROM komentari kom INNER JOIN korisnik k ON kom.korisnikId=k.idKorisnik WHERE postId=$idPosta ORDER BY id DESC LIMIT 1";
                $rez2 = $kon->query($upit2);
                $podaci = $rez2->fetch();
                
                
                $secemo = substr($podaci->vreme_komentara,0,10);
				$datumNiz=explode("-",$secemo);
									
				$timespamp= mktime(0,0,0,$datumNiz[1],$datumNiz[2],$datumNiz[0]);
                $v1 = date("d",$timespamp);
                $v2 = date("F",$timespamp);
                   
                    
                $secemo = substr($podaci->vreme_komentara,11,19);
				$datumNiz=explode(":",$secemo);
									
				$timespamp= mktime($datumNiz[0],$datumNiz[1],0,0,0,0);
                $vreme = date("H:i",$timespamp);
                
                $ime = $podaci->ime;
                $prezime = $podaci->prezime;
                $sadrzaj = $podaci->sadrzaj;
                $id = $podaci->id;
                $uloga = $podaci->ulogaId;

                
                $data =array(
                    'v1' => $v1,
                    'v2' => $v2,
                    'vreme' => $vreme,
                    'sadrzaj' => $sadrzaj,
                    'ime' => $ime,
                    'prezime' => $prezime,
                    'id' => $id,
                    'uloga' => $uloga
                );
                
                
                $status=200;
            }
        }catch(PDOException $e)
        {
            $status=500;
            $e->getMessage();
        }

    }
header("Content-type: aplication/json");
echo json_encode($data);
http_response_code($status);
}
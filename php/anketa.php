<?php 
session_start();
if(isset($_POST['anketa']))
{
    $idAnketa=$_POST['idAnketa'];
    $idOdgovor=$_POST['idOdgovor'];
    $idKorisnik = $_SESSION['korisnik']->idKorisnik;
    $status=404;
    $obj =[];

    require_once("konekcija.php");

    $upit1="SELECT * FROM anketa_korisnik_odgovor WHERE idK=:korisnik AND anketaId=:anketa";
    $rez= $kon->prepare($upit1);
    $rez->bindParam(":korisnik",$idKorisnik);
    $rez->bindParam(":anketa",$idAnketa);
    

    try{
        $rez->execute();
        if($rez->rowCount()==0)
        {
            $upit2="INSERT INTO anketa_korisnik_odgovor(idk,idOdgovor,anketaId)VALUES(:korisnik,:odgovor,:idAnketa)";
            $rez2=$kon->prepare($upit2);
            $rez2->bindParam(":korisnik",$idKorisnik);
            $rez2->bindParam(":odgovor",$idOdgovor);
            $rez2->bindParam(":idAnketa",$idAnketa);
            try{
                $rez2->execute();
                $status=201;
                array_push($obj,$idOdgovor);

            }catch(PDOException $e){
                $e->getMessage();
                $status=500;
            }
        }else{
            $status=406;
        }





    }catch(PDOException $e)
    {
        $e->getMessage();
        $status=500;
    }

    header("Content-type: aplication/json");
    http_response_code($status);
    echo json_encode($obj);  
}
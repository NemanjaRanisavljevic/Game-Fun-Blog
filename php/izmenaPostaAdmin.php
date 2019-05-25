<?php 
session_start();
if(isset($_POST['postavljenoI']))
{
    
    $igrice = $_POST['igricelista'];
    $naslov = $_POST['naslov'];
    $slika = $_FILES['slika'];
    $opis = $_POST['opis'];
    $id = $_POST['skivenoID'];
    

    $regNaslov ="/^[A-ZČĆŽŠĐ][\s\wčćžšđ]{5,50}$/";
    

    $greske = [];
    if(!preg_match($regNaslov,$naslov))
    {
        array_push($greske,"Los naslov");
        
    }
    if($opis=="")
    {
        array_push($greske,"Los opis");
        
    }

    if($igrice == "0")
    {
        array_push($greske,"Los opis");
        
    }

    $imeFajla =$slika['name'];
    $tipFajla =$slika['type'];
    $velicinaFajla = $slika['size'];
    $tmp_putanja= $slika['tmp_name'];
    
    $dozvoljeni_formati = array("image/jpg", "image/jpeg", "image/png", "image/gif");
            
    if($velicinaFajla==0)
    {
        
        require_once "konekcija.php";

            $upit="UPDATE post SET naslov=:n,opis=:o,idKategorija=:ik WHERE idPost=:id";

            $rez= $kon->prepare($upit);
            $rez->bindParam(":n",$naslov);
            $rez->bindParam(":o",$opis);
            $rez->bindParam(":ik",$igrice);
            $rez->bindParam(":id",$id);
            

            try{
                $bool = $rez->execute();
                if($bool)
                {
                    $_SESSION['uspesanPost']="Uspesno ste postavili post";
                    header("Location: ../index.php?page=adminIzmenaPosta&id=$id");
                }
            }catch(PDOException $e)
            {
                $e->getMessage();
            }

    }else{

        if(!in_array($tipFajla, $dozvoljeni_formati))
        {
        array_push($greske,"Tip fajla nije dobar!");
        
        }

        if($velicinaFajla>3000000){
        array_push($greske,"Prevelika slika!");
        }
    
        if(count($greske)>0)
        {
            $_SESSION['greskaPost']="Pogresno ste uneli neke podatake!";
        }else
        {
            $novoIme=time().$imeFajla;
            $novaPutanja="../images/".$novoIme;
                    
            move_uploaded_file($tmp_putanja,$novaPutanja);
            $novaPutanja="images/".$novoIme;

            require_once "konekcija.php";

            $upit="UPDATE post SET naslov=:n,opis=:o,slika=:s,idKategorija=:ik WHERE idPost=:id";

            $rez= $kon->prepare($upit);
            $rez->bindParam(":n",$naslov);
            $rez->bindParam(":o",$opis);
            $rez->bindParam(":s",$novaPutanja);
            $rez->bindParam(":ik",$igrice);
            $rez->bindParam(":id",$id);
            

            try{
                $bool = $rez->execute();
                if($bool)
                {
                    $_SESSION['uspesanPost']="Uspesno ste postavili post";
                    header("Location: ../index.php?page=adminIzmenaPosta&id=$id");
                }
            }catch(PDOException $e)
            {
                $e->getMessage();
            }

        }
    }

    

}
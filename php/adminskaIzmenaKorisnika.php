<?php
if(isset($_POST['id']))
{
    $id=$_POST['id'];
    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $pol=$_POST['pol'];
    $aktivan=$_POST['aktivan'];
    $uloga=$_POST['uloga'];
    $email=$_POST['email'];
    $sifra=$_POST['sifra'];

    

    $regIme ="/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10}$/";
    $regPrezime ="/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}$/";
    $regSifra ="/^[A-Z][\w\d]{5,}$/";
    

    $greske =[];

    if(!preg_match($regIme,$ime))
    {
        array_push($greske,"Ime nije dobro napisano!");
    }
    if(!preg_match($regPrezime,$prezime))
    {
        array_push($greske,"Prezime nije dobro napisano!");
    }
    if($sifra=="")
    {

    }else
    {
        if(!preg_match($regSifra,$sifra))
        {
            array_push($greske,"Sifra nije dobro napisano!");
        }
    }
    
    if($pol ==0)
    {
        array_push($greske,"Morate izabrati pol");
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        array_push($greske,"Email nije dobar");
    }
    if($uloga == 0)
    {
        array_push($greske,"Morate izabrati pol");
    }


    if(count($greske)>0)
    {
        $status=404;

    }else
    {   require_once("konekcija.php");

        if($sifra=="")
        {
            $upit="UPDATE korisnik SET ime=:ime,prezime=:prezime,polId=:pol,aktivan=:aktivan,ulogaId=:uloga,email=:email WHERE idKorisnik=:id";
            $rez = $kon->prepare($upit);
            
            $rez->bindParam(":ime",$ime);
            $rez->bindParam(":prezime",$prezime);
            $rez->bindParam(":pol",$pol);
            $rez->bindParam(":aktivan",$aktivan);
            $rez->bindParam(":uloga",$uloga);
            $rez->bindParam(":email",$email);
            $rez->bindParam(":id",$id);

            try{
                $bool = $rez->execute();
                if($bool)
                {
                    $status = 201;
                }
                
            }catch(PDOException $e)
            {
                $e->getMessage();
                $status=500;
            }
            
            
        }else{

            $upit="UPDATE korisnik SET ime=:ime,prezime=:prezime,polId=:pol,aktivan=:aktivan,ulogaId=:uloga,email=:email,sifra=:sifra WHERE idKorisnik=:id";
            $rez1 = $kon->prepare($upit);
            
            $rez1->bindParam(":ime",$ime);
            $rez1->bindParam(":prezime",$prezime);
            $rez1->bindParam(":pol",$pol);
            $rez1->bindParam(":aktivan",$aktivan);
            $rez1->bindParam(":uloga",$uloga);
            $rez1->bindParam(":email",$email);
            $rez1->bindParam(":id",$id);
            $sifra=md5($sifra);
            $rez1->bindParam(":sifra",$sifra);

            try{
                $bool = $rez1->execute();
                if($bool)
                {
                    $status = 201;
                }
                
            }catch(PDOException $e)
            {
                $e->getMessage();
                $status=500;
            }
        }
    }





http_response_code($status);
}
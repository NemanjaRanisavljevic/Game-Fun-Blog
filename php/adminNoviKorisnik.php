<?php
if(isset($_POST['ime']))
{
    
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
   
    if(!preg_match($regSifra,$sifra))
    {
            array_push($greske,"Sifra nije dobro napisano!");
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

        $upit="INSERT INTO korisnik(ime,prezime,polId,aktivan,ulogaId,email,sifra)VALUES(:ime,:prezime,:pol,:aktivan,:uloga,:email,:sifra)";
        $rez1 = $kon->prepare($upit);
            
            $rez1->bindParam(":ime",$ime);
            $rez1->bindParam(":prezime",$prezime);
            $rez1->bindParam(":pol",$pol);
            $rez1->bindParam(":aktivan",$aktivan);
            $rez1->bindParam(":uloga",$uloga);
            $rez1->bindParam(":email",$email);
            
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





http_response_code($status);
}
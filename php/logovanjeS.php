<?php
session_start();
if(isset($_POST['logDugme']))
{
    $email= $_POST['emailLog'];
    $sifra= $_POST['sifraLog'];

    $regSifra ="/^[A-Z][\w\d]{5,}$/";
    $greske=[];

    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        array_push($greske,"Email nije u dobrom formatu.");
    }

    if(!preg_match($regSifra,$sifra))
    {
        array_push($greske,"Sifra nije dobro napisano!");
    }

    if(count($greske)>0)
    {
        $_SESSION['greske']=$greske;
        header("Location: ../index.php?page=registracija");
    }else
    {
        require_once "konekcija.php";
        $sifra=md5($sifra);
        $upit="SELECT * FROM korisnik k INNER JOIN uloga u ON k.ulogaId=u.id WHERE aktivan=1 AND email=:email AND sifra=:lozinka";
        $rez = $kon->prepare($upit);
        $rez->bindParam(":email",$email);
        $rez->bindParam(":lozinka",$sifra);

        try{
            $rez->execute();
            $korisnik= $rez->fetch();
            if($korisnik)
            {
                $_SESSION['korisnik']=$korisnik;
                
                 header("Location: ../index.php?page=index");
            }else{
                $_SESSION['greskle']="Niste dobro uneli ime i prezime";
                header("Location: ../index.php?page=index");
            }

        }catch(PDOException $e)
        {
            $e->getMessage();
        }
    }
}
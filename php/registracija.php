<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'php_mailer/src/Exception.php';
require 'php_mailer/src/PHPMailer.php';
require 'php_mailer/src/SMTP.php';
$status=404;
$message=null;
if(isset($_POST['ime']))
{
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $sifra = $_POST['sifra'];
    $emailA = $_POST['email'];
    $pol=$_POST['pol'];

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
    if(!filter_var($emailA,FILTER_VALIDATE_EMAIL))
    {
        array_push($greske,"Email nije dobar");
    }

    if(count($greske)>0)
    {
        $status=404;

    }else{
        include "konekcija.php";
        $upit="INSERT INTO korisnik(ime,prezime,email,sifra,ulogaId,polId,token)VALUES(:ime,:prezime,:email,:sifra,1,:pol,:token)";
        $sifra=md5($sifra);
        $rez = $kon->prepare($upit);
        $rez->bindParam(":ime",$ime);
        $rez->bindParam(":prezime",$prezime);
        $rez->bindParam(":email",$emailA);
        $rez->bindParam(":sifra",$sifra);
        $rez->bindParam(":pol",$pol);
        $token = md5(time().$emailA);
        $rez->bindParam(":token",$token);

        try{
            $bool= $rez->execute();
            

                if($bool)
                {
                    $mail = new PHPMailer(true);
                    try
                    {
                        $mail->SMTPDebug = 0;
                        $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false,'allow_self_signed' => true));

                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';  // backup
                        $mail->SMTPAuth = true;
                        $mail->Username = 'nemanjaranisavljevicsajt@gmail.com';
                        $mail->Password = 'beka123456';
                        $mail->SMTPSecure = 'tls'; // tls enkripcija (moze i ssl)
                        $mail->Port = 587;
                        $mail->setFrom('nemanjaranisavljevicsajt@gmail.com', 'Game Fun Registracija');
                        $mail->addAddress($emailA);

                        // content
                        $mail->isHTML(true);
                        $mail->Subject = 'Aktivirajte Vas nalog!';

                        $mail->Body = 'Za aktivaciju vaseg naloga, kliknite na sledeci link: ' . "http://localhost/php2sajt1/php/aktivacija.php?token=" . $token;
                        //PROMENJENO NA SERVERU POTANJA

                        $mail->send();

                        $status = 201;
                    }

                    catch (Exception $e)
                    {
                        $status = 500;
                        $data = ['msg'=>'Poruka nije poslata: ' . $mail->ErrorInfo];
                    }

                    // status 201 - kreiran!
                    $status = 201;
                }
                else
                {
                    $status = 500;
                }
        }catch(PDOException $e) {
            $status = 409;
            $message = $e->getMessage();
        }


    }
http_response_code($status);
if($message){
    echo json_encode($message);
}
}
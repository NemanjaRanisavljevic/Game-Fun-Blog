<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'php_mailer/src/Exception.php';
require 'php_mailer/src/PHPMailer.php';
require 'php_mailer/src/SMTP.php';
if(isset($_POST['poruka']))
{
    $naslov = $_POST['tNaslov'];
    $poruka = $_POST['tPoruka'];
    $ime = $_SESSION['korisnik']->ime;
    $prezime = $_SESSION['korisnik']->prezime;
    
    $greske=[];

    $regNaslov="/^[A-ZČĆŽŠĐ][\sA-zčćžšđ]{5,50}$/";
    

    if(!preg_match($regNaslov,$naslov))
    {
        array_push($greske,"Niste dobro uneli naslov!");
    }
    if($poruka=="")
    {
        array_push($greske,"Niste dobro uneli poruku!");
    }

    if(count($greske)>0)
    {
        $status=406;
        

    }else{
            

                
               
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
                        $mail->setFrom('nemanjaranisavljevicsajt@gmail.com', 'Game Fun Kontakt');
                        $mail->addAddress('beka9977@gmail.com');

                        // content
                        $mail->isHTML(true);
                        $mail->Subject = $naslov;

                        $mail->Body ='Od korisnika '.$ime. ' '. $prezime .' 
                        '.$poruka;

                        $mail->send();

                        $status = 201;
                    }

                    catch (Exception $e)
                    {
                        $status = 500;
                        $data = ['msg'=>'Poruka nije poslata: ' . $mail->ErrorInfo];
                    }

                    // status 201 - kreiran!
                   
                }
               

                http_response_code($status);
            }
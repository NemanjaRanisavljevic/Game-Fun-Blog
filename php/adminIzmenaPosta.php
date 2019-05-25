<?php

header("Content-type: aplication/json");
$data = null;
$code = 404;
if (isset($_GET['id']))
{
    require_once 'konekcija.php';
    $id = $_GET['id'];
    $upit = "SELECT * FROM post WHERE idPost = :id";
    $rez5 = $kon->prepare($upit);
    $rez5->bindParam(":id", $id);
    try{
       $rez5->execute();
       if($rez5->rowCount() == 1)
       {    $code = 200;
            $data = $rez5->fetch(); 
       }
    } catch(PDOExcpetion $e) {
        $code  = 500;
        $data = $e->getMessage();
    
    }
}
echo json_encode($data);
http_response_code($code);

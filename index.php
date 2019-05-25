<?php
session_start();
$page="";
if(isset($_GET['page']))
{
    $page = $_GET['page'];
}
include("php/konekcija.php");
include "views/head.php";
include "views/nav.php";



switch($page)
{
    case "index":
        include "views/sajder.php";
        include "views/indexSredina.php";
        break;
    case "singlePost":
        include "views/stranaPosta.php";
        break;
    case "kontakt":
    if(isset($_SESSION['korisnik']))
    {
        include "views/kontakt.php";
        break;
    }else{Header("Location: index.php?page=index");}
    case "registracija":
    if(isset($_SESSION['korisnik'])){
        Header("Location: index.php?page=postaviPost");
        
    }else{
        
        include "views/registracija.php";
        break;}
    case "aktivacijaD":
        include "views/uspesnaAktivacija.php";
        break;
    case "postaviPost":
    if(isset($_SESSION['korisnik'])){
        include "views/post.php";
        break;
    }else{Header("Location: index.php?page=index");}
    case "sviPostoviKategorije":
        include "views/sajder.php";
        include "views/sviPostoviKategorije.php";
        break;
    case "adminPanel":
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin")
    {
        
        include "views/adminPanel.php";
        break;
    }else{
        Header("Location: index.php?page=index");
    }
    case "adminNoviK":
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin")
    {
        
        include "views/adminNoviK.php";
        break;
    }else{
        Header("Location: index.php?page=index");
    }
    case "adminIzmenaPosta":
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin")
    {
        
        include "views/adminIzmenaPosta.php";
        break;
    }else{
        Header("Location: index.php?page=index");
    }
    case "adminKategorije":
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin")
    {
        
        include "views/adminKategorije.php";
        break;
    }else{
        Header("Location: index.php?page=index");
    }
    case "adminDodajKategoriju":
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin")
    {
        
        include "views/adminDodajKategoriju.php";
        break;
    }else{
        Header("Location: index.php?page=index");
    }
    case "adminDodajAnketu":
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin")
    {
        
        include "views/adminDodajAnketu.php";
        break;
    }else{
        Header("Location: index.php?page=index");
    }
    case "adminDodajOdgovorAnketa":
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin")
    {
        
        include "views/adminDodajOdgovorAnketa.php";
        break;
    }else{
        Header("Location: index.php?page=index");
    }
    case "adminAnkete":
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin")
    {
        
        include "views/adminAnkete.php";
        break;
    }else{
        Header("Location: index.php?page=index");
    }
    case "uvidOdgovoraNaAnketu":
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin")
    {
        
        include "views/uvidOdgovoraNaAnketu.php";
        break;
    }else{
        Header("Location: index.php?page=index");
    }
    default:
        include "views/sajder.php";
        include "views/indexSredina.php";
        break;
      
}

include "views/logovanje.php";
include "views/najpopularnijeKategorije.php";
include "views/futer.php";


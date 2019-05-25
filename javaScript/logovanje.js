function proveraLogovanja()
{
    var email = $("#mce-EMAIL").val();
    var sifra = $("#mce-TEXT").val();

    var regSifra =/^[A-Z][\w\d]{5,}$/;
    var regEmail=/^[\w]+[\.\_\-\w\d]*\@gmail\.com$/;
    
        

    var greske = Array();

    if(!regSifra.test(sifra))
    {
        document.getElementById("sifraL").style.display = "flex";
        greske.push("Greska sifra");
    }
    if(!regEmail.test(email))
    {
        document.getElementById("emailL").style.display = "flex";
        greske.push("Greska email");
    }

    if(greske.length !=0)
    {
        return false;
    }else
    {
        
        return true;
        
    }
}
function ProveraPosta()
{
    var igrice = $("#igricelista").val();
    var naslov = $("#naslov").val();
    var slika = $("#slika").val();
    var opis = $("#opis").val();

    var greske = Array();

    var regNaslov =/^[A-ZČĆŽŠĐ][\sA-zčćžšđ]{5,50}$/;
    

    if(!regNaslov.test(naslov))
    {
        document.getElementById("naslovS").style.display = "flex";
        greske.push("Greska naslov");
    }
    if(opis=="")
    {
        document.getElementById("opisS").style.display = "flex";
        greske.push("Greska opis");
        
    }
    if(igrice =="0")
    {
        document.getElementById("igricaS").style.display = "flex";
        greske.push("Greska igrica");
        
    }
  
    if(greske.length !=0)
    {
        return false;
    }else
    {
        
        return true;
        
    }




}
function proveraIzmenePosta()
{
    var igrice = $("#ddlKategorije").val();
    var naslov = $("#naslovI").val();
    var slika = $("#slika").val();
    var opis = $("#opisI").val();

    var greske = Array();

    var regNaslov =/^[A-ZČĆŽŠĐ][\sA-zčćžšđ]{5,50}$/;
    

    if(!regNaslov.test(naslov))
    {
        document.getElementById("naslovS").style.display = "flex";
        greske.push("Greska naslov");
    }
    if(opis=="")
    {
        document.getElementById("opisS").style.display = "flex";
        greske.push("Greska opis");
        
    }
    if(igrice =="0")
    {
        document.getElementById("igricaS").style.display = "flex";
        greske.push("Greska igrica");
        
    }
  
    if(greske.length !=0)
    {
        return false;
    }else
    {
        
        return true;
        
    }




}



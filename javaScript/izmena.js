$(document).ready(function(){
    



    //PREUZIVANJE PODATAKA ZA IZMENU KORISNIKA
    $(".update").click(function(){
        var id = $(this).attr('data-id');
        
        $.ajax({
            url:'php/dohvatiKorisnika.php',
            type:'POST',
            data:{
                id:id
            },
            dataType: "json",
            success:function(data)
            {
                
                $("#ime").val(data.ime);
                $("#prezime").val(data.prezime);
                $("#listaPol").val(data.polId);
                $("#ddlAktivan").val(data.aktivan);
                $("#ddlUloga").val(data.ulogaId);
                $("#email").val(data.email);
                $("#poljeZaid").val(data.idKorisnik);
                

            },
            error:function(xhr)
		{
			var kod = xhr.status;
                switch(kod){
                    case 500:
                        alert("Greska na serveru");
                        break;
                    case 404:
                        alert("Stranica nije pronadjena.");
                        break;
                    case 406:
                        alert("Vec ste odgovorili na anketu.Hvala");
                        break;
                        
                }
		}
        });

    });

    //SLANJE PODATAKA ZA IZMENU
    $("#updateK").click(function(){
        var id = $("#poljeZaid").val();
        var ime = $("#ime").val();
        var prezime = $("#prezime").val();
        var pol = $("#listaPol").val();
        var aktivan = $("#ddlAktivan").val();
        var uloga = $("#ddlUloga").val();
        var email = $("#email").val();
        var sifra = $("#sifra").val();

    var regIme =/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10}$/;
    var regPrezime =/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}$/;
    var regSifra =/^[A-Z][\w\d]{5,}$/;
    var regEmail=/^[\w]+[\.\_\-\w\d]*\@gmail\.com$/;

    var greske = Array();

    if(!regIme.test(ime))
    {
        document.getElementById("imeS").style.display = "flex";
        greske.push("Greska ime");
    }
    if(!regPrezime.test(prezime))
    {
        document.getElementById("prezimeS").style.display = "flex";
        greske.push("Greska Prezime");
    }
  
    if(!regEmail.test(email))
    {
        document.getElementById("emailS").style.display = "flex";
        greske.push("Greska email");
    }

    if(pol==0)
    {
        document.getElementById("polS").style.display="flex";
        greske.push("Greska pol");

    } 
    if(uloga==0)
    {
        document.getElementById("ulogaS").style.display="flex";
        greske.push("Greska pol");

    } 
    if(sifra=="")
    {
        
    }else{
        if(!regSifra.test(sifra))
    {
        document.getElementById("sifraS").style.display = "flex";
        greske.push("Greska email");
    }
    }

    if(greske == 0)
    {
        $.ajax({
            url:'php/adminskaIzmenaKorisnika.php',
            type:'POST',
            data:{
                id:id,
                ime:ime,
                prezime:prezime,
                pol:pol,
                aktivan:aktivan,
                uloga:uloga,
                email:email,
                sifra:sifra
            },
            dataType: "json",
            success:function(data)
            {
                alert("Uspesno ste izmenili korisnika");
            },
            error:function(xhr)
		{
			var kod = xhr.status;
                switch(kod){
                    case 500:
                        alert("Greska na serveru");
                        break;
                    case 404:
                        alert("Stranica nije pronadjena.");
                        break;
                    case 406:
                        alert("Vec ste odgovorili na anketu.Hvala");
                        break;
                        
                }
		}
        });
    }
});

//NOVI KORISNIK ADMIN 
$("#noviK").click(function(){
    
    var ime = $("#ime").val();
    var prezime = $("#prezime").val();
    var pol = $("#listaPol").val();
    var aktivan = $("#ddlAktivan").val();
    var uloga = $("#ddlUloga").val();
    var email = $("#email").val();
    var sifra = $("#sifra").val();

var regIme =/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10}$/;
var regPrezime =/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}$/;
var regSifra =/^[A-Z][\w\d]{5,}$/;
var regEmail=/^[\w]+[\.\_\-\w\d]*\@gmail\.com$/;

var greske = Array();

if(!regIme.test(ime))
{
    document.getElementById("imeS").style.display = "flex";
    greske.push("Greska ime");
}
if(!regPrezime.test(prezime))
{
    document.getElementById("prezimeS").style.display = "flex";
    greske.push("Greska Prezime");
}

if(!regEmail.test(email))
{
    document.getElementById("emailS").style.display = "flex";
    greske.push("Greska email");
}

if(pol==0)
{
    document.getElementById("polS").style.display="flex";
    greske.push("Greska pol");

} 
if(uloga==0)
{
    document.getElementById("ulogaS").style.display="flex";
    greske.push("Greska pol");

} 
if(!regSifra.test(sifra))
{
    document.getElementById("sifraS").style.display = "flex";
    greske.push("Greska email");
}


if(greske == 0)
{
    $.ajax({
        url:'php/adminNoviKorisnik.php',
        type:'POST',
        data:{
            
            ime:ime,
            prezime:prezime,
            pol:pol,
            aktivan:aktivan,
            uloga:uloga,
            email:email,
            sifra:sifra
        },
        dataType: "json",
        success:function(data)
        {
            $("#ime").val("");
            $("#prezime").val("");
            $("#listaPol").val("0");
            
            $("#ddlUloga").val("0");
            $("#email").val("");
            $("#sifra").val("");
            alert("Uspesno ste dodali korisnika");
        },
        error:function(xhr)
    {
        var kod = xhr.status;
            switch(kod){
                case 500:
                    alert("Greska na serveru");
                    break;
                case 404:
                    alert("Stranica nije pronadjena.");
                    break;
                case 406:
                    alert("Vec ste odgovorili na anketu.Hvala");
                    break;
                    
            }
    }
    });
}

});




//IZMENA KATEGORIJE
$(".updateKate").click(function(){
    var id = $(this).attr('data-id');
    $.ajax({
        url:'php/dohvatiKategoriju.php',
        type:'POST',
        data:{
            id:id
        },
        dataType: "json",
        success:function(data)
        {
            $("#skriveniIdKategorije").val(data.id);
            $("#nazivK").val(data.naziv);
        
        },
        error:function(xhr)
    {
        var kod = xhr.status;
            switch(kod){
                case 500:
                    alert("Greska na serveru");
                    break;
                case 404:
                    alert("Stranica nije pronadjena.");
                    break;
               
            }
    }
    });
    
});

//IZMENA KATEGORIJE I PROVERA SLANJA
$("#updateKat").click(function(){

    var id = $("#skriveniIdKategorije").val();
    var naziv = $("#nazivK").val();

    var greske = Array();

    if(naziv == " ")
    {
        document.getElementById("nazivS").style.display = "flex";
        greske.push("Greska naziv");
    }
    if(naziv == "")
    {
        document.getElementById("nazivS").style.display = "flex";
        greske.push("Greska naziv");
    }


    if(greske == 0)
    {
        $.ajax({
            type: "POST",
            url: "php/adminIzmenaKategorije.php",
            data:{
                id:id,
                naziv:naziv
            },
            dataType: "json",
            success: function (data) {
                $("#nazivK").val("");
                alert("Uspesno ste izmenili kategoriju.");
            },
            error:function(xhr)
            {
                var kod = xhr.status;
                    switch(kod){
                        case 500:
                            alert("Greska na serveru");
                            break;
                        case 404:
                            alert("Stranica nije pronadjena.");
                            break;
                        case 406:
                            alert("Podaci nisu potpuni.");
                            break;
                       
                    }
            }
        });
    }
});

//DODAVANJE NOVE KATEGORIJE
$("#unelisK").click(function(){

   
    var naziv = $("#novaKategorija").val();
    
    var greske = Array();

    if(naziv == " ")
    {
        document.getElementById("nazivKI").style.display = "flex";
        greske.push("Greska naziv");
    }
    if(naziv == "")
    {
        document.getElementById("nazivKI").style.display = "flex";
        greske.push("Greska naziv");
    }


    if(greske == 0)
    {
        $.ajax({
            type: "POST",
            url: "php/adminNovaKategorija.php",
            data:{
                
                naziv:naziv
            },
            dataType: "json",
            success: function (data) {
                $("#novaKategorija").val("");
                alert("Uspesno ste uneli novu kategoriju.");
            },
            error:function(xhr)
            {
                var kod = xhr.status;
                    switch(kod){
                        case 500:
                            alert("Greska na serveru");
                            break;
                        case 404:
                            alert("Stranica nije pronadjena.");
                            break;
                        case 406:
                            alert("Podaci nisu potpuni.");
                            break;
                       
                    }
            }
        });
    }
});

//DODAVANJE NOVE ANKETE
$("#unesiAnketu").click(function(){

   
    var naziv = $("#novaAnketa").val();
    console.log(naziv);
    
    var greske = Array();

    if(naziv == " ")
    {
        document.getElementById("nazivAnkete").style.display = "flex";
        greske.push("Greska naziv");
    }
    if(naziv == "")
    {
        document.getElementById("nazivAnkete").style.display = "flex";
        greske.push("Greska naziv");
    }


    if(greske == 0)
    {
        $.ajax({
            type: "POST",
            url: "php/dodajAnketu.php",
            data:{
                
                naziv:naziv
            },
            dataType: "json",
            success: function (data) {
                $("#novaAnketa").val("");
                alert("Uspesno ste uneli novu anketu.");
            },
            error:function(xhr)
            {
                var kod = xhr.status;
                    switch(kod){
                        case 500:
                            alert("Greska na serveru");
                            break;
                        case 404:
                            alert("Stranica nije pronadjena.");
                            break;
                        case 406:
                            alert("Podaci nisu potpuni.");
                            break;
                       
                    }
            }
        });
    }
});

//Dodavanje odgovora za ankete
$("#unesiOdgovor").click(function(){

   
    var odg = $("#noviOdgovor").val();
    var idAnkete = $("#sveAnkete").val();
    
    
    var greske = Array();

    if(odg == " ")
    {
        document.getElementById("odgovorAkete").style.display = "flex";
        greske.push("Greska naziv");
    }
    if(odg == "")
    {
        document.getElementById("odgovorAkete").style.display = "flex";
        greske.push("Greska naziv");
    }
    if(idAnkete == "0")
    {
        document.getElementById("sveAnketice").style.display = "flex";
        greske.push("Greska naziv");
    }


    if(greske == 0)
    {
        $.ajax({
            type: "POST",
            url: "php/dodajOdgovorZaAnketu.php",
            data:{
                idAnkete:idAnkete,
                odg:odg
            },
            dataType: "json",
            success: function (data) {
                $("#noviOdgovor").val("");
                $("#sveAnkete").val("0");
                alert("Uspesno ste dodali odgovor za naredni odgovor ponovite postupak.");
            },
            error:function(xhr)
            {
                var kod = xhr.status;
                    switch(kod){
                        case 500:
                            alert("Greska na serveru");
                            break;
                        case 404:
                            alert("Stranica nije pronadjena.");
                            break;
                        case 406:
                            alert("Podaci nisu potpuni.");
                            break;
                       
                    }
            }
        });
    }
});

//DOHVATEANJE PODATAKA ZA ANKETU PITANJA izmena
$(".updateAnkete").click(function(){
    var id = $(this).attr('data-id');
    $.ajax({
        url:'php/dohvatiAnketu.php',
        type:'POST',
        data:{
            id:id
        },
        dataType: "json",
        success:function(data)
        {
            
            $("#skrivenaAnketaId").val(data.id_a);
            $("#pitanjeAn").val(data.pitanje);
            $("#ddlAktivan").val(data.aktivna);
        
        },
        error:function(xhr)
    {
        var kod = xhr.status;
            switch(kod){
                case 500:
                    alert("Greska na serveru");
                    break;
                case 404:
                    alert("Stranica nije pronadjena.");
                    break;
               
            }
    }
    });
    
});

//IZMENA ANKETE UPDATE
$("#upAnketa").click(function(){

   
    var pitanje = $("#pitanjeAn").val();
    var idAnkete = $("#skrivenaAnketaId").val();
    var aktivna = $("#ddlAktivan").val();
    
    var greske = Array();

    if(pitanje == " ")
    {
        document.getElementById("anketaS").style.display = "flex";
        greske.push("Greska naziv");
    }
    if(pitanje == "")
    {
        document.getElementById("anketaS").style.display = "flex";
        greske.push("Greska naziv");
    }
    

    if(greske == 0)
    {
        $.ajax({
            type: "POST",
            url: "php/adminIzmenaAnkete.php",
            data:{
                pitanje:pitanje,
                idAnkete:idAnkete,
                aktivna:aktivna
            },
            dataType: "json",
            success: function (data) {
                $("#pitanjeAn").val("");
                $("#skrivenaAnketaId").val("");
                alert("Uspesno ste izmenili anketu.");
            },
            error:function(xhr)
            {
                var kod = xhr.status;
                    switch(kod){
                        case 500:
                            alert("Greska na serveru");
                            break;
                        case 404:
                            alert("Stranica nije pronadjena.");
                            break;
                        case 406:
                            alert("Podaci nisu potpuni.");
                            break;
                       
                    }
            }
        });
    }
});



});
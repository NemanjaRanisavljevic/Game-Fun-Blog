$(document).ready(function(){
    $(".brKom").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url:'php/brisanjeKomentara.php',
            type:'POST',
            data:{
                id:id
            },
            success:function(data)
            {
                alert("Uspesno ste obrisali komentar.");
            },
            error:function(xhr)
		{
			var kod = xhr.status;
                switch(kod){
                    case 500:
                        alert("Greska na serveru");
                        break;
                    case 404:
                        alert("Stranica nije pronadjena.")
                        break;
                    case 406:
                        alert("Vec ste odgovorili na anketu.Hvala");
                        break;
                        
                }
		}
        });
    });

    //brisanje posta i komentara za taj post
    $(".brPosta").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url:'php/brisanjePosta.php',
            type:'POST',
            data:{
                id:id
            },
            success:function(data)
            {
                alert("Uspesno ste obrisali post i komentare.");
            },
            error:function(xhr)
		{
			var kod = xhr.status;
                switch(kod){
                    case 500:
                        alert("Greska na serveru");
                        break;
                    case 404:
                        alert("Stranica nije pronadjena.")
                        break;
                    case 406:
                        alert("Vec ste odgovorili na anketu.Hvala");
                        break;
                        
                }
		}
        });



    });

    //BRISANJE KORISNIKA 
    $(".brisanje").click(function(){
        var id = $(this).attr('data-id');
        
        $.ajax({
            url:'php/brisanjeKorisnika.php',
            type:'POST',
            data:{
                id:id
            },
            success:function(data)
            {
                alert("Uspesno ste obrisali korisnika.");
            },
            error:function(xhr)
		{
			var kod = xhr.status;
                switch(kod){
                    case 500:
                        alert("Greska na serveru");
                        break;
                    case 404:
                        alert("Stranica nije pronadjena.")
                        break;
                    case 406:
                        alert("Vec ste odgovorili na anketu.Hvala");
                        break;
                        
                }
		}
        });
    });

    // BRISANJE KATEGORIJE I SVI POSTOVA I KOMENTARA
    $(".brisanjeKat").click(function(){
        var id = $(this).attr('data-id');
        
        $.ajax({
            url:'php/brisanjeKategorije.php',
            type:'POST',
            data:{
                id:id
            },
            success:function(data)
            {
                alert("Uspesno ste obrisali kategoriju i sve objave sa kometare.");
            },
            error:function(xhr)
		{
			var kod = xhr.status;
                switch(kod){
                    case 500:
                        alert("Greska na serveru");
                        break;
                    case 404:
                        alert("Stranica nije pronadjena.")
                        break;
                    case 406:
                        alert("Vec ste odgovorili na anketu.Hvala");
                        break;
                        
                }
		}
        });
    });

    //BRISANJE ODGOVORA IZ ANKETE I U ODGOVORA KORISNIKA
    $(".brisanjeAnkete").click(function(){
        var id = $(this).attr('data-id');
        
        $.ajax({
            url:'php/brisanjeAnketeSve.php',
            type:'POST',
            data:{
                id:id
            },
            success:function(data)
            {
                alert("Uspesno ste obrisali anketu sa svim odgovorima.");
            },
            error:function(xhr)
		{
			var kod = xhr.status;
                switch(kod){
                    case 500:
                        alert("Greska na serveru");
                        break;
                    case 404:
                        alert("Stranica nije pronadjena.")
                        break;
                       
                }
		}
        });
    });

    //Brisanje ANKETE SA SVIM ODGOVORIMA I ODGOVORIMA KORISNIKA
    $(".brisanjeOdgovora").click(function(){
        var id = $(this).attr('data-id');
        
        $.ajax({
            url:'php/brisanjeOdgovoraIzAnkete.php',
            type:'POST',
            data:{
                id:id
            },
            success:function(data)
            {
                alert("Uspesno ste obrisali odgovor iz ankete.");
            },
            error:function(xhr)
		{
			var kod = xhr.status;
                switch(kod){
                    case 500:
                        alert("Greska na serveru");
                        break;
                    case 404:
                        alert("Stranica nije pronadjena.")
                        break;
                       
                }
		}
        });
    });

     //Brisanje brisanje odgovora KORISNIKA
     $(".brisanjeAko").click(function(){
        var id = $(this).attr('data-id');
        
        $.ajax({
            url:'php/brisanjeOdgovoraKorisnikaNaAnketu.php',
            type:'POST',
            data:{
                id:id
            },
            success:function(data)
            {
                alert("Uspesno ste obrisali odgovor korisnika.");
            },
            error:function(xhr)
		{
			var kod = xhr.status;
                switch(kod){
                    case 500:
                        alert("Greska na serveru");
                        break;
                    case 404:
                        alert("Stranica nije pronadjena.")
                        break;
                       
                }
		}
        });
    });
    



});
$(document).ready(function(){
    /* This is basic - uses default settings */
	
	$("a#single_image").fancybox();
	
	/* Using custom settings */
	
	$("a#inline").fancybox({
		'hideOnContentClick': true
	});

	/* Apply fancybox to multiple items */
	
	$("a.group").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false
	});
$("#registrovan").click(function(){
    var ime = $("#ime").val();
    var prezime = $("#prezime").val();
    var sifra = $("#sifra").val();
    var email = $("#email").val();
    var pol = $("#listaPol").val();
    
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
    if(!regSifra.test(sifra))
    {
        document.getElementById("sifraS").style.display = "flex";
        greske.push("Greska sifra");
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

    if(greske == 0)
    {
        $.ajax({
            url:'php/registracija.php',
			type:'POST',
            data:{
                ime:ime,
                prezime:prezime,
                sifra:sifra,
                email:email,
                pol:pol
            },
            success:function(data){

                $("#ime").val("");
                $("#prezime").val("");
                $("#sifra").val("");
                $("#email").val("");
                $("#listaPol").val("0");
                alert("Uspesno ste se registrovali. Posetite vas email radi aktivacije naloga.");

            },
            error:function(xhr,statusTxt,error)
            {
                var status=xhr.status;

                switch(status)
                {
                    case 500:
		  	            alert("Greska na serveru.Trenutno nije moguce obrisati korisnika");
                        break;
                    case 404:
                        alert("Pogresili ste unos nekog elementa forme");
                        document.getElementById("imeS").style.display = "flex";
                        document.getElementById("prezimeS").style.display = "flex";
                        document.getElementById("emailS").style.display = "flex";
                        document.getElementById("polS").style.display = "flex";
                        document.getElementById("sifraS").style.display = "flex";

                        break;
        }
      }
        });
    }
   
});
//PROVERA KOMENTARA I SLANJE PREKO AJAXA
$("#postavi").click(function(){
    var idPosta = $("#postId").val();
    var idKorisnika = $("#komKorisnika").val();
    var komentar = $("#komentarV").val();
    var idKat= $("#katId").val();

    var regKomentar = /^[\w\s\d\.\,\:\!\?\@\*]{10,}$/;
    var greske = Array();

    if(!regKomentar.test(komentar))
    {
        document.getElementById("komS").style.display = "flex";
        greske.push("Greska komentar");
    }

    if(greske==0)
    {
        
        $.ajax({
            url:'php/komentar.php',
			type:'POST',
            data:{
                idPosta:idPosta,
                idKorisnika:idKorisnika,
                komentar:komentar, 
                idKat:idKat
            },
            dataType: "json",
            success:function(data)
            {
                
                var sadrzaj='';
                
                    if(data.uloga == 2)
                    {
                    sadrzaj ='<div class="clearfix single_content">'
                    +'<div class="clearfix post_date floatleft">'
                        +'<div class="date">'
                        + '<h3>'+data.v1+'</h3>'
                        + '<p>'+data.v2+'</p>'
                        +'</div>'
                    +'</div>'
                    +'<div id="post_detail" class="clearfix post_detail">'
                        +'<div class="clearfix post-meta">'
                            +'<p><span><i class="fa fa-user"></i>'+' '+data.ime + data.prezime+'</span>'
                            +' '+'<span><i class="fa fa-clock-o"></i>'+' '+data.vreme+'</span>'
                            +'<a class="floatright brKom" href="#more_works" data-id="'+data.id+'">Obrisi</a>'
                            +'</p>'
                            
                        +'</div>'
                        +'<div class="clearfix post_excerpt">'
                            +'<p>'+data.sadrzaj+'</p>'
                        +'</div>'
                    +'</div>'
                +'</div>';
                    }else
                    {
                        sadrzaj ='<div class="clearfix single_content">'
                        +'<div class="clearfix post_date floatleft">'
                            +'<div class="date">'
                            + '<h3>'+data.v1+'</h3>'
                            + '<p>'+data.v2+'</p>'
                            +'</div>'
                        +'</div>'
                        +'<div id="post_detail" class="clearfix post_detail">'
                            +'<div class="clearfix post-meta">'
                                +'<p><span><i class="fa fa-user"></i>'+' '+data.ime +' '+ data.prezime+'</span>'
                                +' '+'<span><i class="fa fa-clock-o"></i>'+' '+data.vreme+'</span>'
                                +'</p>'
                            +'</div>'
                            +'<div class="clearfix post_excerpt">'
                                +'<p>'+data.sadrzaj+'</p>'
                            +'</div>'
                        +'</div>'
                    +'</div>';
                    }
                
                $("#komentarV").val("");
                $("#radi").append(sadrzaj);
                
                
            },
            error:function(xhr,statusTxt,error)
            {
                var kod = xhr.status;
                switch(kod){
                    case 500:
                        alert("Greska na serveru ne moguce je komentarisati.");
                        break;
                    case 404:
                        alert("Stranica nije pronadjena.")
                        break;
                    case 400:
                        alert("Niste dobro ubeli komentar");
                        break;
                        
                }
            }
        });
    }

});
//ANKETA
$('.btnAnketa').click(function(){
	var idAnketa = $(this).attr('data-id');
	var izb=$('#selectA'+idAnketa).val();
    

	$.ajax({
		type: "POST",
		url: "php/anketa.php",
		data:{
			anketa:true,
			idAnketa:idAnketa,
			idOdgovor:izb
		},
		dataType: "json",
		success: function (data) {
			
            alert("Uspesno ste odgovorili na anketu. Hvala!");
            
            
		},
		error:function(xhr)
		{
			var kod = xhr.status;
                switch(kod){
                    case 500:
                        alert("Izaberite vas odgovor.");
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
$("#btnKontakt").click(function(){
    
    var tNaslov = $("#tNaslov").val();
    var tPoruka = $("#tPoruka").val();
    

    
    var regNaslov =/^[A-ZČĆŽŠĐ][\sA-zčćžšđ]{5,50}$/;
    var greske = Array();

    if(tPoruka=="")
    {
        document.getElementById("poruka").style.display = "flex";
        greske.push("Greska poruka");
    }
    if(!regNaslov.test(tNaslov))
    {
        document.getElementById("naslovK").style.display = "flex";
        greske.push("Greska naslov");
    }
    if(greske==0)
    {
        $.ajax({
            type: "POST",
            url: "php/kontakt.php",
            data:{
                poruka:true,
                tNaslov:tNaslov,
                tPoruka:tPoruka
            },
            dataType: "json",
            success: function (data) {
                document.getElementById("povratnaPoruka").innerHTML +="Uspesno ste poslali poruku";
                
                $("#tNaslov").val("");
                $("#tPoruka").val("");
               
                
                
            },
            error:function(xhr)
            {
                var kod = xhr.status;
                    switch(kod){
                        case 500:
                            alert("Greska na serveru.");
                            break;
                        case 404:
                            alert("Stranica nije pronadjena.")
                            break;
                        case 406:
                        $("#povratnaPoruka").html("Niste dobro uneli sve parametre.Hvala");
                            break;
                            
                    }
            }
        });
    }
});
    
});
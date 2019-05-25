$(document).ready(function(){

    var idp = document.URL.split('=')[2];
$.ajax({
    url:'php/adminIzmenaPosta.php',
    type:'GET',
    data: { id: idp },
    dataType: "json",
    success:function(data)
    {

        $("#ddlKategorije").val(data.idKategorija);
        $("#naslovI").val(data.naslov);
        $("#opisI").val(data.opis);
        $("#skivenoID").val(data.idPost);
        
       
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
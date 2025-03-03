czas();
function czas(){

    var data=new Date();

    var godzina=data.getHours();
    if(godzina<10){
        godzina='0'+godzina;
    }
    var minuta=data.getMinutes();
    if(minuta<10){
        minuta='0'+minuta;
    }
    var sekunda=data.getSeconds();
    if(sekunda<10){
        sekunda='0'+sekunda;
    }

    var rok = data.getFullYear();
    var miesiac=data.getMonth();
    if(miesiac<10){
        miesiac='0'+miesiac;
    }
    var dzien=data.getDate();
    if(dzien<10){
        dzien='0'+dzien;
    }

    var teraz_godzina= godzina+":"+minuta+":"+sekunda;
    var teraz_data=dzien+"."+miesiac+"."+rok;
    document.getElementById("data").innerHTML="Aktualny czas: <br>"+teraz_godzina+"<br>"+teraz_data;
}
setInterval(czas,1000);
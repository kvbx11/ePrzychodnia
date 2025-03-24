czas();
function czas(){

    var data=new Date(); // pobranie daty

    var godzina=data.getHours(); // pobranie godziny
    if(godzina<10){
        godzina='0'+godzina;
    }
    var minuta=data.getMinutes(); // dodanie zer jesli jest to wymagane
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

    var teraz_godzina= godzina+":"+minuta+":"+sekunda; // pobranie danych
    var teraz_data=dzien+"."+miesiac+"."+rok;
    document.getElementById("data").innerHTML="Aktualny czas: <br>"+teraz_godzina+"<br>"+teraz_data; // wyswietlenie danych na stronie
}
setInterval(czas,1000); // interwał, aby czas sie odswiezał
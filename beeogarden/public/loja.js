window.onload= function(){
    loja();
}

function loja(){
    var lenght_loja = document.getElementsByClassName("produto").length;
    console.log(lenght_loja);
    var num_loja= Math.floor(Math.random() * lenght_loja) + 1);
}
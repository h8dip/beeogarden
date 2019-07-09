
window.onload=function(){
    
    $(function() {
        var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
        var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
        $("html").css({"width":w,"height":h});
        $("body").css({"width":w,"height":h});
    });

   // document.getElementById("loading-div-container").style.display ="none";

    $('#hamburger').click(function(){
        $('#hamburger').toggleClass("is-active");
        $('#mobile-navbar').toggleClass("grid-class");
        $('#ham-phone').toggleClass("z-index-6");
        $('body').toggleClass("overflow-hid");
        $('.container-main').toggleClass("overflow-hid");
    });
    

    $('#filter-store a').click(function(){
        $('#filter-store a.filter-active').removeClass('filter-active');
        $(this).addClass('filter-active');
    });

    $('#filter-info a').click(function(){
        $('#filter-info a.active-info-div').removeClass('active-info-div');
        $(this).addClass('active-info-div');
    });



    // CARROUSEL

    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function showSlides() {
        var prev = document.getElementById("prev");
        var next = document.getElementById("next");
        var p = 1;
        var h = p;
        var slides_lenght = document.querySelectorAll('#showcase-image .mySlides').length;
        var img ="img";

        document.getElementById(img+p).style.display="block"; 

        prev.onclick = function(){
            h = p;
            if(p>1){
                p--;
                document.getElementById(img+p).style.display="block";
                document.getElementById(img+h).style.display="none";
            }else{
                p=1;
                document.getElementById(img+p).style.display="block";
            }
        }

        next.onclick = function(){
            h = p;
            if(p<slides_lenght){

                p++;
                document.getElementById(img+p).style.display="block";
                document.getElementById(img+h).style.display="none";   
            }else{
                document.getElementById(img+p).style.display="block";
            }
        }
    };
    

    // TUTORIAL
    
   

}
// FIM WINDOW.ONLOAD




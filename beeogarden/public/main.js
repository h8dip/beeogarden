window.onload=function(){

    $('#hamburger').click(function(){
        $('#hamburger').toggleClass("is-active");
    });


    $('#filter-store a').click(function(){
        $('#filter-store a.filter-active').removeClass('filter-active');
        $(this).addClass('filter-active');
        // $(this).animate({bacgroundColor:"#FBC02D",color:"#fff" })
    });

    // $("#btn1").click(function(){
    //     $("#box").animate({height: "300px"});
    //   });

}

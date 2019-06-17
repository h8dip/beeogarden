window.onload=function(){

    $('#hamburger').click(function(){
        $('#hamburger').toggleClass("is-active");
    });


    $('#filter-store a').click(function(){
        $('#filter-store a.filter-active').removeClass('filter-active');
        $(this).addClass('filter-active');
    });


}
// FIM WINDOW.ONLOAD


    // $('#nav-lg a').click(function(){
    //     $('#nav-lg a.nav-active').removeClass('nav-active');
    //     $(this).addClass('nav-active');
    // });

    // $("#btn1").click(function(){
    //     $("#box").animate({height: "300px"});
    //   });


//     var slideIndex = 1;
// showSlides(slideIndex);

// // Next/previous controls
// function plusSlides(n) {
//   showSlides(slideIndex += n);
// }

// // Thumbnail image controls
// function currentSlide(n) {
//   showSlides(slideIndex = n);
// }

// function showSlides(n) {
//   var i;
//   var slides = document.getElementsByClassName("mySlides");
//   var dots = document.getElementsByClassName("dot");
//   if (n > slides.length) {slideIndex = 1} 
//   if (n < 1) {slideIndex = slides.length}
//   for (i = 0; i < slides.length; i++) {
//       slides[i].style.display = "none"; 
//   }
//   for (i = 0; i < dots.length; i++) {
//       dots[i].className = dots[i].className.replace(" active", "");
//   }
//   slides[slideIndex-1].style.display = "block"; 
//   dots[slideIndex-1].className += " active";
// }



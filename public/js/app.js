const $slider = document.querySelectorAll('[data-slider="chiefslider"]');
for (let i = 0; i < $slider.length; i++) {
  const slider = new ChiefSlider($slider[i], {
    loop: true,
    autoplay: true,
    interval: 5000,

  });
}

$('.product-modal-open').click(function (){
    let url = $(this).data('url');
    if (url){
        $.ajax({
            url:  url,
            type:'GET',
            success:function (response){
                if (response){
                    $('#modalAjaxView').html(response);
                    $("#owl-brat").owlCarousel({
                        items: 1,
                        loop: true,
                        rewind: true,
                        margin: 15,
                        autoplay: true,
                        nav: true,
                        autoplayTimeout: 2000,
                        autoplayHoverPause: true,

                    });
                }
            }
        });
    }
});


function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent1");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks1");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

/* BASKET START */
/* Установить ширину боковой панели с шириной 250 пикселей и следующий и левой части страницы содержимого шириной 250 пикселей и следующий */
function openBas() {
  document.getElementById("mySidenav").style.width = "320px";
  document.getElementById("main").style.marginLeft = "320px";
}

/* Установите ширину боковой навигации на 0, а левое поле содержимого страницы - на 0 */
function closeBas() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
}

/* BASKET END */

function openNav() {
  document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}

/* INDEX ADVISE START */

/*
const product = {
  burger: {
      amount: 0
  },
  lavash: {
      amount: 0
  }
}

const btnPlusOrMinus = document.querySelectorAll('.main__product-btn'),
  delivery = document.querySelectorAll('.cart')

for (let i = 0; i < btnPlusOrMinus.length; i++) {
 btnPlusOrMinus[i].addEventListener('click', function() {
      addOrSubtrict(this)
 })
}

function addOrSubtrict(element) {
  const parent = element.closest('.main__product')
  const parentId = parent.getAttribute('id')
  const elementSymbol = element.getAttribute('data-symbol')
  const output = parent.querySelector('.main__product-num')

  if (elementSymbol == '+') {
      product[parentId].qty++
  } else if (elementSymbol == '-' && product[parentId].qty > 0){
      product[parentId].qty--
  }
  output.innerHTML = product[parentId].amount
}

/* INDEX ADVISE END */
/*
      $(document).ready(function(){
      $(".owl-carousel").owlCarousel();
      });

      $('.owl-carousel').owlCarousel({
        items:5,
        loop:true,
        margin:15,
        autoplay:true,
        autoplayTimeout: 2000,
        autoplayHoverPause:true,
        nav:true,
        navText : ["<i class='fad fa-chevron-left'></i>","<i class='fad fa-chevron-right'></i>"],
        responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
}) */

$('#cookie_close').click(function (){
    $.ajax({
       url:'/politic/session',
       type: 'GET',
       success:function (response){
           if(response['status'] == 'okay'){
               $('.cookie_notice').css('display', 'none');
           }
       }
    });
});

/*

var slide = document.getElementById("slide");
var upArrow = document.getElementById("upArrow");
var downArrow = document.getElementById("downArrow");

let x=0;

downArrow.onclick = function(){
    if(x > "-600"){
        x = x - 300;
        slide.style.top = x + "px";
    }
}

upArrow.onclick = function(){
    if(x < 0){
        x = x + 300;
        slide.style.top = x + "px";
    }
}
*/
$(".add-to-cart").click(function() {
    $(this).closest("i").next().show()
        .find('.fad').each(function() {
        this.style.display = 'none';
        this.disabled = 'disabled';
    });
});

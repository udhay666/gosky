// main search tab

function openhomeForm(evt, cityName) {
  var i, tabcontent, tablinks;

  tabcontent = document.getElementsByClassName("main-content");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  tablinks = document.getElementsByClassName("mainlinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";

}
// about us tab

function openAbout(evt, cityName) {
    var i, tabcontent, tablinks;
  
    tabcontent = document.getElementsByClassName("about_link_content");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    tablinks = document.getElementsByClassName("about_link");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";

  }

  
  /*=====================
     6. Quantity js
     ==========================*/
const searchBoxOpen= document.getElementById('searchBoxOpen');
const searchboxDesc= document.getElementById('searchboxDesc');

searchBoxOpen.addEventListener('click',()=>{
  searchboxDesc.classList.toggle("show");
});
const searchBoxOpen2= document.getElementById('searchBoxOpen2');
const searchboxDesc2= document.getElementById('searchboxDesc2');

searchBoxOpen2.addEventListener('click',()=>{
  searchboxDesc2.classList.toggle("show");
});
const searchBoxOpen3= document.getElementById('searchBoxOpen3');
const searchboxDesc3= document.getElementById('searchboxDesc3');

searchBoxOpen3.addEventListener('click',()=>{
  searchboxDesc3.classList.toggle("show");
});

const searchBoxHTOpen= document.getElementById('searchBoxOpenHT');
const searchboxHTDesc= document.getElementById('searchboxHTDesc');

searchBoxHTOpen.addEventListener('click',()=>{
  searchboxHTDesc.classList.toggle("show");
});

    $('.qty-box .quantity-right-plus ').on('click', function (e) {
      e.preventDefault();
        var $qty = $(this).parents(".qty-box").find(".input-number");
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal)) {
            $qty.val(currentVal + 1);
        }
    });
    $('.qty-box .quantity-left-minus ').on('click', function () {
        var $qty = $(this).parents(".qty-box").find(".input-number");
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal) && currentVal > 1) {
            $qty.val(currentVal - 1);
        }
    });

  
// multicity
var dclone = null;
dclone = $(".template").clone();
$("#add_room").click(function (e) {
    e.preventDefault();
  var _elm = dclone.clone();
  _elm.css("display", "block")
  _elm.find(".remove_btn").show();
  _elm.appendTo("#clonehere");

  $(document).on("click", ".remove_btn", function (e) {
    
    var $e = $(e.currentTarget);

    $e.closest(".template").remove();
  });
});
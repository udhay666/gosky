// modify
const modify_show=document.getElementById('modify_show');

const modify_show_desc=document.getElementById('modify_show_desc');

modify_show.addEventListener('click',()=>{
    modify_show_desc.classList.toggle('show');
})

// flight details
function openFlightDetails(evt, flightDetailsId) {
  const Flight_details = document.getElementById('Flight_details' + flightDetailsId);

  const Flight_details_Desc = document.getElementById('Flight_details_Desc' + flightDetailsId);

      Flight_details_Desc.classList.toggle('show');
  
}




function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
  
    tabcontent = document.getElementsByClassName("tabcontent1");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }

//   responsive filter btn
const filterBtn=document.getElementById('filterBtn');
const filterBtn_show=document.getElementById('filterBtn_show');

filterBtn.addEventListener('click',()=>{
    filterBtn_show.classList.toggle('show');
})

// roundtrip fixed flight details 
function openFareDetails(evt, cityName) {
  var i, tabcontent, tablinks;

  tabcontent = document.getElementsByClassName("tabcontent2");
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
 

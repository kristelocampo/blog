function appelAjax()
{
    $.get("./ajax.php", showComments);
}

function showComments(comment){
   $("#comment").empty();
    $("#comment").html(comment);
}


function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    let dropdowns = document.getElementsByClassName("dropdown-content");
    let i;
    for (i = 0; i < dropdowns.length; i++) {
      let openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function callAjax(){
  let name = $("#search_text").val();
    if(name.length > 0){
        $.get("./search.php","name="+name, showSearch);
        
    } else {
        $("#search").empty();
    }
  
}

function showSearch(text){
  $("#search").empty();
  $("#search").html(text);
}

$('#search_text').on('input', callAjax);

appelAjax();
setInterval(appelAjax, 10000);
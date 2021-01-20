var menu_btn = document.getElementById("menu-btn"); //menu button (displayed on small screens)
var ul = document.querySelector("ul") //ul element

//toggles the navigation to hide or active (only for small screens)
menu_btn.addEventListener("click", function(e) {
  ul.classList.toggle("active")
});
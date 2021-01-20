//arrows
var leftArrowS_btn = document.getElementById("left-arrow-1");
var rightArrowS_btn = document.getElementById("right-arrow-1");
//gallery container
var gallery = document.getElementById("gallery");
var Gcount = 0; //counter (indicate which image to show)
//circle indicators container
var circle_cont = document.getElementById("circle-container");

//left arrow "click" event listener
leftArrowS_btn.addEventListener("click", function(e) {
  //changes counter
  Gcount--;
  if (Gcount == -1) {
    Gcount = gallery.children.length-1;
  }
  imageGallery(Gcount);
  changeCircle(Gcount);
});

//right arrow "click" event listener
rightArrowS_btn.addEventListener("click", function(e) {
  //changes counter
  Gcount++;
  if (Gcount == 4) {
    Gcount = 0;
  }
  imageGallery(Gcount);
  changeCircle(Gcount);
});

//displays the correct image in the gallery (using the counter variable)
function imageGallery(count) {
  for (i = 0; i < gallery.children.length; i++) {
    gallery.children[i].classList.add("hide-image");
  };
  gallery.children[count].classList.toggle("hide-image");
}

//function called when the circle indicators are clicked on the page
function currentImage(count) {
  Gcount = count; //changes the count based on the circle clicked
  imageGallery(count);
  changeCircle(count);
}

//changes the class of the circle clicked
function changeCircle(count) {
  for (i = 0; i < circle_cont.children.length; i++) {
    circle_cont.children[i].classList.add("circle-hide");
  };
  circle_cont.children[count].classList.toggle("circle-hide");
}
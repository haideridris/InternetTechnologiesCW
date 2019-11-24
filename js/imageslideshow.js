var i = 0; //Start index
var images = []; //Empty array used for images
var time = 5000; // Time between switch - 5 seconds

images[0] = "./images/kirkgatemarket.jpg";
images[1] = "./images/broadway.jpg";

//function to change image
function changeImage(){
  document.slide.src = images[i];
    if(i < images.length - 1){
      i++
    }
    else {
      i = 0;
    }
  setTimeout("changeImage()", time);
    }
  
   window.onload = changeImage;
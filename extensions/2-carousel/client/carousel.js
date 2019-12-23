document.addEventListener("DOMContentLoaded", function() {
  var carouselize = function(carousel) {

    // get elements
    const buttons = carousel.getElementsByTagName("button");
    const left = buttons[0];
    const right = buttons[1];
    const ul = carousel.getElementsByTagName("ul")[0];
    const lis = ul.getElementsByTagName("li");
    const span = carousel.getElementsByTagName("span")[0];

    // hide empty description stripe
    if(span.innerHTML=="") span.style.display = "none";

    // rotate every 8 seconds if not hovering above
    var hovering = false;
    carousel.addEventListener("mouseover", e=>hovering=true);
    carousel.addEventListener("mouseout", e=>hovering=false);
    setInterval(function() { if(!hovering) rightButton.click(); }, 8000);

    // shift to li at position pos and show or hide description stripe
    var showCard = function(pos) {
      const shift = ul.offsetWidth * (-offset);
      ul.style.transform = `translateX(${shift}px)`;
      const li = lis[pos];
      span.style.display = li.dataset.text.length>0 ? "block" : "none";
      span.innerHTML = li.dataset.text;
    }

    // left and right button clicks
    var offset = 0;
    left.addEventListener("click", function() {
      if(offset==0) offset = lis.length-1;
      else offset -= 1;
      showCard(offset);
    });
    right.addEventListener("click", function() {
      if(offset==lis.length-1) offset = 0;
      else offset += 1;
      showCard(offset);
    });
  }

  const carousels = document.getElementsByClassName("carousel");
  for(var i=0; i<carousels.length; ++i) carouselize(carousels[i]);
});

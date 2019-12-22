  document.addEventListener("DOMContentLoaded", function() {
  var carouselize = function(item) {
    const buttons = item.getElementsByTagName("button");
    const leftButton = buttons[0];
    const rightButton = buttons[1];
    const carousel = item.getElementsByTagName("ul")[0];
    const cards = carousel.querySelectorAll("li");
    const span = item.getElementsByTagName("span")[0];

    var offset = 0;
    const maxX = cards.length - 1;
    if(span.innerHTML=="") span.style.display = "none";
    
    var hovering = false;
    item.addEventListener("mouseover", e=>hovering=true);
    item.addEventListener("mouseout", e=>hovering=false);
    setInterval(function() { if(!hovering) rightButton.click(); }, 8000);

    var showCard = function() {
      const shift = carousel.offsetWidth * (-offset);
      carousel.style.transform = `translateX(${shift}px)`;
      const card = cards[offset];
      span.style.display = card.dataset.text.length>0 ? "block" : "none";
      span.innerHTML = card.dataset.text;
    }

    leftButton.addEventListener("click", function() {
      if(offset==0) offset = maxX;
      else offset -= 1;
      showCard();
    })

    rightButton.addEventListener("click", function() {
      if(offset==maxX) offset = 0;
      else offset += 1;
      showCard();
    })
  }

  const carousels = document.querySelectorAll(".carousel");
  for(var i=0; i<carousels.length; ++i) carouselize(carousels[i]);
});

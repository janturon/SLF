window.addEventListener("DOMContentLoaded", function() {

  // radios
  var radios = document.querySelectorAll("label.radio input[type=radio]");
  for(var i=0; i<radios.length; ++i) {
    radios[i].addEventListener("click", function(e) {
      if(e.target.checked && e.target.value == window.lastrv){
        e.target.checked = false;
        window.lastrv = 0;
      }
      else
        window.lastrv = e.target.value;
    });

    radios[i].addEventListener("keypress", function(e) {
      if(e.keyCode==32) e.target.click();
    });
  }

  // files
  var files = document.querySelectorAll("label.file input[type=file]");
  for(var i=0; i<files.length; ++i) {
    files[i].addEventListener("change", function(e) {
      var val = '';
      for(var i=0; i<this.files.length; ++i) {
        if(val) val+= ', ';
        val+=this.files[i].name;
      }
      this.nextSibling.innerHTML = val;
    });
  }

  // file images
  var fileImages = document.querySelectorAll("label.image input[type=file]");
  for(var i=0; i<fileImages.length; ++i) {
    fileImages[i].addEventListener("change", function(e) {
      var preview = this.parentNode.nextElementSibling;
      preview.innerHTML = '';
      for(var i=0; i<this.files.length; ++i) {
        var fr = new FileReader();
        fr.onload=function() {
          var img = document.createElement('img');
          img.src = this.result;
          preview.appendChild(img);
        }
        fr.readAsDataURL(this.files[i]);
      }
    });
  }
});

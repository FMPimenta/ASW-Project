function showHint(str) {
    var xhttp;
    if (str.length == 0) { 
      return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        let arrayDistritos = this.responseText.split(', ');
        
        var options = '';
        if (document.getElementById('distrito').value != arrayDistritos[0]) {
            for (var i = 0; i < arrayDistritos.length; i++) {
                options += '<option value="' + arrayDistritos[i] + '" />';
            }
    
            document.getElementById('datalistDistrito').innerHTML = options;
        } else {
            options = "";
        }
        
      }
    };
    xhttp.open("GET", "distritos.php?q="+str, true);
    xhttp.send();   
  }
function showHint2(str) {
    var xhttp;
    if (str.length == 0) { 
      return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        let arrayFreguesias = this.responseText.split(', ');
        var options = '';

        if (document.getElementById('freguesia').value != arrayFreguesias[0]) {
            for (var i = 0; i < arrayFreguesias.length; i++) {
                options += '<option value="' + arrayFreguesias[i] + '" />';
            }

        document.getElementById('datalistFreguesias').innerHTML = options;
        } else {
            options = "";
        }
        
      }
    };
    xhttp.open("GET", "freguesias.php?q="+str, true);
    xhttp.send();   
  }
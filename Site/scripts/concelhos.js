function showHint1(str) {
    var xhttp;
    if (str.length == 0) { 
      return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        let arrayConcelhos = this.responseText.split(', ');
        var options = '';

        if (document.getElementById('concelho').value != arrayConcelhos[0]) {
            for (var i = 0; i < arrayConcelhos.length; i++) {
                options += '<option value="' + arrayConcelhos[i] + '" />';
            }
    
            document.getElementById('datalistConcelho').innerHTML = options;
        } else {
            options = "";
        }
      }
      
    };
    xhttp.open("GET", "concelhos.php?q="+str, true);
    xhttp.send();   
  }
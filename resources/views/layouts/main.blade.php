<!doctype html>
<html class="no-js" lang="hu">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dokument Kezelő, Nexum</title>
    <link rel="stylesheet" href="\css\bootstrap.min.css">
    <link rel="stylesheet" href="\css\foundation.min.css">
    <link rel="stylesheet" href="\css\app.css">
  </head>
  <body>
    <div class="top-bar">
      <div class="top-bar-left">
        <ul class="menu">
          <li class="menu-text"><a href="/home">dokumentumKezelo-Nexum</a></li>
            @if(Auth::check())
                <li><a href="/logout">Kijelentkezés</a></li>
              @else
                <li><a href="/register">Regisztráció</a></li>
                <li><a href="/login">Bejelentkezés</a></li>
            @endif
        </ul>
      </div>
    </div>

    @if(Session::has('uzenet'))
      <div class="callout success" onclick="$(this).fadeOut()">
        <h5>{{Session::get('uzenet')}}</h5>
        <button class="close-button" type="button">&times;</button>
      </div>
    @endif

    @if(Session::has('error'))
      <div class="callout unsuccessful" onclick="$(this).fadeOut()">
        <h5>{{Session::get('error')}}</h5>
        <button class="close-button" type="button">&times;</button>
      </div>
    @endif

    @yield('tartalom')

    <script>

      function getData(btn) {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            document.getElementById("modals").innerHTML = this.responseText;
        };
        xmlhttp.open("GET", "/fooldal/modals/modals/"+btn.id, true);
        xmlhttp.send();
      }

      function getText(text) {
        console.log(text.value);
        //Nagybetűvel kezdődik
        const regexnBetu = new RegExp(/[A-Z]/);  
        if(regexnBetu.test(text.value)){
          document.getElementById('nBetu').style.color = "#1ab012";
        }else{
          document.getElementById('nBetu').style.color = "#b01212";
        }
    
        //Legalább 3 karakter
        const regexmin3kar = new RegExp(/\w{3,}/);  
        if(regexmin3kar.test(text.value)){
          document.getElementById('min3kar').style.color = "#1ab012";
        }else{
          document.getElementById('min3kar').style.color = "#b01212";
        }
    
        //Számmal végződik
        const regexszamK = new RegExp(/\w{1,}\d/);  
        if(regexszamK.test(text.value)){
          document.getElementById('szamK').style.color = "#1ab012";
        }else{
          document.getElementById('szamK').style.color = "#b01212";
        }
      }
    </script>
    
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/foundation.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/app.min.js"></script>
    <script>(document).foundation();</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </body>
</html>
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
      <div class="top-bar-left center">
        <ul class="menu">
          <li class="menu-text"><a href="/home">dokumentumKezelo-Nexum</a></li>
            @if(Auth::check())
                <a href="/logout">Kijelentkezés</a>
              @else
                <a href="/register">Regisztráció</a> | 
                <a href="/login">Bejelentkezés</a>
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
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('js/foundation.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </body>
</html>
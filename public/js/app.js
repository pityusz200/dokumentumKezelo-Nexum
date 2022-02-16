    function getText(text) {
      //Nagybetűvel kezdődik
      const regexnBetu = new RegExp(/[A-ZÁÉÍÓÖŐÚÜŰ]/);  
      if(regexnBetu.test(text.value)){
        document.getElementById('nBetu').style.color = "#1ab012";
      }else{
        document.getElementById('nBetu').style.color = "#b01212";
      }

      //Legalább 3 karakter
      const regexmin3kar = new RegExp(/[A-Za-zÁÉÍÓÖŐÚÜŰáéíóöőúüű\s\d]{3,}/);  
      if(regexmin3kar.test(text.value)){
        document.getElementById('min3kar').style.color = "#1ab012";
      }else{
        document.getElementById('min3kar').style.color = "#b01212";
      }

      //Számmal végződik
      const regexszamK = new RegExp(/\d{1,}/);  
      if(regexszamK.test(text.value)){
        document.getElementById('szamK').style.color = "#1ab012";
      }else{
        document.getElementById('szamK').style.color = "#b01212";
      }
    }
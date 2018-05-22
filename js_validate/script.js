document.onreadystatechange = function () {
  if(document.readyState === "complete") {

    var values = {};
    var checkboxValues = [];
    var errors = [];

    var form = document.getElementById("form");

    function validateRadio (radios, radioName){
      for (var i = 0; i < radios.length; ++ i){
        if (radios[i].checked) values[radioName] = radios[i].value;
      }
      return false;
    }
    
    function validateCheckbox (checkboxen) {
      for (var i = 0; i < checkboxen.length; i++){
        if (checkboxen[i].checked) checkboxValues[i] = checkboxen[i].value;
      }
      return false;
    }

    function validateText(text, nameOfField){
      if(text.value !== "") {
        values[nameOfField] = text.value;
      }else{
        errors.push('Bitte das Feld '+text.previousElementSibling.innerHTML +' ausfüllen.');
      }
    }

    function displayValues(valuesArray, checkboxValues){
      document.getElementById("out_name").innerText = valuesArray.name;
      document.getElementById("out_number").innerText = valuesArray.number;
      document.getElementById("out_password").innerText = valuesArray.password;
      document.getElementById("description").innerText = valuesArray.textarea;
      document.getElementById("out_radio").innerText = valuesArray.radio;
      for (var i = 0; i < checkboxValues.length; i++){
        document.getElementById("out_classes").innerHTML += '<p class="d-inline mr-2">'+checkboxValues[i]+', </p>';
      }
    }

    function displayErrors(errorsArray) {
      var errorDiv = document.getElementById("errors");
      //console.log(errorDiv);
      for (var i = 0; i < errorsArray.length; i++){
        errorDiv.innerHTML = '<p class="text-red">'+ errorsArray[i] +'</p>';
      }
      return false;
    }

    form.onsubmit = function () {
      var form = document.forms["first_form"];
      var radios = form["customRadio"];
      var checkboxen = form["customCheckbox"];

      validateText(form["name"], "name");
      validateText(form["number"], "number");
      validateText(form["password"], "password");
      validateText(form["textarea"], "textarea");
      validateRadio(radios, "radio");
      validateCheckbox(checkboxen);
      displayValues(values, checkboxValues);

      if(values.length > 0){
        values = [];
      }else if(errors.length > 0){
        displayErrors(errors);
      }
      return (false);
    };
    console.log(errrors);
  }
};
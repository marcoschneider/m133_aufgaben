document.onreadystatechange = function () {
  if(document.readyState === "complete") {

    let values = {};
    let errors = [];

    let form = document.getElementById("form");

    function validateRadio (radios){
      for (let i = 0; i < radios.length; ++ i){
        if (radios[i].checked) values["radio"] = radios[i].value;
      }
      return false;
    }
    
    function validateCheckbox (checkboxen) {
      for (let i = 0; i < checkboxen.length; i++){
        if (checkboxen[i].checked) values["classes"] = checkboxen[i].value;
      }
    }

    function validateText(text, nameOfField){
      if(text.value !== "") {
        values[nameOfField] = text.value;
      }else{
        errors.push('Bitte das Feld '+text.previousElementSibling.innerHTML +' ausfüllen.');
      }
    }

    function displayValues(valuesArray){

    }

    function displayErrors(errorsArray) {
      var errorDiv = document.getElementById("errors");
      //console.log(errorDiv);
      for (let i = 0; i < errorsArray.length; i++){
        errorDiv.innerHTML = '<p class="red-text">'+ errorsArray[i] +'</p>';
      }
      return false;
    }

    form.onsubmit = function () {
      let form = document.forms["first_form"];
      let radios = form["customRadio"];
      let checkboxen = form[""];

      validateText(form["name"], "name");
      validateText(form["number"], "number");
      validateText(form["password"], "password");
      validateText(form["textarea"], "textarea");
      validateRadio(radios);
      //validateRadio();
      console.log(document.forms["first_form"]["customCheckbox"]);

      if(values.length > 0){
        values = [];
      }else if(errors.length > 0){
        displayErrors(errors);
      }
      return (false);
    };
    console.log(values);
    console.log(errors);
  }
};
document.onreadystatechange = function () {
  if(document.readyState === "complete") {

    let values = [];
    let errors = [];
    let formValues = [];

    let form = document.getElementById("form");

    function validateRadio (radios){
      for (let i = 0; i < radios.length; ++ i){
        if (radios[i].checked) return true;
      }
      return false;
    }

    function validateText(text){

      if(text.value !== "") {
        values.push(text.value);
      }else{
        //alert("Bitte alle Textfelder ausfüllen");
        errors.push('Bitte das Feld '+text.previousElementSibling.innerHTML +' ausfüllen.');
      }
    }

    function displayValues(valuesArray){

    }

    function displayErrors(errorsArray) {
      var errorDiv = document.getElementById("errors");
      console.log(errorDiv);
      for (let i = 0; i < errorsArray.length; i++){
        errorDiv.outerHTML = '<p class="red-text">'+ errorsArray[i] +'</p>';
      }
      return false;
    }

    form.onsubmit = function() {
      let form = document.forms["first_form"];
      let radios = form["customRadio"];

      validateText(form["name"]);
      validateText(form["number"]);
      validateText(form["password"]);

      console.log(values);
      console.log(errors);
      console.log(validateRadio(radios));

      //displayValues(values);

      if(values.length > 0){
        values = [];
      }else if(errors.length > 0){
        displayErrors(errors);
      }
      return false;
    };
  }
};
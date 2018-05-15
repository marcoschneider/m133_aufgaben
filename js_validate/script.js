document.onreadystatechange = function () {
  if(document.readyState === "complete") {

    var errors = [];
    var values = [];

    var form = document.getElementById("form");
    var name = document.getElementById("name").value;
    var number = document.getElementById("number").value;
    var password = document.getElementById("password").value;
    var textarea = document.getElementById("textarea").value;

    /*var difficulty = document.getElementById("advanced").value;
    var newsletter = document.getElementById("newsletter").value;*/
    var submit = document.getElementById("submit");

    if (password !== "") {
      values['password'] = password;
    } else {
      errors['password'] = "Password wurde nicht ausgefüllt";
    }

    function validateRadio (radios){
      for (i = 0; i < radios.length; ++ i){
        if (radios [i].checked) return true;
      }
      return false;
    }

    function validateText(text){
      for (let i = 0; i < text.length; i++) {
        if(text[i].value) return text[i].value;
      }
      return false;
    }

    form.onsubmit = function() {
      let form = document.forms[0];
      for (let i = 0; i < form.length; i++){
        console.log(form[i].getAttribute("type"));
        switch (form[i].getAttribute("type")){
          case 'text':
            values['text'] = validateText(form[i]);
            break;
          case 'password':
            values['password'] = validateText(form[i]);
            break;
          case 'radio':
            values['radios'] = validateRadio(form[i]);
            break;
        }
      }
      return values;
    };

   /* form.addEventListener("submit", function () {
      console.log(document.forms);
      return false;
    });*/
  }
};
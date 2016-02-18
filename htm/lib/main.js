//Password check
function validate() {
  var password1 = $("#password").val();
  var password2 = $("#confirmPass").val();
  var pass = document.getElementById("password");
  var re = new RegExp (/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/);
  var regNum = new RegExp (/[\d]{1}/);
  var regUpper = new RegExp (/[A-Z]{1}/);
  var regLower = new RegExp (/[a-z]{1}/);
  var regSpecial = new RegExp (/[$&+,*!#%^():;=?@#|]/);

    if(password1.length < 8 && !password1.match(regNum) && !password1.match(regUpper) && !password1.match(regSpecial)){
       pass.setCustomValidity("Your password must have 8 characters, 1 upper case, 1 lowercase, 1 number, and 1 special character!");
       return;
    }
    else if(!password1.match(regNum)){
        pass.setCustomValidity("You must have at least 1 number!");
        return;
    }
     else if(!password1.match(regUpper)){
        pass.setCustomValidity("You must have at least 1 upper case letter!");
        return;
    }
    else if(!password1.match(regLower)){
        pass.setCustomValidity("You must have at least one lower case letter!")
    }
    else if (!password1.match(regSpecial)){
        pass.setCustomValidity("You must have at least one special character!")
    }
    else{
        pass.setCustomValidity("");
    }    
}
function passMatch(){
    var password1 = $("#password").val();
    var password2 = $("#confirmPass").val();
    var pass = document.getElementById("confirmPass");
    
     if(password1 != password2) {
       pass.setCustomValidity("Passwords do not match!");        
    }
    else {
        pass.setCustomValidity("");  
    }
}

function focus(){
    var firstInvalid = document.getForm().items.find(function(f){return !f.isValid();});
    if (firstInvalid) {
        firstInvalid.focus();
    }
}

function validateZip(){
    var regUs = new RegExp(/^[0-9]{5}(-[0-9]{4})?$/);
    var loc = $("#country").val();
    var zipStr = $("#zip").val();
    
    var zip = document.getElementById("zip");
    
    if(loc == "United States of America" )
    {
        if(!zipStr.match(regUs)){
            zip.setCustomValidity("Invalid Zip Code");
        }
        else{
            zip.setCustomValidity("");
        }
    }
    else {
        zip.setCustomValidity("yes");
    }
}
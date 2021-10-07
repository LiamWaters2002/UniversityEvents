function validPassword(){
    const lower = /[a-z]/;
    const upper = /[A-Z]/;
    const number = /[0-9]/;
    const special = /\W/;
    var password = document.getElementById("password").value;

    if(!password){
        document.getElementById("password_alert").innerHTML =  "* Please enter a password";
        return false;
    }
    else if(password.length < 8){
        document.getElementById("password_alert").innerHTML =  "* You password must be atleast 8 characters long.";
        return false;
    }
    else if(password.search(lower) < 0){
        document.getElementById("password_alert").innerHTML =  "* You password must have at least 1 lower case letter.";
        return false;
    }
    else if(password.search(upper) < 0){
        document.getElementById("password_alert").innerHTML =  "* You password must have at least 1 upper case letter.";
        return false;
    }
    else if (password.search(number) < 0){
        document.getElementById("password_alert").innerHTML =  "* You password must have at least 1 number.";
        return false;
    }
    else if (password.search(special) < 0){
        document.getElementById("password_alert").innerHTML =  "* You password must have at least 1 special character.";
        return false;
    }
    else{//Passed JS Validation
        document.getElementById("password_alert").innerHTML =  "";
        return true;
    }
}

function validEmail(){
    const valid = /\S+@\S+\.\S+/;
    var email = document.getElementById("email").value;
    if(!email){
        document.getElementById("email_alert").innerHTML =  "* You must enter an email.";
        return false;
    }
    else if(!valid.test(email)){
        document.getElementById("email_alert").innerHTML =  "* Make sure you enter an email address in the correct format.";
        return false;
    }
    else{//Passed JS Validation
        document.getElementById("email_alert").innerHTML =  "";
        return true;
    }
}

function validNumber(){
    const valid = /^[0-9]+$/;
    var phoneNumber = document.getElementById("phone").value;

    if(!phoneNumber){
        document.getElementById("phone_alert").innerHTML = "* Phone Number is null. Please enter your phone number.";
        return false;
    }
    else if(!valid.test(phoneNumber)){
        document.getElementById("phone_alert").innerHTML = "* Make sure your phone number only contains numbers.";
        return false;
    }
    else if(phoneNumber.length != 11){
        document.getElementById("phone_alert").innerHTML = "* Your phone number must be 11 numbers long.";
        return false;
    }
    else{//Passed JS Validation
        document.getElementById("phone_alert").innerHTML = "";
        return true;
    }
}

function validName(txtName, alertName){
    const valid = /^[a-zA-Z]+$/;
    var name = document.getElementById(txtName).value; //Get the forename or surname from the textbox (txtName).
    if(!name){
  
        document.getElementById(alertName).textContent = "* Please enter your " + txtName  + ".";
        return false;
    }
    else if (!valid.test(name)){
         document.getElementById(alertName).textContent = "* You must not contain any numbers or spaces in your " + txtName  + ".";
         return false;
    }
    else{//Passed JS Validation
        document.getElementById(alertName).textContent = "";
        return true;
    } 
}

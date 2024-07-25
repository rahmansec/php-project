function Input_Validate() {

    var firstName = document.forms["Form"]["FirstName"].value;
    var lastName = document.forms["Form"]["LastName"].value;
    var email = document.forms["Form"]["Email"].value;
    var mobile = document.forms["Form"]["Mobile"].value;
    var password = document.forms["Form"]["Password"].value;
    var passwordRepet = document.forms["Form"]["PasswordRepet"].value;

    var password_Check = Password_Validate(password, passwordRepet);
    var password_Length_Check = Length_Password(password);
    var email_Check = Email_Validate(email);
    var mobile_Check = Mobile_Validate(mobile);

}

function Email_Validate(email) {
    var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if (reg.test(email)) {
        return true;
    }
    else {
        return false;
    }
}

function Password_Validate(password, passwordRepet) {
    var passString = (String)(password);
    if (password != passwordRepet) {
        document.getElementById("PasswordRepet").style.borderColor = "#e00909";
        return false;
    }
    else if (password == "") {
        document.getElementById("PasswordRepet").style.borderColor = "#e00909";
        document.getElementById("Password").style.borderColor = "#e00909";
        return false;
    }
    else {
        document.getElementById("PasswordRepet").style.borderColor = "#0ab948";
        document.getElementById("Password").style.borderColor = "#0ab948";
        return true;
    }

}

function Mobile_Validate(mobile) {
    var regexp = RegExp("09(0[1-2]|1[0-9]|3[0-9]|2[0-1])-?[0-9]{3}-?[0-9]{4}");
    if (regexp.test(mobile))
        return true;
    return false;

}

function Length_Password(password) {
    var passString = (String)(password);
    if (passString.length > 8) {
        return true;
    }
    else {
        alert("طول رمز عبور باید بیشتر از 8 رقم باشد");
        return false;
    }

}
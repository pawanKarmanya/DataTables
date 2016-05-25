$(document).ready(function () {

    $("#Name").on("keyup focusout", function () {

        var stringOfName = $("#Name").val();
        var lengthOfFirstName = stringOfName.length;
        var firstNameValid = checkingNumber(stringOfName);

        var errorInName = 0;
        if (lengthOfFirstName <= 0) {
            errorInName = 1;
            $("#Name")[0].setCustomValidity("Please enter Country");
            $("#Namepara").html("Please enter the Country");
            $("#Name").css("border", "1px solid red");
        }
        if (firstNameValid == 0) {
            errorInName = 1;

            this.setCustomValidity("Please enter alphabets");
            $("#Namepara").html("Please enter alphabets");
            $("#Name").css("border", "1px solid red");
        }
        if (errorInName == 0) {

            this.setCustomValidity("");
            $("#Namepara").html('');
            $("#Name").css("border", "");
        }
    });


    //last name validation
    $("#Code").on("keyup focusout", function () {
        
        var stringOfLastName = $("#Code").val();
        var lengthOfLastName = stringOfLastName.length;
        var lastNameValid = checkingNumber(stringOfLastName);
        var errorInLastName = 0;
        if ((lengthOfLastName <= 1)) {
            errorInLastName = 1;

            this.setCustomValidity("The Code should be of Two characters");
            $("#Codepara").html("The Code should be of Two characters");
            $("#Code").css("border", "1px solid red");
        }
else if(lengthOfLastName >=3){
    errorInLastName = 1;

            this.setCustomValidity("The Code should be of Two characters");
            $("#Codepara").html("The Code should be of Two characters");
            $("#Code").css("border", "1px solid red");
}
        if (lastNameValid == 0) {

            errorInLastName = 1;

            this.setCustomValidity("Please enter alphabets");
            $("#Codepara").html("Please enter alphabets");
            $("#Code").css("border", "1px solid red");
        }

        if (errorInLastName == 0) {

            this.setCustomValidity("");
            $("#Codepara").html('');
            $("#Code").css("border", "");
        }
    });

$("#Alias").on("keyup focusout", function () {
        var stringOfLastName = $("#Alias").val();
        var lengthOfLastName = stringOfLastName.length;
        var lastNameValid = checkingNumber(stringOfLastName);
        var errorInLastName = 0;
        if (lengthOfLastName <= 1) {
            errorInLastName = 1;

            this.setCustomValidity("The Alias should be of Three characters");
            $("#Aliaspara").html("The Alias should be of Three characters");
            $("#Alias").css("border", "1px solid red");
        }
else if(lengthOfLastName >=4){
     errorInLastName = 1;

            this.setCustomValidity("The Alias should be of Three characters");
            $("#Aliaspara").html("The Alias should be of Three characters");
            $("#Alias").css("border", "1px solid red");
}
        if (lastNameValid == 0) {

            errorInLastName = 1;

            this.setCustomValidity("Please enter alphabets");
            $("#Aliaspara").html("Please enter alphabets");
            $("#Alias").css("border", "1px solid red");
        }

        if (errorInLastName == 0) {

            this.setCustomValidity("");
            $("#Aliaspara").html('');
            $("#Alias").css("border", "");
        }
    });



    $("#DialCode").on("keyup focusout", function () {

        var phoneValue = $("#DialCode").val();
        var errorphone = 0;
        var phoneLength = phoneValue.length;

        if (phoneLength ==0)
        {
            errorphone = 1;

            this.setCustomValidity("Enter complete DialCode");
            $("#DialCodepara").html("Enter complete DialCode");
            $("#DialCode").css("border", "1px solid red");
        }
        if (phoneLength >0) {

            this.setCustomValidity("");
            $("#DialCode").css("border", "");
            $("#DialCodepara").html("");

        }

        var phoneNoValid = charValidForPhone(phoneValue);

        if (phoneLength >0) {
            if (!phoneNoValid)
            {
                errorphone = 1;

                this.setCustomValidity("Please Enter numbers");
                $("#DialCodepara").html("Please Enter numbers");
                $("#DialCode").css("border", "1px solid red");
            }

            if (phoneNoValid > 0) {

                this.setCustomValidity("");
                $("#DialCodepara").html("");
                $("#DialCode").css("border", "");

            }
        }

        if (errorphone == 0) {

            this.setCustomValidity("");
            $("#DialCode").css("border", "");
            $("#DialCodepara").html("");
        }

    });


    //checking the character of the string

    function checkingNumber(stringname) {
        var i;
        var returnValue;
        var numberValidation;
        var lengthof = stringname.length;
        for (i = 0; i < lengthof; i++) {
            numberValidation = Number(stringname.charAt(i));

            if (!numberValidation) {
                returnValue = true;
            } else {
                return returnValue = false;

            }
        }

        return returnValue;
    }




    function charValidForPhone(stringNamePhone) {
        var j;
        var numberLength;
        var lengthOfPhone = stringNamePhone.length;

        for (j = 0; j < lengthOfPhone; j++) {
            numberLength = Number(stringNamePhone.charAt(j));

            if (!numberLength) {

                if (stringNamePhone.charAt(j) == "0")
                {


                } else {
                    return false;
                }
            }
        }
        return true;
    }





});
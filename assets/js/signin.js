var first = document.getElementById('First Name');
var last = document.getElementById('Last Name');
//var companyName = document.getElementById('Company Name');
var elZip = document.getElementById('Zipcode');
var elPhone = document.getElementById('Phone');
var elEmail = document.getElementById('Email');
var elPassword = document.getElementById('Password');

function checkData(minLength, inputdiv, feedback, addclass){
    var msg = document.getElementById(feedback);
    var input = document.getElementById(inputdiv);
    var topdiv = document.getElementById(addclass);
    if(!input.value){
        topdiv.classList.add("has-error");
        msg.innerHTML = inputdiv + " is required.";
    }
    else if(input.value.length < minLength){
        topdiv.classList.add("has-error");
        msg.innerHTML = inputdiv + " must be "+ minLength + " characters or more.";
    }
    else{
        msg.innerHTML = "";
        topdiv.classList.remove("has-error");
        topdiv.classList.add("has-success");
    }
}
function checkEmail(email, feedback, addclass){
	var validRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var elMsg = document.getElementById(feedback);
	var topdiv = document.getElementById(addclass);
	if(elEmail.value.match(validRegex)){
		// code to display a valid email was entered
		topdiv.classList.remove("has-error");
		topdiv.classList.add("has-success");
		elMsg.innerHTML = '';
	}
	else{
		// code to display email is invalid
		topdiv.classList.add("has-error");
		elMsg.innerHTML = "Not a valid email";
	}
}
elEmail.addEventListener('blur', function(){
	checkEmail('Email', 'emailfeedback', 'topdivEmail');
	}, false);
elPassword.addEventListener('blur', function(){
	checkData(5, 'Password', 'passwordfeedback', 'topdivPassword');
	}, false);
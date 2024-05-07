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
        msg.innerHTML = inputdiv + " cannot be left blank.";
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
function checkPhone(length, inputdiv, feedback, addclass){
	// only numbers, including area codes, exactly 10 digits, cant be NULL
	var elMsg = document.getElementById(feedback);
	var el = document.getElementById(inputdiv);
	var topdiv = document.getElementById(addclass);

	if(!el.value){
		topdiv.classList.add("has-error");
		elMsg.innerHTML = inputdiv + " cannot be left blank";
	}
	else if(el.value.length == 7){
		topdiv.classList.add("has-error");
		elMsg.innerHTML = inputdiv + " must include area code, cannot be only 7 digits";
	}
	else if(el.value.length != 10){ // checks for 10 digits
		topdiv.classList.add("has-error");
		elMsg.innerHTML = inputdiv + " must be exactly 10 digits";
	}
	else{
		elMsg.innerHTML = '';
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
function checkZip(minLength,inputdiv, feedback, addclass){
	var elMsg = document.getElementById(feedback);
	var el = document.getElementById(inputdiv);
	var topdiv = document.getElementById(addclass);
	if(!el.value){
		topdiv.classList.add("has-error");
		elMsg.innerHTML = inputdiv + " cannot be left blank.";
	}
	else if(el.value.length != minLength){
		topdiv.classList.add("has-error");
		elMsg.innerHTML = inputdiv + " has to be 5 digits."
	}
	else{
		topdiv.classList.remove("has-error");
		topdiv.classList.add("has-success");
		elMsg.innerHTML = '';
	}
}
first.addEventListener('blur', function(){
    checkData(2, 'First Name', 'firstfeedback', 'topdivFirst');
}, false);
last.addEventListener('blur', function(){
    checkData(2, 'Last Name', 'lastfeedback', 'topdivLast');
}, false);
elZip.addEventListener('blur', function(){
	checkZip(5, 'Zipcode', 'zipcodefeedback', 'topdivZipcode');
}, false);
elPhone.addEventListener('blur', function(){
	checkPhone(10, 'Phone', 'phonefeedback', 'topdivPhone');
	}, false);
elEmail.addEventListener('blur', function(){
	checkEmail('Email', 'emailfeedback', 'topdivEmail');
	}, false);
elPassword.addEventListener('blur', function(){
	checkData(6, 'Password', 'passwordfeedback', 'topdivPassword');
	}, false);
// JavaScript Document
var elFirst = document.getElementById("First Name");
var elLast = document.getElementById("Last Name");
var elEmail = document.getElementById("Email");
var elMessage = document.getElementById("Message");

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
	var input = document.getElementById(email);
	if(!input.value){
        topdiv.classList.add("has-error");
        elMsg.innerHTML = "Email is required.";
    }
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


elFirst.addEventListener('blur', function(){
	checkData(2, "First Name", "firstnameFeedback", "topdivFirst")
	}, false);
elLast.addEventListener('blur', function(){
	checkData(2, "Last Name", "lastnameFeedback", "topdivLast")
	}, false);
elEmail.addEventListener('blur', function(){
	checkEmail('Email', 'emailfeedback', 'topdivEmail');
	}, false);
elMessage.addEventListener('blur', function(){
	checkData(2, "Message", "messageFeedback", "topdivMessage")
	}, false);


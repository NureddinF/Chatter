// captures the variables from document
var username = document.getElementById('username');
var password = document.getElementById('password');
//error divs to print back the errors if any recieved
var userError = document.getElementById('usernameError');
var passError = document.getElementById('passwordError');
var passRules = document.getElementById('passwordRules');

function validateForm(){

	//regular expression to check if a number is present in password
	var regexNum = /[0-9]+/;
	//regexx for at least on capital letter
	var regexCap = /[A-Z]+/;
	//reges for having either _ or $
	var regexSpecial = /[_$]+/;

	//checks if username is empty
	if(username.value === ''){
		//borders input field with red
		username.style.border = 'thin solid #c0392b';
		//adds text to text content
		userError.textContent = "Please provide username";
		//focus on input field
		username.focus();
		// returns false
		return false
	}
	//checks if password field is empty
	if(password.value === ''){
		password.style.border = 'thin solid #c0392b';
		passError.textContent = "Please provide password";
		password.focus();
		return false;
	}
	//checks if password length is less than 6
	if(password.value.length < 7){
		password.style.border = 'thin solid #c0392b';
		passError.textContent = 'Password is too short. Please try again.';
		passRules.textContent = "\nPassword needs to be atleast 7 characters long with at least one number, and one capital letter. Also needs to have a _ or $."
		passRules.style.color = "red";
		passError.style.color = "red";
		passError.style.fontWeight = "700";
		password.focus();
		return false;
	}
	//checks if password does not have a number
	if(!regexNum.test(password.value)){
		password.style.border = 'thin solid #c0392b';
		passError.textContent = 'Password must contain at least one number. Please try again.';
		passRules.textContent = "\nPassword needs to be atleast 7 characters long with at least one number, and one capital letter. Also needs to have a _ or $."
		passRules.style.color = "red";
		passError.style.color = "red";
		passError.style.fontWeight = "700";
		password.focus();
		return false;
	}
	//check for a capital letter
	if(!regexCap.test(password.value)){
		password.style.border = 'thin solid #c0392b';
		passError.textContent = 'Password must contain at least one capital letter. Please try again.';
		passRules.textContent = "\nPassword needs to be atleast 7 characters long with at least one number, and one capital letter. Also needs to have a _ or $."
		passRules.style.color = "red";
		passError.style.color = "red";
		passError.style.fontWeight = "700";
		password.focus();
		return false;
	}
	//check for special character _ or $
	if(!regexSpecial.test(password.value)){
		password.style.border = 'thin solid #c0392b';
		passError.textContent = 'Password must contain at least one _ or $. Please try again.';
		passRules.textContent = "\nPassword needs to be atleast 7 characters long with at least one number, and one capital letter. Also needs to have a _ or $."
		passRules.style.color = "red";
		passError.style.color = "red";
		passError.style.fontWeight = "700";
		password.focus();
		return false;
	}
	//otherwise it will return true
	else{
		return true;
	}
	
}
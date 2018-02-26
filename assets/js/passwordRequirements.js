function validate(form) {
	fail = validateLength(form.password.value);
	fail += validateContent(form.password.value);
	if   (fail == "")   return true
	else { document.getElementsByClassName("errorLabel")[0].innerHTML = fail; return false }
}

function validateLength(field) {
	if ( field.length < 6 ) {
		return "Password must be more than 6 characters long.";
	} else if ( field.length > 20 ) {
		return "Password must be less than 20 characters long.";
	}
	return "";
}

function validateContent(field) {
	let returnString = "";
	if(!/\d/.test(field)) {
		returnString += "<br>Password must contain at least one digit."
	}
	if(!/[a-z]/.test(field)) {
		returnString += "<br>Password must contain at least one lower case character."
	}
	if(!/[A-Z]/.test(field)) {
		returnString += "<br>Password must contain at least one upper case character."
	}

	return returnString;          
}
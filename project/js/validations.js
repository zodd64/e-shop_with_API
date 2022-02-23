
function ValidateEmail(inputText) {

	let mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

	if (inputText.value.match(mailformat)) {
		return true;
	} else {
		let error = document.getElementById("error");
		error.textContent = "Invalide Email Address!"
		setTimeout(function () {
			error.textContent = "";
		}, 3000);
		return false;
	}
}

function ValidatePass(inputText) {

	let passStrong = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

	if (inputText.value.match(passStrong)) {
		return true;
	} else {
		let error = document.getElementById("error");
		error.textContent = "Your Password Is Too Weak!"
		setTimeout(function () {
			error.textContent = "";
		}, 3000);
		return false;
	}
}

function ValidatePassConfirm(inputText1, inputText2) {

	if (inputText1.value === inputText2.value) {
		return true;
	} else {
		let error = document.getElementById("error");
		error.textContent = "The Passwords Don't Match!"
		setTimeout(function () {
			error.textContent = "";
		}, 3000);
		return false;
	}
}

function CreateUser() {
	fetch(`http://localhost:8080/api/v1/register/`, {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json'
		},
		body: JSON.stringify({
			"firstName": document.getElementById("fname").value,
			"lastName": document.getElementById("lname").value,
			"email": document.getElementById("email").value,
			"password": document.getElementById("psw").value,
			"address": document.getElementById("address").value,
			"city": document.getElementById("city").value,
			"postal": document.getElementById("postal").value,
			"tel": document.getElementById("phone").value,
			"enabled": "false",
			"confirmationToken": null
		})

	})

}

function Validate() {
	if (ValidateEmail(document.form1.email) && ValidatePass(document.form1.psw) && ValidatePassConfirm(document.form1.psw, document.form1.pswRepeat)) {
		return true;
	}
	else {
		let error = document.getElementById("error");
		error.textContent = "Something Went Wrong!"
		setTimeout(function () {
			error.textContent = "";
		}, 3000);
		return false;
	}
}


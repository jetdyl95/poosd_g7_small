var urlBase = 'http://COP4331-7.com/LAMPAPI';
var extension = 'php';

var userId = 0;
<<<<<<< HEAD
var firstName = "";
var lastName = "";
var phoneNum = "";
var email = "";
=======
var FirstName = "";
var LastName = "";
var Phone = "";
var Email = "";
>>>>>>> 1cc39556bbfcda0902d38de57c6dc5588812f56b


function addContact()
{
<<<<<<< HEAD
	var firstName = document.getElementById('FnameText').value;
	var lastName = document.getElementById('LnameText').value;
	var phoneNum = document.getElementById('PhoneNumText').value;
	var email = document.getElementById('emailText').value;

	var newContact = document.getElementById("contactText").value;
=======
//	var newContact = [];
	var FirstName = document.getElementById('FnameText').value;
	var LastName = document.getElementById('LnameText').value;
	var Phone = document.getElementById('PhoneNumText').value;
	var Email = document.getElementById('emailText').value;

>>>>>>> 1cc39556bbfcda0902d38de57c6dc5588812f56b
	document.getElementById("contactAddResult").innerHTML = "";

	var tmp = {fields:{FirstName:FirstName , LastName: LastName , Email: Email, Phone: Phone},UserID:userId};

	var jsonPayload = JSON.stringify( tmp );

	var url = urlBase + '/Add.' + extension;

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				document.getElementById("contactAddResult").innerHTML = "Contact has been added";
				console.log( xhr.responseText);
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("contactAddResult").innerHTML = err.message;
	}

}


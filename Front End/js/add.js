var urlBase = 'http://COP4331-7.com/LAMPAPI';
var extension = 'php';

var userId = 0;
var FirstName = "";
var LastName = "";
var Phone = "";
var Email = "";


function addContact()
{
//	var newContact = [];
	var FirstName = document.getElementById('FnameText').value;
	var LastName = document.getElementById('LnameText').value;
	var Phone = document.getElementById('PhoneNumText').value;
	var Email = document.getElementById('emailText').value;

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

	finally
	{
        document.getElementById("FnameText").value = "";
        document.getElementById("LnameText").value = "";
        document.getElementById("PhoneNumText").value = "";
        document.getElementById("emailText").value = "";
  }


}

var urlBase = 'http://COP4331-7.com/LAMPAPI';
var extension = 'php';

// NOT FINISHED AND TESTED YET //
var userId = 0;
var firstName = "";
var lastName = "";


function addContact()
{
	var newContact = document.getElementById("contactText").value;
	document.getElementById("contactAddResult").innerHTML = "";

	var tmp = {contact:newContact,userId,userId};
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
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("contactAddResult").innerHTML = err.message;
	}
	
}

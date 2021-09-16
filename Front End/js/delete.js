// NOT FINISHED AND TESTED //

var urlBase = 'http://COP4331-7.com/LAMPAPI';
var extension = 'php';

var userId = 0;
var firstName = "";
var lastName = "";

function confirmBox() 
{
	var txt;
	var r = confirm("Delete Contact?");
	if (r == true) {
		deleteContact();
	} else {
		txt = "pressed Cancel";
	}
	document.getElementById("deleteContactButton").innerHTML = txt;
}

function deleteContact()
{
	userId = 0;
	contactId = 0;
	var delContact = document.getElementById("contactDeleteText").value;
	document.getElementById("contactDeleteResult").innerHTML = "";

	//var tmp = {search:srch,userId:userId};
	var jsonPayload = JSON.stringify( tmp );

	var url = urlBase + '/Delete.' + extension;
	
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	try
	{
		xhr.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				var jsonObject = JSON.parse( xhr.responseText );
				userId = jsonObject.id;
		
				if( userId < 1 )
				{		
					document.getElementById("contactDeleteResult").innerHTML = "User/Password combination incorrect";
					return;
				}
		
				firstName = jsonObject.firstName;
				lastName = jsonObject.lastName;

				saveCookie();
	
				window.location.href = "search.html";
			}
		};
		xhr.send(jsonPayload);
	}
	catch(err)
	{
		document.getElementById("contactDeleteResult").innerHTML = err.message;
	}
}

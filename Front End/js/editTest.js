var urlBase = 'http://COP4331-7.com/LAMPAPI';
var extension = 'php';

var userId = 0;
var firstName = "";
var lastName = "";

function searchContact()
{
        var srch = document.getElementById("contactEditText").value;
        document.getElementById("contactEditResult").innerHTML = "";

        var contactList = "";

        var tmp = {userId:userId, searchTerm:srch};
        var jsonPayload = JSON.stringify( tmp );

        var url = urlBase + '/Search.' + extension;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
        try
        {
                xhr.onreadystatechange = function()
                {
                        if (this.readyState == 4 && this.status == 200)
                        {
                                document.getElementById("contactEditResult").innerHTML = "Contact(s) has been retrieved";
                                var jsonObject = JSON.parse( xhr.responseText );
                                var results = jsonObject.results;
                                //var temp = jsonObject.results.length;
                                console.log(results);
                                console.log("did my cats just ");

                                for (const [key, val] of Object.entries(results))
                                {

                                        console.log("harmonize");
                                        contactList += "Contact Id: ";
                                        contactList += val.contactId;
                                        contactList += " First Name: ";
                                    contactList += val.firstName;
                                        contactList += " Last Name: ";
                                        contactList += val.lastName;
                                        contactList += " Email: ";
                                        contactList += val.email;
                                        contactList += " Phone: ";
                                        contactList += val.phone;
                                        contactList += "<br />\r\n";
                                        contactList += "<br />\r\n";
                                }
                                 console.log(contactList);

                                        document.getElementsByTagName("p")[0].innerHTML = contactList;
                        }
                };
                xhr.send(jsonPayload);
        }
         catch(err)
        {
                document.getElementById("contactEditResult").innerHTML = err.message;
        }
 }

function editContact()
{
        var contactId = document.getElementById("contactIdEdit").value;

        // this is where itll display the error/success msgs 
        document.getElementById("submitEditResult").innerHTML = "";

        // array that holds int values of check marks
       // var fNameCheck = document.getElementById("fnameCheckBox").value;
       // var lNameCheck = document.getElementById("lnameCheckBox").value;
       // var phoneNumCheck = document.getElementById("PhoneNumCheckBox").value;
       // var emailCheck = document.getElementById("EmailCheckBox").value;


        if(document.getElementById('fnameCheckBox').checked)
	{
            fNameCheck = 1;
        }
	else
	{
            fNameCheck = 0;
        }
	console.log(fNameCheck);
	if(document.getElementById('lnameCheckBox').checked)
        {
            lNameCheck = 1;
        }
        else
        {
            lNameCheck = 0;
        }
	console.log(lNameCheck);

	if(document.getElementById('PhoneNumCheckBox').checked)
        {
            phoneNumCheck = 1;
        }
        else
        {
            phoneNumCheck = 0;
        }
	console.log(phoneNumCheck);

	if(document.getElementById('EmailCheckBox').checked)
        {
            emailCheck = 1;
        }
        else
        {
            emailCheck = 0;
        }
	console.log(emailCheck);

        // array that holds strings for each of the text boxs
        var fNameEdit = document.getElementById("FnameText").value;
        var lNameEdit = document.getElementById("LnameText").value;
        var phoneNumEdit = document.getElementById("PhoneNumText").value;
        var emailEdit = document.getElementById("emailText").value;
	
/*
"fields": {
    "firstName": 1,
    "lastName": 1,
    "email": 0,
    "phone": 0
  },
  "input": {
    "firstName": "Richard",
    "lastName": "Leinecker",
    "email": "",
    "phone": ""
  },
  "contactId": 1,
  "userId": 2
  */
        var tmp = {fields:{firstName:fNameCheck,lastName:lNameCheck,email:emailCheck,phone:phoneNumCheck},input:{firstName:fNameEdit,lastName:lNameEdit,email:emailEdit,phone:phoneNumEdit},contactId:contactId,userId:userId};
        var jsonPayload = JSON.stringify( tmp );

	console.log(jsonPayload);
        var url = urlBase + '/Edit.' + extension;

        var xhr = new XMLHttpRequest();
        xhr.open("PUT", url, true);
        xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
        try
        {
                xhr.onreadystatechange = function()
                {
                        if (this.readyState == 4 && this.status == 200)
                        {
                               //var jsonObject = JSON.parse( xhr.responseText );
				//console.log(jsonObject);
				document.getElementById("submitEditResult").innerHTML = "Contact Edited.";
                        }
                };
                xhr.send(jsonPayload);
        }
        catch(err)
        {
                document.getElementById("submitEditResult").innerHTML = err.message;
        }
}
         


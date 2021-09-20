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
        var contactId = document.getElementById("contactIdDel").value;
        //var firstNameDel = document.getElementById("fNametoDel").value;
        //var lastNameDel = document.getElementById("lNametoDel").value;

        document.getElementById("contactDeleteResult").innerHTML = "";

        var tmp = {userId:userId,contactId: contactId};
        var jsonPayload = JSON.stringify( tmp );

        var url = urlBase + '/Delete.' + extension;

	var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
        try
        {
                xhr.onreadystatechange = function()
                {
                       if(this.readyState == 4 && this.status == 200)
                        {
                                var jsonObject = JSON.parse( xhr.responseText );
                                document.getElementById("contactDeleteResult").innerHTML = "Contact has been deleted.";

                        }
                };
                xhr.send(jsonPayload);
        }
        catch(err)
        {
                document.getElementById("contactDeleteResult").innerHTML = err.message;
        }
}

function searchContact()
{
        var srch = document.getElementById("searchText").value;
        document.getElementById("contactSearchResult").innerHTML = "";

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
                                document.getElementById("contactSearchResult").innerHTML = "Contact(s) has been retrieved";
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
                document.getElementById("contactSearchResult").innerHTML = err.message;
        }
 }



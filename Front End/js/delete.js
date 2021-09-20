var urlBase = 'http://COP4331-7.com/LAMPAPI';
var extension = 'php';

var userId = 0;
var firstName = "";
var lastName = "";

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

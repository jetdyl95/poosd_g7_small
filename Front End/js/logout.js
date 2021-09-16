var urlBase = 'http://COP4331-7.com/LAMPAPI';
var extension = 'php';

userId = 0;
firstName = "";
lastName = "";


function doLogout()
{
	userId = 0;
	firstName = "";
	lastName = "";
	document.cookie = "firstName= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
	window.location.href = "index.html";
}

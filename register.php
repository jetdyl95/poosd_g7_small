<?php
	$inData = getRequestInfo();

	$firstName = $inData["firstName"];
	$lastName = $inData["lastName"];
	$userId = $inData["userId"];	// check this later to make sure userId auto increments
	$Login = $inData["Login"];
	$Password = $inData["Password"];
	// COMMENT

	$conn = new mysqli("localhost", "admin", "COP4331_7g", "COP4331");
	if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		$Date = $conn->query(select now());
		$stmt = $conn->prepare("INSERT into Users (UserId,DateCreated, DateLastLoggedIn, FirstName,LastName,Login,Password) VALUES(?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssss", $userId, $Date, $Date, $firstName, $lastName, $Login, $Password);
		$stmt->execute();
		$stmt->close();
		$conn->close();
		returnWithError("");
	}

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}

	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}

?>

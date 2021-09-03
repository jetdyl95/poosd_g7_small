<?php
	$inData = getRequestInfo();

	$firstName = $inData["firstName"];
	$lastName = $inData["lastName"];
	$Login = $inData["Login"];
	$Password = $inData["Password"];

	$conn = new mysqli("localhost", "admin", "COP4331_7g", "COP4331");
	if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}

	else
	{
		// check for already existing user
		$checkLoginExists = $conn->prepare("SELECT Login FROM Users WHERE Login=?");
		$checkLoginExists->bind_param("s", $inData["Login"]);
		$checkLoginExists->execute();
		$result = $checkLoginExists->get_result();
		$checkLoginExists->close();

		if( $row = $result->fetch_assoc())
		{
			returnWithError("User already exists");
		}

		else
		{
			// user does not already exist
			$stmt = $conn->prepare("INSERT into Users (firstName,lastName,Login,Password) VALUES(?,?,?,?)");
			$stmt->bind_param("ssss", $firstName, $lastName, $Login, $Password);
			$stmt->execute();
			$stmt->close();
			returnWithError("");
		}

		$conn->close();
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

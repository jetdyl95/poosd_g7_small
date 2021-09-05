<?php
  $inData = getRequestInfo();
  $fields = $inData["fields"];
  $userId = $inData["userId"];

  $conn = new mysqli("localhost", "admin", "COP4331_7g", "COP4331");
  if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}
  else
  {
    $stmt = $conn->prepare("INSERT into Contacts (userId, firstName,lastName,email,phone) VALUES(?,?,?,?,?)");
    $stmt->bind_param("sssss", $userId, $firstName, $lastName, $email, $phone);
    $stmt->execute();
    $stmt->close();
    returnWithError("");
  }

  $conn->close();


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

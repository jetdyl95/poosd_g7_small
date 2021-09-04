<?php
  $inData = getRequestInfo();
  $userId = $inData["userId"];
  $contactId = $inData["contactId"];

  $conn = new mysqli("localhost", "admin", "COP4331_7g", "COP4331");
	if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}

  else
  {
    $checkContactExists = $conn->prepare("SELECT FROM Contacts WHERE userId = ? AND contactId = ?");
    $checkContactExists = $conn->bind_param("ss", $userId, $contactId);
    $checkContactExists->execute();
    $result = $checkContactExists->get_result();

    if ($row = result->fetch_assoc())
    {
      $delQuery = $conn->prepare("DELETE FROM Contacts WHERE userId = ? AND contactId = ?");
      $delQuery = $conn->bind_param("ss", $userId, $contactId);
      $delQuery->execute();
      returnWithError("");
    }

    else
    {
      returnWithError("Could Not Find Contact. Deletion Failed.");
    }

    $conn->close();
    $checkContactExists->close();
    $delQuery->close();
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

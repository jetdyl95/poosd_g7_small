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
    $delQuery = $conn->prepare("DELETE FROM Contacts WHERE userId = ? AND id = ?");
    $delQuery->bind_param("ss", $userId, $contactId);
    $delQuery->execute();
    $affectedRows = $conn->affected_rows;

    if ($affectedRows == 0)
    {
      returnWithError("Contact not found, deletion failed.");
    }

    else
    {
      returnWithError("");
    }

    $conn->close();
    //$checkContactExists->close();
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

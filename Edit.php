<?php
  $inData = getRequestInfo();
  $fields = $inData['fields'];
  $inputs = $inData['inputs'];

  $conn = new mysqli("localhost", "admin", "COP4331_7g", "COP4331");
  if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}

  else
  {
    $doFirstNameEdit = $fields['firstName'];
    $doLastNameEdit = $fields['lastName'];
    $doEmailEdit = $fields['email'];
    $doPhoneEdit = $fields['phone'];

    $editQuery = $conn->prepare("UPDATE Contacts SET ? = ? WHERE (id = $inData['contactId'] AND userId = $inData['userId'])");
    $editCount = 0;

    if ($doFirstNameEdit)
    {
      $editQuery->bind_param("ss", 'firstName', $fields['firstName']);
      $editQuery->execute();
      $editCount++;
    }

    if ($doLastNameEdit)
    {
      $editQuery->bind_param("ss", 'lastName', $fields['lastName']);
      $editQuery->execute();
      $editCount++;
    }

    if ($doEmailEdit)
    {
      $editQuery->bind_param("ss", 'email', $fields['email']);
      $editQuery->execute();
      $editCount++;
    }

    if ($doPhoneEdit)
    {
      $editQuery->bind_param("ss", 'phone', $fields['phone']);
      $editQuery->execute();
      $editCount++;
    }

    returnWithError($editCount);
    $conn->close();
    $editQuery->close();
  }
  /*
  foreach ($fields as $key => $i)
  {
    foreach ($i as $key => $value)
    {
      echo $i;
    }
  }
*/
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

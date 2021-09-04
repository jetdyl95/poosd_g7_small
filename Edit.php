<?php
  $inData = getRequestInfo();
  $fields = $inData["fields"];
  $input = $inData["input"];
  $contactId = $inData["contactId"];
  $userId = $inData["userId"];

  $conn = new mysqli("localhost", "admin", "COP4331_7g", "COP4331");
  if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}
  else
  {
    $doFirstNameEdit = $fields["firstName"];
    $doLastNameEdit = $fields["lastName"];
    $doEmailEdit = $fields["email"];
    $doPhoneEdit = $fields["phone"];

    $fNameEdit = $conn->prepare("UPDATE Contacts SET firstName = ? WHERE id = $contactId AND userId = $userId");
    $lNameEdit = $conn->prepare("UPDATE Contacts SET lastName = ? WHERE id = $contactId AND userId = $userId");
    $emailEdit = $conn->prepare("UPDATE Contacts SET email = ? WHERE id = $contactId AND userId = $userId");
    $phoneEdit = $conn->prepare("UPDATE Contacts SET phone = ? WHERE id = $contactId AND userId = $userId");
    $editCount = 0;

    if ($doFirstNameEdit)
    {
      $fNameEdit->bind_param("s", $input["firstName"]);
      $fNameEdit->execute();
      $editCount++;
    }

    if ($doLastNameEdit)
    {
      $lNameEdit->bind_param("s", $input["lastName"]);
      $lNameEdit->execute();
      $editCount++;
    }

    if ($doEmailEdit)
    {
      $emailEdit->bind_param("s", $input["email"]);
      $emailEdit->execute();
      $editCount++;
    }

    if ($doPhoneEdit)
    {
      $phoneEdit->bind_param("ss", $input["phone"]);
      $phoneEdit->execute();
      $editCount++;
    }
  }

  $conn->close();
  $fNameEdit->close();
  $lNameEdit->close();
  $emailEdit->close();
  $phoneEdit->close();

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

<?php
  $inData = getRequestInfo();
  $searchTerm = $inData["searchTerm"];
  $searchTerm = "%".$searchTerm."%";

  $searchResults = "";
  $searchCount = 0;

  $conn = new mysqli("localhost", "admin", "COP4331_7g", "COP4331");
	if ($conn->connect_error)
	{
		returnWithError( $conn->connect_error );
	}

  else
  {
    $searchQuery = $conn->prepare("SELECT id FROM Contacts WHERE firstName LIKE ? OR lastName LIKE ? OR email LIKE ? AND id = ?");
    $searchQuery->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $inData["id"]);
    $searchQuery->execute();
    $result = $searchQuery->get_result();

    while ($row = $result->fetch_assoc())
    {
      if( $searchCount > 0 )
			{
				$searchResults .= ",";
			}
			$searchCount++;
			$searchResults .= '"' . $row["id"] . '"';
    }



    if ($searchCount == 0)
    {
      returnWithError("No Contacts Found");
    }

    else
    {
      returnWithError("");
    }

    $conn->close();
    $searchQuery->close();
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

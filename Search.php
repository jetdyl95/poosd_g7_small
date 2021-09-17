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
    $searchQuery = $conn->prepare("SELECT * FROM Contacts WHERE (firstName LIKE ? OR lastName LIKE ? OR email LIKE ? OR phone LIKE ?) AND userId = ?");
    $searchQuery->bind_param("sssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm, $inData["userId"]);
    $searchQuery->execute();
    $result = $searchQuery->get_result();

    while ($row = $result->fetch_assoc())
    {
      if( $searchCount > 0 )
			{
				$searchResults .= ",";
			}
			$searchCount++;
      $searchResults .= '"' . $row["firstName"] . '"';
      $searchResults .= '"' . $row["lastName"] . '"';
      $searchResults .= '"' . $row["email"] . '"';
      $searchResults .= '"' . $row["phone"] . '"';
    }



    if ($searchCount == 0)
    {
      returnWithError("No Contacts Found");
    }

    else
    {
      returnWithInfo($searchCount);
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

  function returnWithInfo($searchResults)
  {
    sendResultInfoAsJson($searchResults);
  }
 ?>

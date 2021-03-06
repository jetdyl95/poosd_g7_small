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

    while ($row = $result->fetch_row())
    {
      if( $searchCount > 0 )
			{
				$searchResults .= ",";
			}

			$searchCount++;
      $searchResults .= '"' . $searchCount . '":{';
      $searchResults .= '"contactId":"' . $row[0] . '", ';
      $searchResults .= '"firstName":"' . $row[3] . '", ';
      $searchResults .= '"lastName":"' . $row[4] . '", ';
      $searchResults .= '"email":"' . $row[5] . '", ';
      $searchResults .= '"phone":"' . $row[6] . '"';
      $searchResults .= '}';
    }



    if ($searchCount == 0)
    {
      returnWithError("No Contacts Found");
    }

    else
    {
      returnWithInfo($searchResults);
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
    $retValue = '{"results":{' . $searchResults . '},"error":""}';
    sendResultInfoAsJson($retValue);
  }
 ?>

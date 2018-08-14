<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title>Airline Ratings</title>
</head>
<body>
<?php
$DBName = "ratings";
$DBConnect = @mysqli_connect("localhost", "root", "mgs314");
if (empty($_POST['Date']) || empty($_POST['Time']) || empty($_POST['FlightNumber']) || empty($_POST['Friendliness']) || empty($_POST['Storage']) || empty($_POST['Seating']) || empty($_POST['Cleanliness']) || empty($_POST['Noise']))
	echo "Please enter in your flight information";
else {
	if ($DBConnect === FALSE)
		echo "<p>Can't find database server.</p>" . "<p>Error code" . mysqli_errno() . ": " . mysqli_error() . "</p>";
	else {
		if (!@mysqli_select_db($DBName, $DBConnect)) {
			$SQLString = "CREATE DATABASE $DBName";
			$QueryResult = @mysqli_query($SQLstring, $DBConnect);
			if ($QueryResult === FALSE)
				echo "<p>Unable to execute the query.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . 
				": " . mysqli_error($DBConnect) . "</p>";
		}
		mysqli_select_db($DBName, $DBConnect);
		$TableName = "flight review";
		$SQLstring = "SHOW TABLES LIKE '$TableName'";
		$QueryResult = @mysqli_query($SQLstring, $DBConnect);
		if (mysqli_num_rows($QueryResult) == 0) {
			$SQLString = "CREATE TABLE $TableName (countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, Date VARCHAR(40), Time VARCHAR(40), Flight_Number VARCHAR(40), Friendliness VARCHAR(40), Storage VARCHAR(40), Seating VARCHAR(40), Cleanliness VARCHAR(40), Noise VARCHAR(40))";
			$QueryResult = @mysqli_query($SQLstring, $DBConnect);
			if ($QueryResult===FALSE)
				echo "<p>Unable to create the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
			$Date= ($_POST['Date']);
			$Time = ($_POST['Time']);
			$FlightNumber = ($_POST['FlightNumber']);
			$Friendliness = ($_POST['Friendliness']);
			$Storage = ($_POST['Storage']);
			$Seating = ($_POST['Seating']);
			$Cleanliness = ($_POST['Cleanliness']);
			$Noise = ($_POST['Noise']);
			$SQLString = "INSERT INTO $TableName VALUES(NULL, '$Date', '$Time', '$FlightNumber', '$Friendliness', '$Storage', '$Seating', '$Cleanliness', '$Noise')";
			$QueryResult = @mysqli_query($SQLstring, $DBConnect);
			if ($QueryResult === FALSE)
				echo "<p>Unable to execute the query.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
		}
		mysqli_close($DBConnect);
	}
}
?>
</body>
</html>
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
if (DBConnect === FALSE)
	echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_errno() . ": " . mysqli_error() . "</p>";
else {
	if (!@mysqli_select_db($DBName, $DBConnect))
		echo "<p>There are no more entries in the guest book!</p>";
	else {
		$TableName = "flight review";
		$SQLstring = "SELECT * FROM $TableName";
		$QueryResult = @mysqli_query($SQLstring, $DBConnect);
		if (mysqli_num_rows($QueryResult) == 0)
			echo "<p>There are no more survey results in the log.</p>";
		else {
			echo "<p>Here are the responses we've received so far:</p>";
			echo "<table width='100%' border='1'>";
			echo "<tr><th>Survey Results</th></tr>";
			while (($Row = mysqli_fetch_assoc($QueryResult)) !== FALSE) {
				echo "<tr><td>{$Row['Time']}</td>";
				echo "<td>{$Row['Flight_Number']}</td>";
				echo "<td>{$Row['Friendliness']}</td>";
				echo "<td>{$Row['Storage']}</td>";
				echo "<td>{$Row['Seating']}</td>";
				echo "<td>{$Row['Cleanliness']}</td>";
				echo "<td>{$Row['Noise']}</td></tr>";
			}
		}
		mysqli_free_result($QueryResult);
	}
	mysqli_close($DBConnect);
}
?>
</body>
</html>
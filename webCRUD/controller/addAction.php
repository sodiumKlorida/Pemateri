<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
// Include the database connection file
require_once("../config/connection.php");

if (isset($_POST['submit'])) {
	// Escape special characters in string for use in SQL statement	
	$namaTugas = mysqli_real_escape_string($mysqli, $_POST['nama_tugas']);
	$deadLine = mysqli_real_escape_string($mysqli, $_POST['deadline_tugas']);
	$status = mysqli_real_escape_string($mysqli, $_POST['status_tugas']);
		
	// Check for empty fields
	if (empty($namaTugas) || empty($deadLine) || empty($status)) {
		if (empty($namaTugas)) {
			echo "<font color='red'>Tugas field is empty.</font><br/>";
		}
		
		if (empty($deadLine)) {
			echo "<font color='red'>Dead Line field is empty.</font><br/>";
		}
		
		if (empty($status)) {
			echo "<font color='red'>Status field is empty.</font><br/>";
		}
		
		// Show link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// If all the fields are filled (not empty) 

		// Insert data into database
		$result = mysqli_query($mysqli, "INSERT INTO tugas (`nama_tugas`, `deadline_tugas`, `status_tugas`) VALUES ('$namaTugas', '$deadLine', '$status')");
		
		// Display success message
		echo "<p><font color='green'>Data added successfully!</p>";
		echo "<a href='/index.php'>View Result</a>";
	}
}
?>
</body>
</html>

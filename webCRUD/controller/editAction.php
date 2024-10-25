<?php
// Include the database connection file
require_once("../config/connection.php");

if (isset($_POST['update'])) {
	// Escape special characters in a string for use in an SQL statement
	$id = mysqli_real_escape_string($mysqli, $_POST['id_tugas']);
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

		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else {
		// Update the database table
		$result = mysqli_query($mysqli, "UPDATE tugas SET `nama_tugas` = '$namaTugas', `deadline_tugas` = '$deadLine', `status_tugas` = '$status' WHERE `id_tugas` = $id");
		
		// Display success message
		// If update is successful
		if ($result) {
			echo "<script type='text/javascript'>
				alert('Data updated successfully!');
				window.location.href = '/index.php';
			</script>";
		} else {
			// If there's an error
			echo "<script type='text/javascript'>
				alert('Error updating data.');
			</script>";
		}


		
	}
}

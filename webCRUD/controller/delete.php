<?php
// Include the database connection file
require_once("../config/connection.php");

// Get id parameter value from URL
$id = $_GET['id_tugas'];

// Delete row from the database table
$result = mysqli_query($mysqli, "DELETE FROM tugas WHERE id_tugas = $id");

// Redirect to the main display page (index.php in our case)
header("Location:../page/index.php");

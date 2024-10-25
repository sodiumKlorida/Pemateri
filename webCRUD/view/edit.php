<?php
// Include the database connection file
require_once("../config/connection.php");

// Get id from URL parameter
$id = $_GET['id_tugas'];

// Select data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM tugas WHERE id_tugas = $id");

// Fetch the next row of a result set as an associative array
$resultData = mysqli_fetch_assoc($result);

$namaTugas = $resultData['nama_tugas'];
$deadLine = $resultData['deadline_tugas'];
$status = $resultData['status_tugas'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold text-center mb-6">Edit Data</h2>
        <div class="text-center mb-4">
            <a href="/index.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Home
            </a>
        </div>

        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <form name="edit" method="post" action="../controller/editAction.php">
                <div class="mb-4">
                    <label for="nama_tugas" class="block text-gray-700 font-bold mb-2">Tugas</label>
                    <input type="text" name="nama_tugas" id="nama_tugas" value="<?php echo $namaTugas; ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="deadline_tugas" class="block text-gray-700 font-bold mb-2">Dead Line</label>
                    <input type="text" name="deadline_tugas" id="deadline_tugas" value="<?php echo $deadLine; ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="status_tugas" class="block text-gray-700 font-bold mb-2">Status</label>

                    <!-- <input type="text" name="status_tugas" id="status_tugas" value="<?php echo $status; ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"> -->
					
					<select name="status_tugas" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            			<option value="2" <?php if ($status == 2) echo "selected"; ?>>Selesai</option>
            			<option value="1" <?php if ($status == 1) echo "selected"; ?>>Belum</option>
        			</select>
                </div>

                <input type="hidden" name="id_tugas" value="<?php echo $id; ?>">

                <div class="text-center">
                    <input type="submit" name="update" value="Update" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg cursor-pointer">
                </div>
            </form>
        </div>
    </div>
</body>
</html>


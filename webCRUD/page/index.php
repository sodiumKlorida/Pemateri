<?php

// Include the database connection file
require_once("../config/connection.php");

// Fetch data in descending order (latest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM Tugas ORDER BY id_tugas DESC");
?>

<html lang="en">
<head>	
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Homepage</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <div class="header 
        flex 
        items-center 
        justify-around 
        mb-6 
        w-[70%] 
        h-[5rem] 
        mx-auto 
        rounded-lg 
        bg-white 
        shadow-md">

            <!-- Title in the center -->
            <h2 class="text-3xl font-bold text-center text-gray-700">Homepage</h2>

            <!-- Button on the right -->
            <div class="text-right">
                <a href="add.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add New Data
                </a>
            </div>

            <!-- <div class="date">
                <?php
                    // echo "Today is " . date("Y/m/d") . "<br>";
                    echo $dateNow = date("Y/m/d");
                ?>
            </div> -->
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            // Fetch the next row of a result set as an associative array
            while ($res = mysqli_fetch_assoc($result)) {
                echo "<div class='bg-white shadow-md rounded-lg p-6'>";
                echo "<h3 class='text-xl font-semibold mb-2'>".$res['nama_tugas']."</h3>";
                echo "<p class='text-gray-600'><strong>Deadline:</strong> ".$res['deadline_tugas']."</p>";
                
                // echo "<p class='text-gray-600 mb-4'><strong>Status:</strong> ".$res['status_tugas']."</p>";

                // Menghitung selisih antara tanggal sekarang dan deadline
                $deadlineTugas = $res['deadline_tugas'];
                $deadNow = date("Y/m/d");

                $selisihHari = (strtotime($deadlineTugas) - strtotime($dateNow)) / (60 * 60 * 24);
                if ($selisihHari < 0) {
                    echo "<p class='text-red-500'> <strong>Lewat:</strong> Melebihi batas hari: ". round(abs($selisihHari));
                } else {
                    echo "<p class='text-green-500'> <strong>Sisa Waktu:</strong> Selisih hari: " . round($selisihHari);
                }

                // $deadline = new DateTime($res['deadline_tugas']);
                // $today = new DateTime(); // Default adalah tanggal hari ini
                // $interval = $today->diff($deadline);
                // $daysLeft = $interval->format('%a'); // Mengambil selisih dalam format hari

                // if ($today < $deadline) {
                //     echo "<p class='text-green-500'><strong>Sisa Waktu:</strong> $daysLeft hari lagi</p>";
                // } else if ($today > $deadline) {
                //     echo "<p class='text-red-500'><strong>Lewat:</strong> $daysLeft hari yang lalu</p>";
                // } else {
                //     echo "<p class='text-yellow-500'><strong>Hari ini deadline</strong></p>";
                // }

                // Logic menampilkan status
                if ($res['status_tugas'] == 1) {
                    echo "<p class='text-gray-600 mb-4'><strong>Status:</strong> Belum Selesai</p>";
                } else if ($res['status_tugas'] == 2) {
                    echo "<p class='text-gray-600 mb-4'><strong>Status:</strong> Selesai</p>";
                }
                
                echo "<div class='flex space-x-4'>";
                // echo "<a href=\"edit.php?id_tugas=$res[id_tugas]\" class='bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-1 px-3 rounded inline-flex items-center'>
                echo "<a href=\"edit.php?id_tugas=$res[id_tugas]\" class=' text-white font-bold py-1 px-3 rounded inline-flex items-center'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='2em' height='2em' viewBox='0 0 64 64'><path fill='#ffce31' d='M7.934 41.132L39.828 9.246l14.918 14.922l-31.895 31.886z'/><path fill='#ed4c5c' d='m61.3 4.6l-1.9-1.9C55.8-.9 50-.9 46.3 2.7l-6.5 6.5l15 15l6.5-6.5c3.6-3.6 3.6-9.5 0-13.1'/><path fill='#93a2aa' d='m35.782 13.31l4.1-4.102l14.92 14.92l-4.1 4.101z'/><path fill='#c7d3d8' d='m37.338 14.865l4.1-4.101l11.739 11.738l-4.102 4.1z'/><path fill='#fed0ac' d='m7.9 41.1l-6.5 17l4.5 4.5l17-6.5z'/><path fill='#333' d='M.3 61.1c-.9 2.4.3 3.5 2.7 2.6l8.2-3.1l-7.7-7.7z'/><path fill='#ffdf85' d='m7.89 41.175l27.86-27.86l4.95 4.95l-27.86 27.86z'/><path fill='#ff8736' d='m17.904 51.142l27.86-27.86l4.95 4.95l-27.86 27.86z'/></svg>
                        
                     </a>";

                //echo "<a href=\"../controller/delete.php?id_tugas=$res[id_tugas]\" onClick=\"return confirm('Are you sure you want to delete?')\" class='bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded'>
                echo "<a href=\"../controller/delete.php?id_tugas=$res[id_tugas]\" onClick=\"return confirm('Are you sure you want to delete?')\" class='text-white font-bold py-1 px-3 rounded'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='2em' height='2em' viewBox='0 0 48 48'><path fill='#b39ddb' d='M30.6 44H17.4c-2 0-3.7-1.4-4-3.4L9 11h30l-4.5 29.6c-.3 2-2 3.4-3.9 3.4'/><path fill='#7e57c2' d='M38 13H10c-1.1 0-2-.9-2-2s.9-2 2-2h28c1.1 0 2 .9 2 2s-.9 2-2 2'/></svg>
                      </a>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>

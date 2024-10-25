<?php

// Include the database connection file
require_once("config/connection.php");

// Fetch data in descending order (latest entry first)
$listTugas = mysqli_query($mysqli, "SELECT * FROM tugas ORDER BY id_tugas DESC");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 m-0">
    <div class="container mx-0">
        <div class="
        header 
        flex 
        items-center   
        justify-between
        mb-6 
        px-6
        w-full 
        h-[5rem]  
        sticky top-0 
        bg-white 
        shadow-md">

            <!-- Left Content (Greeting) -->
            <div class="flex flex-col">
                <h2 class="text-3xl font-bold text-gray-700">Hi, Nabil</h2>
            </div>

            <!-- Center Title -->
            <div class="flex flex-col">
                <h2 class="text-3xl font-bold text-gray-700 text-center">
                    Homepage
                </h2>
            </div>

            <!-- Right Content (Button) -->
            <div class="flex flex-col">
                <?= date("l, d F Y")?> 
            </div>
        </div>
    </div>

    <div class="flex flex-row justify-center mx-6">
        <div class="flex flex-col ">
            <h3>All</h3>
        </div>
        <div class="flex flex-col ">
            <h3>Belum</h3>
        </div>
        <div class="flex flex-col ">
            <h3>On Progress</h3>
        </div>
        <div class="flex flex-col ">
            <h3>Done</h3>
        </div>
        <div class="flex flex-col ">
            <h3>Cancelled</h3>
        </div>
    </div>

    <div class="flex flex-wrap"> <!-- Flex container for task cards -->
    <!-- Task List -->
    <?php foreach ($listTugas as $task): ?>   
        <div class="relative flex flex-col m-4 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-80"> <!-- Adjusted width -->
          <div class="p-6">
              <h5 class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                  <?=$task["judul"]?>
              </h5>
              <p class="block font-sans text-base antialiased font-light leading-relaxed text-inherit">
                  <?=$task["deskripsi"]?>
              </p>
              <span><?=$task["date"]?></span>
              <?php
                switch($task['status']) {
                  case 1:
                      echo '<p class="text-red-600">Belum</p>';
                      break;
                  case 2:
                      echo '<p class="text-yellow-600">Dalam Proses</p>';
                      break;
                  case 3:
                      echo '<p class="text-green-600">Selesai</p>';
                      break;
                  default:
                      echo '<p class="text-gray-600">Status Tidak Diketahui</p>';
                }
              ?>
          </div>
          <div class="p-6 pt-0">
            <!-- Open Modal Button -->
            <button type="button" class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none" 
              onclick="document.getElementById('modal-<?=$task['id']?>').showModal()">Edit</button>
          </div>
        </div>

        <!-- Modal for Editing Task -->
        <dialog id="modal-<?=$task['id']?>" class="bg-gray-200">
          <div class="bg-white p-8 w-[400px] rounded-lg">
              <h1>Edit Tugas</h1>
              <form action="../controller/TaskController.php" method="POST" class="flex flex-col">
                  <input type="hidden" name="id" value="<?=$task['id']?>"> <!-- Input tersembunyi untuk ID -->
                  <input class="my-2 outline-gray-900" type="text" name="judul" value="<?=$task["judul"]?>">
                  <textarea class="my-2" name="deskripsi"><?=$task['deskripsi'] ?></textarea>
                  <input type="date" name="date" value="<?=$task['date']?>">
                  <select class="my-2 py-1 text-gray-700 dark:text-gray-400 text-sm" name="status">
                      <option value="1" <?= $task['status'] == 1 ? 'selected' : '' ?>>Belum</option>
                      <option value="2" <?= $task['status'] == 2 ? 'selected' : '' ?>>Dalam Proses</option>
                      <option value="3" <?= $task['status'] == 3 ? 'selected' : '' ?>>Selesai</option>
                  </select>
                  <div>
                      <button type="button" class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none" 
                          onclick="document.getElementById('modal-<?=$task['id']?>').close()">Close</button>
                      <input value="Save" type="submit" class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-green-600 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none">
                  </div>
              </form>
          </div>
      </dialog>
    <?php endforeach; ?> 
  </div>
    
    <div class="fixed bottom-4 right-4">
    <button type="button" class="fixed bottom-6 right-6 bg-blue-500 text-white rounded-full p-4 shadow-lg hover:bg-blue-600 transition duration-300" onclick="document.getElementById('addTaskModal').showModal()">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
    </button>
    <dialog id="addTaskModal" class="bg-gray-200">
      <div class="bg-white p-8 w-[400px] rounded-lg">
          <h1>Tambah Tugas</h1>
          <form action="controller/addAction.php" method="POST" name="add" class="flex flex-col">
              <input type="hidden" name="action" value="add">
              <input class="my-2 outline-gray-900" type="text" name="nama_tugas" placeholder="Judul" required>
              <textarea class="my-2" name="deskripsi" placeholder="Deskripsi" required></textarea>
              <input type="date" name="deadline_tugas" required>
              <select class="my-2 py-1 text-gray-700 dark:text-gray-400 text-sm" name="status_tugas" required>
                  <option value="1">Belum</option>
                  <option value="2">Dalam Proses</option>
                  <option value="3">Selesai</option>
              </select>
              <div>
                  <button type="button" class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none" 
                          onclick="document.getElementById('addTaskModal').close()">Close</button>
                  <input value="Add" type="submit" class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-blue-600 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none">
              </div>
          </form>
      </div>
    </dialog>
</div>
</body>

</html>
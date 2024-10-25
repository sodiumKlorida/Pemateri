<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold text-center mb-6">Add Data</h2>
        <div class="text-center mb-4">
            <a href="/index.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Home
            </a>
        </div>

        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <form action="../controller/addAction.php" method="post" name="add">
                <div class="mb-4">
                    <label for="nama_tugas" class="block text-gray-700 font-bold mb-2">Nama Tugas</label>
                    <input type="text" name="nama_tugas" id="nama_tugas" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="deadline_tugas" class="block text-gray-700 font-bold mb-2">Dead Line</label>
                    <input type="date" name="deadline_tugas" id="deadline_tugas" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <!-- <label for="status_tugas" class="block text-gray-700 font-bold mb-2">Status</label> -->
                    <input value="1" name="status_tugas" type="hidden" id="status_tugas" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="text-center">
                    <input type="submit" name="submit" value="Add" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg cursor-pointer">
                </div>
            </form>
        </div>
    </div>
</body>
</html>

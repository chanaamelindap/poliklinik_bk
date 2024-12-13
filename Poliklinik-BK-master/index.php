<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinicare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to bottom right, #C8E6C9, #FFFFFF); /* Slightly darker pastel green to white gradient */
            color: #1B5E20; /* Darker green for text */
            font-family: 'Arial', sans-serif;
        }

        a {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        a:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .image-shadow {
            border-radius: 12px;
            box-shadow: none; /* Remove shadow */
            background: none; /* Remove background */
        }

        .btn-group {
            flex-direction: column;
        }

        @media (min-width: 768px) {
            .btn-group {
                flex-direction: row;
            }
        }
    </style>
</head>

<body class="flex flex-col-reverse md:flex-row items-center h-screen px-10 md:px-28">
    <!-- Left Side -->
    <div class="flex flex-col gap-5 items-center md:items-start text-center md:text-left w-full md:w-1/2">
        <h1 class="text-[#1B5E20] text-5xl md:text-6xl font-bold leading-snug">
            Welcome to <span class="text-[#81C784]">Clinicare</span>
        </h1>
        <p class="text-gray-700 text-lg md:text-xl">
            Empowering your health journey with seamless care and trusted expertise!
        </p>
        <div class="btn-group flex gap-5 mt-5 justify-center md:justify-start">
            <a href="auth/admin.php" class="flex items-center justify-center bg-[#1B5E20] text-white px-10 py-3 font-medium rounded-lg hover:bg-[#388E3C]">
                Login Admin
            </a>
            <a href="auth/login_dokter.php" class="flex items-center justify-center border border-[#1B5E20] text-[#1B5E20] px-10 py-3 font-medium rounded-lg hover:bg-[#81C784] hover:text-white">
                Login Dokter
            </a>
            <a href="auth/login_pasien.php" class="flex items-center justify-center border border-[#1B5E20] text-[#1B5E20] px-10 py-3 font-medium rounded-lg hover:bg-[#81C784] hover:text-white">
                Login Pasien
            </a>
        </div>
    </div>
    <!-- Left Side End -->

    <!-- Right Side -->
    <div class="flex justify-center md:justify-end mb-10 md:mb-0 w-full md:w-1/2">
        <img src="assets/images/doktor.png" class="w-[85%] md:w-full lg:w-[95%] object-contain md:ml-10" alt="Healthcare Illustration">
    </div>
    <!-- Right Side End -->
</body>

</html>

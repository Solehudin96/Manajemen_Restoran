<?php
session_start();
if (!isset($_SESSION["akun-admin"])) {
    if (isset($_SESSION["akun-user"])) {
        echo "<script>
            alert('Hanya admin yang dapat mencetak data!');
            location.href = '../index.php';
        </script>";
        exit;
    } else {
        header("Location: ../login.php");
        exit;
    }
}

// Ambil konten dari file "page.php"
ob_start();
include "page.php"; // Pastikan file ini berisi data yang akan ditampilkan
$content = ob_get_clean();

// Tampilkan data
echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Data Cetak</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        h1 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 10px;
        }

        p {
            font-size: 14px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f4f4f4;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }

        /* Responsif */
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 18px;
            }

            table th, table td {
                padding: 6px;
                font-size: 12px;
            }

            p {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class='container'>
        $content
        </div>
    </div>
</body>
</html>";
?>

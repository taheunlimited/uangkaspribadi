<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myCash</title>
    <style>
        /* Gaya untuk body dan latar belakang */
        body {
            margin: 0;
            padding: 0;
            background-color: #1e3a5f; /* Biru gelap */
            color: #fff; /* Warna teks putih */
            font-family: "Comic Sans MS", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        /* Gaya untuk tulisan myCash */
        h1 {
            font-size: 4rem; /* Ukuran font besar */
            margin-bottom: 20px; /* Jarak bawah */
        }

        /* Gaya untuk tombol */
        .btn {
            background-color: #377dff; /* Biru solid */
            color: #fff;
            font-size: 1.2rem;
            font-family: "Comic Sans MS", sans-serif;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        /* Hover efek untuk tombol */
        .btn:hover {
            background-color: #265ea8; /* Biru lebih gelap */
        }
    </style>
</head>
<body>
    <div>
        <h1>myCash</h1>
        <a href="{{ route('transaction.index') }}" class="btn">Lihat Transaksi</a>
    </div>
</body>
</html>

<?php
// belanja_post.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer = $_POST['customer'] ?? '';
    $produk = $_POST['produk'] ?? '';
    $jumlah = $_POST['jumlah'] ?? 0;

    $harga_produk = [
        'TV' => 3000000,
        'Kulkas' => 4000000,
        'Mesin Cuci' => 2500000
    ];

    $total_harga = $harga_produk[$produk] * $jumlah;

    echo "<h1>Hasil Belanja</h1>";
    echo "<p>Customer: $customer</p>";
    echo "<p>Produk Pilihan: $produk</p>";
    echo "<p>Jumlah Beli: $jumlah</p>";
    echo "<p>Total Harga: Rp " . number_format($total_harga, 0, ',', '.') . "</p>";
} else {
    echo "<p>Metode tidak valid. Gunakan POST.</p>";
}

$conn = new mysqli("localhost", "root", "", "praktikum_php");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO belanja (customer, produk, jumlah, total_harga) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssii", $customer, $produk, $jumlah, $total_harga);
$stmt->execute();
$stmt->close();
$conn->close();

?>

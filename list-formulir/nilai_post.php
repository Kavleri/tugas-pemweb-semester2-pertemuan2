<?php
// nilai_post.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $matkul = $_POST['matkul'] ?? '';
    $nilai_uts = $_POST['nilai_uts'] ?? 0;
    $nilai_uas = $_POST['nilai_uas'] ?? 0;
    $nilai_tugas = $_POST['nilai_tugas'] ?? 0;

    // Hitung nilai total dan kelulusan
    $nilai_total = ($nilai_uts * 0.3) + ($nilai_uas * 0.35) + ($nilai_tugas * 0.35);
    $kelulusan = $nilai_total > 55 ? 'Lulus' : 'Tidak Lulus';

    // Tentukan grade
    if ($nilai_total < 0 || $nilai_total > 100) {
        $grade = 'I';
    } elseif ($nilai_total <= 35) {
        $grade = 'E';
    } elseif ($nilai_total <= 55) {
        $grade = 'D';
    } elseif ($nilai_total <= 69) {
        $grade = 'C';
    } elseif ($nilai_total <= 84) {
        $grade = 'B';
    } else {
        $grade = 'A';
    }

    // Tentukan predikat
    $predikat = match ($grade) {
        'A' => 'Sangat Memuaskan',
        'B' => 'Memuaskan',
        'C' => 'Cukup',
        'D' => 'Kurang',
        'E' => 'Sangat Kurang',
        'I' => 'Tidak Ada',
        default => 'Tidak Valid',
    };

    echo "<h1>Hasil Nilai (POST Request)</h1>";
    echo "<p>Nama: $nama</p>";
    echo "<p>Mata Kuliah: $matkul</p>";
    echo "<p>Nilai Total: $nilai_total</p>";
    echo "<p>Kelulusan: $kelulusan</p>";
    echo "<p>Grade: $grade</p>";
    echo "<p>Predikat: $predikat</p>";
} else {
    echo "<p>Metode tidak valid. Gunakan POST.</p>";
}

$conn = new mysqli("localhost", "root", "", "praktikum_php");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO nilai (nama, matkul, nilai_uts, nilai_uas, nilai_tugas, nilai_total, kelulusan, grade, predikat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssiiissss", $nama, $matkul, $nilai_uts, $nilai_uas, $nilai_tugas, $nilai_total, $kelulusan, $grade, $predikat);
$stmt->execute();
$stmt->close();
$conn->close();

?>

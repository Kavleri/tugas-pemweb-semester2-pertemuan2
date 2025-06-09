<?php
// nilai_get.php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $nama = $_GET['nama'] ?? '';
    $matkul = $_GET['matkul'] ?? '';
    $nilai_uts = $_GET['nilai_uts'] ?? 0;
    $nilai_uas = $_GET['nilai_uas'] ?? 0;
    $nilai_tugas = $_GET['nilai_tugas'] ?? 0;

    echo "<h1>Hasil Nilai (GET Request)</h1>";
    echo "<p>Nama: $nama</p>";
    echo "<p>Mata Kuliah: $matkul</p>";
    echo "<p>Nilai UTS: $nilai_uts</p>";
    echo "<p>Nilai UAS: $nilai_uas</p>";
    echo "<p>Nilai Tugas: $nilai_tugas</p>";
} else {
    echo "<p>Metode tidak valid. Gunakan GET.</p>";
}
?>

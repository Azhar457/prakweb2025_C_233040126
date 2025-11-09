<?php

// Memuat file konfigurasi dan kelas Database untuk mengakses konstanta dan kelas
require_once '../app/config/config.php';
require_once '../app/core/Database.php';

echo "<h1>Tes Koneksi dan Query Database</h1>";

try {
    // Langkah 1: Mencoba membuat koneksi ke database.
    // Jika gagal, PDOException akan dilempar oleh konstruktor kelas Database.
    $db = new Database();
    echo "<p style='color:green;'>✅ Berhasil terhubung ke database '<strong>" . DB_NAME . "</strong>'.</p>";

    // Langkah 2: Mencoba mengambil data dari tabel 'users'.
    echo "<p>Mencoba mengambil data dari tabel 'users'...</p>";
    $db->query('SELECT * FROM users');
    $users = $db->resultSet();

    // Langkah 3: Memeriksa dan menampilkan hasil query.
    if ($users && count($users) > 0) {
        echo "<p style='color:green;'>✅ Berhasil mengambil " . count($users) . " baris data dari tabel 'users'.</p>";
        echo "<h2>Data Pengguna:</h2>";
        echo "<pre>";
        print_r($users);
        echo "</pre>";
    } else {
        echo "<p style='color:orange;'>⚠️ Koneksi berhasil, tetapi tidak ada data yang ditemukan di tabel 'users'.</p>";
    }
} catch (PDOException $e) {
    // Menangkap error jika koneksi gagal dan menampilkannya.
    echo "<p style='color:red;'>❌ Gagal terhubung ke database.</p>";
    echo "<p><strong>Pesan Error:</strong> " . $e->getMessage() . "</p>";
}
?>
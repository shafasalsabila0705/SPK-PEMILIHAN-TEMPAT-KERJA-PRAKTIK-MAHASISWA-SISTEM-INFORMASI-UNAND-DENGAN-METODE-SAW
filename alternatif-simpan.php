<?php
require "include/conn.php";

// Ambil input
$name_input = trim($_POST['name']);

// Validasi kosong
if (empty($name_input)) {
    header("Location: alternatif.php?msg=kosong");
    exit;
}

// Normalisasi nama: kecil semua dan hilangkan semua spasi (untuk dibandingkan)
$normalized_input = strtolower(str_replace(' ', '', $name_input));

// Ambil semua nama dari DB untuk dicek satu-satu
$cek = mysqli_query($db, "SELECT name FROM saw_alternatives");
while ($row = mysqli_fetch_assoc($cek)) {
    $normalized_existing = strtolower(str_replace(' ', '', $row['name']));
    if ($normalized_input == $normalized_existing) {
        header("Location: alternatif.php?msg=duplikat");
        exit;
    }
}

// Simpan ke DB nama aslinya (tidak diubah)
$sql = "INSERT INTO saw_alternatives (name) VALUES ('$name_input')";
if ($db->query($sql) === true) {
    header("Location: alternatif.php?msg=sukses");
} else {
    header("Location: alternatif.php?msg=gagal");
}
exit;
?>

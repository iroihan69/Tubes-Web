<?php
// Konfigurasi koneksi ke database
$host = "localhost";  // Host database
$user = "root";       // Username database Anda
$pass = "";           // Password database Anda
$db   = "tubes";      // Nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $pass, $db);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk membuat tabel 'cars'
$sql_create_table = "
CREATE TABLE IF NOT EXISTS cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price VARCHAR(50) NOT NULL,
    torque VARCHAR(50) NOT NULL,
    power VARCHAR(50) NOT NULL,
    `range` VARCHAR(50) NOT NULL,
    battery VARCHAR(50) NOT NULL,
    acceleration VARCHAR(50) NOT NULL
)";

// Eksekusi query untuk membuat tabel
if ($conn->query($sql_create_table) === TRUE) {
    echo "Tabel 'cars' berhasil dibuat atau sudah ada.<br>";
} else {
    die("Error membuat tabel: " . $conn->error);
}

// Query untuk mengisi data awal ke tabel 'cars'
$sql_insert_data = "
INSERT INTO cars (name, price, torque, power, `range`, battery, acceleration) VALUES
('BYD SEAL Performance AWD', 'Rp719.000.000', '670 N.m', '390 kW', '580 km', '82.56 kWh', '3.8 s'),
('BYD ATTO 3 Superior', 'Rp515.000.000', '310 N.m', '130 kW', '410 km', '49.92 kWh', '7.9 s'),
('BYD DOLPHIN Premium Extended Range', 'Rp425.000.000', '180 N.m', '70 kW', '410 km', '44.9 kWh', '12.3 s'),
('BYD M6 Superior Captain (6 Seater)', 'Rp429.000.000', '310 N.m', '120 kW', '420 km', '55.4 kWh', '10.1 s')
";

// Eksekusi query untuk mengisi data
if ($conn->query($sql_insert_data) === TRUE) {
    echo "Data berhasil dimasukkan ke dalam tabel 'cars'.<br>";
} else {
    echo "Error memasukkan data: " . $conn->error;
}

// Tutup koneksi
$conn->close();
?>

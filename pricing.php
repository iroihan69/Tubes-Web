<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tubes";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari tabel cars
$sql = "SELECT name, price, torque, power, `range`, battery, acceleration FROM cars";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BYD Plus</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body style="background-color: white;">
    <!-- Navbar -->
    <header>
        <div class="navbar" style="background-color: black;">
            <div class="logo">BYD</div>
            <nav>
                <ul class="menu">
                    <li>
                        <a href="dashboard.php">Vehicles</a>
                        <div class="submenu">
                            <ul>
                                <li>
                                    <img src="./assets/menu-seal.png" alt="Seal">
                                    <a href="seal.php">Seal</a>
                                </li>
                                <li>
                                    <img src="./assets/menu-atto-3-rev2.png" alt="Atto 3">
                                    <a href="atto3.php">Atto 3</a>
                                </li>
                                <li>
                                    <img src="./assets/menu-dolphin-rev.png" alt="Dolphin">
                                    <a href="dolphin.php">Dolphin</a>
                                </li>
                                <li>
                                    <img src="./assets/menu-m6.png" alt="M6">
                                    <a href="m6.php">M6</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Found Us</a></li>
                    <li><a href="pricing.php">Pricing</a></li>
                </ul>
            </nav>
            <div class="icons">
                <a href="login.php">👤</a>
            </div>
        </div>
    </header>

    <section class="price-section">
        <h1 class="price-title">Daftar Harga</h1>
        <hr>

        <!-- Tabel Harga -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Mobil</th>
                        <th>Harga</th>
                        <th>Torsi Maksimum</th>
                        <th>Daya Maksimum</th>
                        <th>Jarak Mengemudi</th>
                        <th>Kapasitas Baterai</th>
                        <th>0-100 km/h</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['price']); ?></td>
                                <td><?php echo htmlspecialchars($row['torque']); ?></td>
                                <td><?php echo htmlspecialchars($row['power']); ?></td>
                                <td><?php echo htmlspecialchars($row['range']); ?></td>
                                <td><?php echo htmlspecialchars($row['battery']); ?></td>
                                <td><?php echo htmlspecialchars($row['acceleration']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">Tidak ada data tersedia</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <style>
        .table-container {
            width: 100%;
            overflow-x: auto;
            margin: 20px auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            margin: 0 auto;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #333;
            color: #fff;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>

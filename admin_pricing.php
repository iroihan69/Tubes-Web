<?php
session_start();

// Periksa apakah pengguna sudah login dan role-nya admin
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "tubes";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Variabel untuk prefill form
$edit_id = $name = $price = $torque = $power = $range = $battery = $acceleration = "";

// Prefill form ketika tombol Edit ditekan
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result_edit = $stmt->get_result();
    if ($result_edit->num_rows > 0) {
        $row = $result_edit->fetch_assoc();
        $name = $row['name'];
        $price = $row['price'];
        $torque = $row['torque'];
        $power = $row['power'];
        $range = $row['range'];
        $battery = $row['battery'];
        $acceleration = $row['acceleration'];
    }
    $stmt->close();
}

// CRUD Logic
if (isset($_POST['create'])) {
    // Jika form sedang update
    if (!empty($_POST['id'])) {
        $stmt = $conn->prepare("UPDATE cars SET name=?, price=?, torque=?, power=?, `range`=?, battery=?, acceleration=? WHERE id=?");
        $stmt->bind_param("sssssssi", $_POST['name'], $_POST['price'], $_POST['torque'], $_POST['power'], $_POST['range'], $_POST['battery'], $_POST['acceleration'], $_POST['id']);
    } else {
        $stmt = $conn->prepare("INSERT INTO cars (name, price, torque, power, `range`, battery, acceleration) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $_POST['name'], $_POST['price'], $_POST['torque'], $_POST['power'], $_POST['range'], $_POST['battery'], $_POST['acceleration']);
    }
    $stmt->execute();
    header("Location: admin_pricing.php");
    exit();
} elseif (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM cars WHERE id=?");
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
    header("Location: admin_pricing.php");
    exit();
}

// Ambil data
$result = $conn->query("SELECT * FROM cars");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Harga</title>
    <style>
        /* Reset Style */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background-color: #f9f9f9; color: #333; line-height: 1.6; }
        h1 { text-align: center; margin: 20px 0; font-size: 2.2rem; color: #2c3e50; }

        /* Container */
        .container { width: 90%; margin: 20px auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }

        form { margin-bottom: 20px; padding: 20px; background: #f4f4f4; border-radius: 10px; }
        form h3 { margin-bottom: 10px; font-size: 1.5rem; }
        form label { font-weight: bold; margin-bottom: 5px; display: block; }
        form input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; }
        button { padding: 10px 15px; margin-right: 10px; border: none; border-radius: 5px; cursor: pointer; color: #fff; }
        .btn-primary { background-color: #28a745; }
        .btn-secondary { background-color: #6c757d; }
        button:hover { opacity: 0.8; }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        table th, table td { padding: 12px; text-align: center; border: 1px solid #ddd; }
        table th { background-color: #343a40; color: white; }
        table tr:nth-child(even) { background-color: #f2f2f2; }
        table tr:hover { background-color: #e2e6ea; }
        .action-btn { margin: 0 5px; padding: 8px 12px; border-radius: 5px; color: #fff; text-decoration: none; }
        .edit-btn { background-color: #007bff; }
        .delete-btn { background-color: #dc3545; }
        .logout-btn {
            display: block;
            margin: 10px auto;
            width: fit-content;
            padding: 10px 20px;
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .logout-btn:hover {
            background-color: #c82333;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <h1>Admin - Daftar Harga Mobil</h1>
    <a href="logout.php" class="logout-btn">Keluar</a> <!-- Tombol Logout -->
    <div class="container">
        <!-- Form Tambah Data -->
        <form method="POST">
            <h3><?= isset($_GET['edit']) ? "Edit Data" : "Tambah Data" ?></h3>
            <input type="hidden" name="id" value="<?= $edit_id ?>">
            <label for="name">Nama Mobil:</label>
            <input type="text" name="name" value="<?= $name ?>" required>

            <label for="price">Harga:</label>
            <input type="text" name="price" value="<?= $price ?>" required>

            <label for="torque">Torsi:</label>
            <input type="text" name="torque" value="<?= $torque ?>" required>

            <label for="power">Daya:</label>
            <input type="text" name="power" value="<?= $power ?>" required>

            <label for="range">Jarak:</label>
            <input type="text" name="range" value="<?= $range ?>" required>

            <label for="battery">Baterai:</label>
            <input type="text" name="battery" value="<?= $battery ?>" required>

            <label for="acceleration">0-100 km/h:</label>
            <input type="text" name="acceleration" value="<?= $acceleration ?>" required>

            <button type="submit" name="create" class="btn-primary"><?= isset($_GET['edit']) ? "Update" : "Tambah" ?></button>
        </form>

        <!-- Tabel Data -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Torsi</th>
                    <th>Daya</th>
                    <th>Jarak</th>
                    <th>Baterai</th>
                    <th>0-100 km/h</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><?= $row['torque'] ?></td>
                    <td><?= $row['power'] ?></td>
                    <td><?= $row['range'] ?></td>
                    <td><?= $row['battery'] ?></td>
                    <td><?= $row['acceleration'] ?></td>
                    <td>
                        <a href="?edit=<?= $row['id'] ?>" class="action-btn edit-btn">Edit</a>
                        <a href="?delete=<?= $row['id'] ?>" class="action-btn delete-btn" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

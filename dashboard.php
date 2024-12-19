<?php
session_start();

// Nonaktifkan cache agar data lama tidak ditampilkan
header("Cache-Control: no-cache, must-revalidate, max-age=0");
header("Expires: 0");
header("Pragma: no-cache");

// Periksa status login
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tubes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Note: Use more secure hashing algorithms like bcrypt in production

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $email;
        header("location: welcome.php"); // redirect to a welcome page
    } else {
        echo "<script>alert('Invalid email or password');</script>";
    }
    $stmt->close();
}

// Handle registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Note: Use bcrypt in production

    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    if ($stmt->affected_rows === 1) {
        echo "<script>alert('Registration successful');</script>";
    } else {
        echo "<script>alert('Registration failed');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BYD Plus</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navbar -->
    <header>
        <div class="navbar">
            <div class="logo">BYD</div>
            <nav>
                <ul class="menu">
                    <li>
                        <a href="#">Vehicles</a>
                        <div class="submenu">
                            <ul>
                                <li>
                                    <img src="assets/menu-seal.png" alt="Seal">
                                    <a href="seal.php">Seal</a>
                                </li>
                                <li>
                                    <img src="assets/menu-atto-3-rev2.png" alt="Atto 3">
                                    <a href="atto3.php">Atto 3</a>
                                </li>
                                <li>
                                    <img src="assets/menu-dolphin-rev.png" alt="Dolphin">
                                    <a href="dolphin.php">Dolphin</a>
                                </li>
                                <li>
                                    <img src="assets/menu-m6.png" alt="M6">
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
                <?php if ($logged_in): ?>
                    <!-- Jika sudah login -->
                    <a href="profile.php">👤 Profile</a>
                    <a href="dashboard.php" onclick="confirmLogout()">🚪 Logout</a>
                <?php else: ?>
                    <!-- Jika belum login -->
                    <a href="login.php">🔑 Login</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <img src="./assets/4cars-home-desktop.jpg" alt="BYD Hero" class="hero-image">
        <div class="hero-text">
            <h1></h1>
                <div class="buttons">
                <a href="seal.php" class="btn">Order Seal</a>
                <a href="atto3.php" class="btn">Order Atto 3</a>
                <a href="dolphin.php" class="btn">Order Dolphin</a>
                <a href="m6.php" class="btn">Order M6</a>
            </div>
        </div>
    </section>

    <section class="hero">
        <img src="./assets/section-seal.jpg" alt="BYD Hero" class="hero-image">
        <div class="hero-text" style="margin-top: 100px;">
            <h1>BYD Seal</h1>
            <p></p>
            <div class="buttons" style="padding-top: 300px">
                <a href="#" class="btn">Order Now</a>
                <a href="#" class="btn">Learn More</a>
            </div>
        </div>
    </section>

    <section class="hero">
        <img src="./assets/section-dolphin-2.jpg" alt="BYD Hero" class="hero-image">
        <div class="hero-text" style="margin-top: 100px;">
            <h1>BYD Dolphin</h1>
            <p></p>
            <div class="buttons" style="padding-top: 300px;">
                <a href="#" class="btn">Order Now</a>
                <a href="#" class="btn">Learn More</a>
            </div>
        </div>
    </section>

    <section class="hero">
        <img src="./assets/home-m6.jpg" alt="Home M6" class="hero-image">
        <div class="hero-text" style="margin-top: 100px;">
            <h1>BYD M6</h1>
            <p></p>
            <div class="buttons" style="padding-top: 300px;">
                <a href="#" class="btn">Order Now</a>
                <a href="#" class="btn">Learn More</a>
            </div>
        </div>
    </section>

    <section class="hero">
        <img src="./assets/section-atto3-c.jpg" alt="BYD Hero" class="hero-image">
        <div class="hero-text" style="margin-top: 100px;">
            <h1>BYD Atto 3</h1>
            <p></p>
            <div class="buttons" style="padding-top: 300px;">
                <a href="#" class="btn">Order Now</a>
                <a href="#" class="btn">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <!-- Kebijakan -->
           
            <!-- Media Sosial -->
            <div class="footer-social">
                <span>IKUTI KAMI</span>
                <a href="https://www.facebook.com/bydcompany/?locale=id_ID"><img src="assets/facebook.png" alt="Facebook"></a>
                <a href="https://www.instagram.com/byd_indonesia/?utm_source=ig_web_button_share_sheet"><img src="assets/instagram (1).png" alt="Instagram"></a>
                <a href="https://youtube.com/@bydindonesia?si=J70U8roivP5adkSP"><img src="assets/youtube.png" alt="YouTube"></a>
                <a href="https://www.tiktok.com/@byd_indonesia?is_from_webapp=1&sender_device=pc"><img src="assets/tik-tok.png" alt="TikTok"></a>
            </div>
        </div>
        <!-- Hak Cipta -->
        <div class="footer-bottom">
            <hr>
            <p>PT BYD Motor Indonesia. Hak cipta dilindungi undang-undang.</p>
        </div>
    </footer>
    <script>
        function confirmLogout() {
            // Konfirmasi sebelum logout
            if (confirm("Yakin ingin logout?")) {
                window.location.href = "logout.php"; 
            }
        }
    </script>

    <script src="script.js"></script>
</body>
</html>


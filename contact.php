<?php
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
        <div class="navbar">
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

    <!-- Hero Section -->
    <section class="hero">
        <img src="./assets/contact-desktop.jpg" alt="BYD Hero" class="hero-image"> 
        <div class="hero-text">
            <h1>Hubungi Kami</h1>
        </div>
    </section>

    <!-- Informasi Perusahaan -->
    <div class="contact-info">
        <h1>PT BYD Motor Indonesia</h1>
        <hr>
        <p>Autograph Tower Thamrin Nine, level 50th, Jl. M.H. Thamrin No.10, Kb. Melati, Kecamatan Tanah Abang, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10230</p>
        <p>Hotline: <strong>08001686868</strong></p>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <!-- Kebijakan -->
            <div class="footer-links">
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Ketentuan Penggunaan</a>
                <a href="#">Kuki</a>
            </div>
            <!-- Media Sosial -->
            <div class="footer-social">
                <span>IKUTI KAMI</span>
                <a href="#"><img src="./assets/facebook.png" alt="Facebook"></a>
                <a href="#"><img src="./assets/instagram (1).png" alt="Instagram"></a>
                <a href="#"><img src="./assets/youtube.png" alt="YouTube"></a>
                <a href="#"><img src="./assets/tik-tok.png" alt="TikTok"></a>
            </div>
        </div>
        <!-- Hak Cipta -->
        <div class="footer-bottom">
            <hr>
            <p>PT BYD Motor Indonesia. Hak cipta dilindungi undang-undang.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>

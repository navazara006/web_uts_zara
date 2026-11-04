<?php
session_start();

if (!isset($_SESSION['session_login'])) {
    header('Location: login.php');
    exit;
}

require 'function.php';

// =========================================
// =============== PAGINATION ==============
// =========================================

// Jumlah data yang ditampilkan per halaman
$jumlahDataPerHalaman = 3;

// Hitung jumlah keseluruhan data yang ada di tabel
$jumlahData = count(query_db("SELECT * FROM menu"));

// Hitung jumlah halaman
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

// Halaman aktif
$halamanAktif = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;

// Menentukan awal data
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

// Ambil data menu berdasarkan pagination
$menu = query_db("SELECT * FROM menu LIMIT $awalData, $jumlahDataPerHalaman");

if(isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];
    $menu = cari_data($keyword);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu - Dapur Razka</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>

<body class="page-index">

    <div class="navbar">
        <div class="navbar-brand">
            <h3>DAPUR RAZKA</h3>
        </div>

        <a href="logout.php" class="btn-logout">
            Logout
        </a>
    </div>

    <section id="beranda" class="hero-section container-fluid d-flex align-items-center justify-content-center text-center text-white">

        <div>
            <h1 class="fw-bold display-5 text-center">
                Selamat Datang di Dapur Razka
            </h1>
            <p class="lead">
                Nikmati cita rasa masakan Sunda rumahan, mulai dari nasi timbel, gepuk, dan pepes, ditemani es teh, jus segar, dan kue balok hangat.
                <br>Semua menu dimasak dadakan, jadi selalu hangat dan segar saat sampai di mejamu.
                <br> --- Masakan Rumahan, Rasa Kampung Halaman ---
            </p>
        </div>
    </section>

    <div class="top-bar mt-4">
        
        <!-- Searching -->
        <form action="" method="post" class="search-box ms-5">
            <input type="text" name="keyword" placeholder="Cari menu...">
            <button type="submit" name="cari" class="btn btn-primary btn-cari">
                Cari
            </button>
        </form>

        <!-- Tambah Data -->
        <a href="tambah_data.php" class="btn btn-tambah me-5">
            Tambah Menu
        </a>
    </div>

    <div class="container">
        <div class="row g-4">
            <?php foreach($menu as $data): ?>
                <div class="col-12 col-md-4">
                    <div class="card h-100 card-dapur">
                        <img src="img/<?= $data["gambar"]; ?>" class="card-img-top" alt="">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title">
                                <?= $data["nama_menu"]; ?>
                            </h4>
                            <h6 class="card-genre">
                                <?= $data["kategori"]; ?>
                            </h6>
                            <h6 class="card-tahun">
                                Rp <?= $data["harga"]; ?>
                            </h6>
                            <p class="card-text">
                                <?= $data["deskripsi"]; ?>
                            </p>
                            <div class="mt-auto">
                                <a href="edit_data.php?id=<?= $data["id"] ?>" class="btn btn-edit">
                                    Edit
                                </a>
                                <a href="hapus_data.php?id=<?= $data["id"] ?>" class="btn btn-hapus">
                                    Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <br>
    <br>

    <!-- ========================================= -->
    <!-- =============== PAGINATION ============== -->
    <!-- ========================================= -->

    <div class="pagination">

        <!-- PREVIOUS -->
        <?php if ($halamanAktif > 1 ): ?>
            <a href="?halaman=<?php echo $halamanAktif - 1; ?>" class="prev">
                &larr; Prev
            </a>
        <?php else: ?>
            <span class="pagination-disabled">
                &larr; Prev
            </span>
        <?php endif; ?>

        <!-- NOMOR HALAMAN -->
        <?php for($i=1; $i<=$jumlahHalaman; $i++): ?>
            <?php if($i == $halamanAktif): ?>
                <a href="?halaman=<?php echo $i; ?>" class="active">
                    <?php echo $i; ?>
                </a>
            <?php else: ?>
                <a href="?halaman=<?php echo $i; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endif; ?>
        <?php endfor; ?>

        <!-- NEXT -->
        <?php if($halamanAktif < $jumlahHalaman): ?>
            <a href="?halaman=<?php echo $halamanAktif + 1; ?>" class="next">
                Next &rarr;
            </a>
        <?php else: ?>
            <span class="pagination-disabled">
                Next &rarr;
            </span>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php
session_start();

if (!isset($_SESSION['session_login'])) {
    header('Location: login.php');
    exit;
}

require 'function.php';

$id = $_GET["id"];

$menu = query_db("SELECT * FROM menu WHERE id = $id")[0];

if(isset($_POST['submit'])) {

    if(edit_data($_POST) > 0) {
        echo "<script>
            alert('Data berhasil diubah');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diubah');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Menu</title>

    <link rel="stylesheet" href="style.css">
</head>

<body class="page-form form-background">
    <div class="container">
        <div class="form-card form-card-edit">
            <h3>Edit Data Menu</h3>

            <form action="" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?php echo $menu["id"] ?>">

                <div class="form-group">
                    <label for="nama_menu">Nama Menu</label>
                    <input type="text" name="nama_menu" value="<?php echo $menu["nama_menu"]; ?>">
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" value="<?php echo $menu["kategori"]; ?>">
                </div>

                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" value="<?php echo $menu["harga"]; ?>">
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="textarea" name="deskripsi" value="<?php echo $menu["deskripsi"]; ?>">
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" name="gambar">

                    <br>
                    <br>

                    <img src="img/<?php echo $menu["gambar"]; ?>" alt="" width="200" height="200">
                </div>

                <div class="button-group">
                    <button type="submit" name="submit" class="btn btn-tambah btn-submit">
                        Edit Data
                    </button>
                    <a href="index.php" class="btn btn-kembali btn-kembali-form">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</body>
</html>

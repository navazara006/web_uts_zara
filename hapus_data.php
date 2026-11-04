<?php
require 'function.php';

$id = (int) $_GET['id'];

if (hapus_data($id) > 0) {
    echo "<script>
            alert('Data berhasil dihapus');
            document.location.href = 'index.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            document.location.href = 'index.php';
          </script>";
}
?>

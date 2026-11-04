<!-- function -->

<?php 

    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "dapur_razka");

    function query_db($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while( $row = mysqli_fetch_assoc($result) ) {
            $rows[] = $row;
        }
        return $rows;
    }

function tambah_data($data) {
    global $conn;

    $nama_menu = $data["nama_menu"];
    $kategori = $data["kategori"];
    $harga = $data["harga"];
    $deskripsi = $data["deskripsi"];

    // Upload gambar
    $gambar = upload_gambar($nama_menu, $harga);
    if( !$gambar ){
        return false;
    }

    $query = "INSERT INTO menu(nama_menu, kategori, harga, deskripsi, gambar)
              VALUES('$nama_menu', '$kategori', '$harga', '$deskripsi', '$gambar')";
              
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapus_data($id) {
    global $conn;

    $query = "DELETE FROM menu WHERE id = $id";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit_data($data) {
    global $conn;

    $id = $data["id"];
    $nama_menu = $data["nama_menu"];
    $kategori = $data["kategori"];
    $harga = $data["harga"];
    $deskripsi = $data["deskripsi"];
    $gambar = upload_gambar($nama_menu, $harga);
    if( !$gambar ){
        return false;
    }

    $query = "UPDATE menu SET
                nama_menu = '$nama_menu',
                kategori = '$kategori',
                harga = '$harga',
                deskripsi = '$deskripsi',
                gambar = '$gambar'
                WHERE id = $id ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function cari_data($keyword) {
    global $conn;

    $keyword = mysqli_real_escape_string($conn, $keyword);

    $query = "SELECT * FROM menu WHERE
              nama_menu LIKE '%$keyword%' OR
              kategori LIKE '%$keyword%' OR
              harga LIKE '%$keyword%' OR
              deskripsi LIKE '%$keyword%'";

    return query_db($query);
}

// Fungsi untuk upload gambar
function upload_gambar($nim, $nama){

    // Setting file
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name']; //$tmpName berfungsi untuk menyinmpan nama file sementara

    // Cek apakah ada file yang diupload atau tidak oleh user saat mengisi form
    if($error === 4){
        echo "<script>
            alert('Kamu belum upload file, silakan upload file terlebih dahulu')
            </script>";
            return false;
    }

    // Cek lagi, apakah yang diupload oleh user itu filenya berupa gambar atau bukan
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
            alert('File yang kamu upload bukan berupa gambar')
            </script>";
            return false;
    }

    // Membuat aturan terkait ukuran file
    // Cek jika ukuran gambar atau file yang diinput terlalu besar atau tidak
    // Max fila --> 5 MB

    if($ukuranFile > 5000000){
        echo "<script>
            alert('File yang kamu upload ukurannya terlalu besar!')
            </script>";
            return false;
    }

    // Setelah melalui beberapa if, file yang diinput oleh user di form siap diupload
    $namaFileBaru = $nim . "_". $nama;
    $namaFileBaru .=  '.';
    $namaFileBaru .= $ekstensiGambar;

    // Menyimpan file yang diupload user kedalam folder 'img/'
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru; //Menghasilkan data $namaFileBaru

}

function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $konfirmasi_password = mysqli_real_escape_string($conn, $data["konfirmasi_password"]);

    // Cek username apabila sudah ada di database atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Username sudah terdaftar! Gunakan username lainnya');
        </script>";
        return false;
    }

    // Cek konfirmasi password
    if($password !== $konfirmasi_password) {
        echo "<script>
        alert('Konfirmasi password tidak sesuai');
        </script>";
        return false;
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO USER VALUES('', '$username', '$password')");
    return mysqli_affected_rows($conn);
}

?>
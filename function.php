<?php 
    function connectToDatabase() {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "cake";
    
        // Create a new MySQLi object
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        return $conn;
    }

    $connection = connectToDatabase();
    if (isset($_POST['add_produk'])) {
        // print_r($_POST);
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $harga_jual = $_POST['harga_jual'];
        $harga_beli = $_POST['harga_beli'];
        $stok = $_POST['stok'];
        $min_stok = $_POST['min_stok'];
        $deskripsi = $_POST['deskripsi'];
        $kategori_product = $_POST['kategori_product'];
    
        $result = insertProduk( $kode, $nama, $harga_jual, $harga_beli, $stok, $min_stok, $deskripsi, $kategori_product);
        if ($result) {
            header("Location: index.php");
            return true; 
        } else {
            echo("Insert gagal");
        }
    }else if (isset($_POST['add_pesanan'])) {
        $tanggal = $_POST['tanggal'];
    $nama_pemesan = $_POST['nama_pemesan'];
    $alamat_pemesan = $_POST['alamat_pemesan'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $jumlah_pesanan = $_POST['jumlah_pesanan'];
    $deskripsi = $_POST['deskripsi'];
    $product_id = $_POST['product_id'];

    $result = insertPesanan($tanggal, $nama_pemesan, $alamat_pemesan, $no_hp, $email, $jumlah_pesanan, $deskripsi, $product_id);
    if ($result) {
        header("Location: pemesanan.php");
        exit;
    } else {
        echo "Insert gagal";
    }
    }else if (isset($_POST['delete_produk'])){
        $id = $_POST['id'];
    
        $result = deleteProduk($id);
        if ($result) {
            header("Location: index.php");
            return true; 
        } else {
            echo("Delete gagal");
        }
    }
    else if (isset($_POST['delete_pesanan'])){
        $id = $_POST['id'];
    
        $result = deletePesanan($id);
        if ($result) {
            header("Location: pemesanan.php");
            return true; 
        } else {
            echo("Delete gagal");
        }
    }
    else if (isset($_POST['edit_produk'])){
        $id = $_POST['id'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $min_stok = $_POST['min_stok'];
    $deskripsi = $_POST['deskripsi'];
    $kategori_product = $_POST['kategori_product'];

    
        $result = updateProduk($id,$kode, $nama, $harga_jual, $harga_beli, $stok, $min_stok, $deskripsi, $kategori_product);
        if ($result) {
            header("Location: index.php");
            return true; 
        } else {
            echo("Update gagal");
        }
    }

    function getKategori() {
        global $connection;
        $sql = "SELECT * FROM kategori_produk";
        $result = $connection->query($sql);
    
        return $result;
    }

    function deleteProduk($id) {
        global $connection;
        $sql = "DELETE FROM produk WHERE id = $id";
    
        if ($connection->query($sql) === TRUE) {
            return true; 
        } else {
            echo(mysqli_error($connection) );
            return false; 
        }
    }
    function deletePesanan($id) {
        global $connection;
        $sql = "DELETE FROM pesanan WHERE id = $id";
    
        if ($connection->query($sql) === TRUE) {
            return true; 
        } else {
            echo(mysqli_error($connection) );
            return false; 
        }
    }
    
   
    function insertProduk( $kode, $nama, $harga_jual, $harga_beli, $stok, $min_stok, $deskripsi, $kategori_product) {
        global $connection;
        $sql = "INSERT INTO produk (id, kode, nama, harga_jual, harga_beli, stok, min_stok, deskripsi, kategori_product) VALUES (NULL, '$kode', '$nama', '$harga_jual', '$harga_beli', '$stok', '$min_stok', '$deskripsi', '$kategori_product')";
        if ($connection->query($sql) === TRUE) {
            return true; 
        } else {
            echo(mysqli_error($connection) );
            return false; 
        }
    }

    function insertPesanan($tanggal, $nama_pemesan, $alamat_pemesan, $no_hp, $email, $jumlah_pesanan, $deskripsi, $product_id) {
        global $connection;
    
        // Prepare the insert query
        $insertQuery = "INSERT INTO pesanan (tanggal, nama_pemesan, alamat_pemesan, no_hp, email, jumlah_pesanan, deskripsi, product_id) VALUES ('$tanggal', '$nama_pemesan', '$alamat_pemesan', '$no_hp', '$email', '$jumlah_pesanan', '$deskripsi', '$product_id')";
    
        // Execute the insert query
        if ($connection->query($insertQuery) === TRUE) {
            return true; // Insertion successful
        } else {
            echo(mysqli_error($connection) );
            return false; // Insertion failed
        }
    }
    

    function updateProduk($id, $kode, $nama, $harga_jual, $harga_beli, $stok, $min_stok, $deskripsi, $kategori_product) {
        global $connection;
        $updateQuery = "UPDATE produk SET kode='$kode', nama='$nama', harga_jual='$harga_jual', harga_beli='$harga_beli', stok='$stok', min_stok='$min_stok', deskripsi='$deskripsi', kategori_product='$kategori_product' WHERE id='$id'";
        if ($connection->query($updateQuery) === TRUE) {
            return true; // Update successful
        } else {
            echo(mysqli_error($connection));
            return false; // Update failed
        }
    }
    

    function getProduk() {
        global $connection;
    $sql = "SELECT produk.*, kategori_produk.name AS kategori FROM produk INNER JOIN kategori_produk ON produk.kategori_product = kategori_produk.id";
    $result = $connection->query($sql);
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

function getPesanan() {
    global $connection;
$sql = "SELECT pesanan.*, produk.nama AS product_name FROM pesanan INNER JOIN produk ON pesanan.product_id = produk.id";
$result = $connection->query($sql);
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
return $data;
}

    
                         
                            
    
    
    
    
    
    
?>
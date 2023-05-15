<?php
require "function.php";
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Levant'restaurant</title>
</head>

<body class="bg-secondary">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#">Levant</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">All Menus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pemesanan.php">Order</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center ">
            <h1 class="mt-4 mb-3">MENU</h1>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga Jual</th>
                    <th>Harga Beli</th>
                    <th>Stok</th>
                    <th>Min. Stok</th>
                    <th>Deskripsi</th>
                    <th>Kategori Product</th>
                    <th>Action</th>
                </tr>

                </thead>
                <tbody>
                <?php
$products = getProduk(); // Assuming you have a getProduk() function to fetch product data

foreach ($products as $produk) {
    echo '<tr>
        <td>' . $produk['kode'] . '</td>
        <td>' . $produk['nama'] . '</td>
        <td>' . $produk['harga_jual'] . '</td>
        <td>' . $produk['harga_beli'] . '</td>
        <td>' . $produk['stok'] . '</td>
        <td>' . $produk['min_stok'] . '</td>
        <td>' . $produk['deskripsi'] . '</td>
        <td>' . $produk['kategori'] . '</td>
        <td>
            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" onclick="setFormData(\'' . $produk['id'] . '\', \'' . $produk['kode'] . '\', \'' . $produk['nama'] . '\', \'' . $produk['harga_jual'] . '\', \'' . $produk['harga_beli'] . '\', \'' . $produk['stok'] . '\', \'' . $produk['min_stok'] . '\', \'' . $produk['deskripsi'] . '\', \'' . $produk['kategori_product'] . '\')">Edit</button>
            <form action="function.php" method="POST">
            <input type="hidden" name="id" value="\'' .$produk['id']. '\'">
            <button type="submit" name="delete_produk" class="btn btn-danger btn-sm">Delete</button>
        </form>
        </td>
    </tr>';
}
?>
                   
                    
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="function.php" method="POST" >
                    <div class="mb-3">
                    <input type="hidden" name="id" id="editid">
  <label for="editkode" class="form-label">Kode</label>
  <input type="text" name="kode" class="form-control" required id="editkode">
</div>
<div class="mb-3">
  <label for="editnama" class="form-label">Nama</label>
  <input type="text" name="nama" class="form-control" required id="editnama">
</div>
<div class="mb-3">
  <label for="editharga_beli" class="form-label">Harga Beli</label>
  <input type="number" name="harga_beli" class="form-control" required id="editharga_beli">
</div>
<div class="mb-3">
  <label for="editharga_jual" class="form-label">Harga Jual</label>
  <input type="number" name="harga_jual" class="form-control" required id="editharga_jual">
</div>
<div class="mb-3">
  <label for="editstok" class="form-label">Stok</label>
  <input type="number" name="stok" class="form-control" required id="editstok">
</div>
<div class="mb-3">
  <label for="editmin_stok" class="form-label">Min Stok</label>
  <input type="number" name="min_stok" class="form-control" required id="editmin_stok">
</div>
<div class="mb-3">
  <label for="editdeskripsi" class="form-label">Deskripsi</label>
  <textarea type="text" name="deskripsi" class="form-control" required id="editdeskripsi"></textarea>
</div>



                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" name="kategori_product" id="editkategori_product" required>
                                <?php
                                // Retrieve category data from the database
                                $categories = getKategori(); // Assuming you have a getCategories() function to fetch category data

                                // Loop through categories and generate options
                                foreach ($categories as $category) {
                                    echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Add more form fields as needed -->
                        <button type="submit" name="edit_produk" class="btn btn-danger">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Add Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="function.php" method="POST" name="add_produk">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" name="kode"  class="form-control" required id="kode">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama"class="form-control" required id="nama">
                        </div>
                        <div class="mb-3">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="number" name="harga_beli" class="form-control" required id="harga_beli">
                        </div>
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" name="harga_jual" class="form-control" required id="harga_jual">
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" required id="stok">
                        </div>
                        <div class="mb-3">
                            <label for="min_stok" class="form-label">Min Stok</label>
                            <input type="number" name="min_stok" class="form-control" required id="min_stok">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea type="text" name="deskripsi" class="form-control" required id="deskripsi"></textarea>
                        </div>


                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" name="kategori_product" required>
                                <?php
                                // Retrieve category data from the database
                                $categories = getKategori(); // Assuming you have a getCategories() function to fetch category data

                                // Loop through categories and generate options
                                foreach ($categories as $category) {
                                    echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Add more form fields as needed -->
                        <button type="submit" name="add_produk" class="btn btn-danger">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script>
        function setFormData(id, kode, nama, harga_jual, harga_beli, stok, min_stok, deskripsi, kategori_product) {
  document.getElementById('editid').value = id;
  document.getElementById('editkode').value = kode;
  document.getElementById('editnama').value = nama;
  document.getElementById('editharga_jual').value = harga_jual;
  document.getElementById('editharga_beli').value = harga_beli;
  document.getElementById('editstok').value = stok;
  document.getElementById('editmin_stok').value = min_stok;
  document.getElementById('editdeskripsi').value = deskripsi;
  document.getElementById('editkategori_product').value = kategori_product;
}
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
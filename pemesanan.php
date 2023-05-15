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
                        <a class="nav-link " aria-current="page" href="index.php">All Menus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="pemesanan.php">Order</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container bg-secondary">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mt-4 mb-3">MENU</h1>
        </div>


        <div style="overflow-x: auto; white-space: nowrap;">
        <?php
$products = getProduk(); // Assuming you have a getProduk() function to fetch product data

foreach ($products as $produk) {
    echo '<div class="card mb-4 me-3" style="display: inline-block;">
        <div class="card-body">
            <h5 class="card-title">' . $produk['nama'] . '</h5>
            <p class="card-text">Harga: Rp' . $produk['harga_jual'] . '</p>';

    // Check if the stock is 0
    if ($produk['stok'] == 0) {
        echo '<button type="button" class="btn btn-primary" disabled>Stok Habis</button>';
    } else {
        echo '<button type="button" class="btn btn-warning" onclick="setFormData(  \'' . $produk['id'] . '\',\'' . $produk['nama'] . '\', \'' . $produk['harga_jual'] . '\')" data-bs-toggle="modal" data-bs-target="#orderModal">Order Now</button>';
    }

    echo '</div></div>';
}

?>
           
        

        </div>


        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mt-4 mb-3">Pesanan List</h1>

        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Nama Pemesan</th>
                <th>Alamat Pemesan</th>
                <th>No. HP</th>
                <th>Email</th>
                <th>Jumlah Pesanan</th>
                <th>Deskripsi</th>
                <th>Produk</th>
                <th>Action</th>
            </tr>
                </thead>
                <tbody>

                <?php
$pesanan = getPesanan(); // Assuming you have a getPesanan() function to fetch pesanan data

foreach ($pesanan as $item) {
    echo '<tr>
        <td>' . $item['id'] . '</td>
        <td>' . $item['tanggal'] . '</td>
        <td>' . $item['nama_pemesan'] . '</td>
        <td>' . $item['alamat_pemesan'] . '</td>
        <td>' . $item['no_hp'] . '</td>
        <td>' . $item['email'] . '</td>
        <td>' . $item['jumlah_pesanan'] . '</td>
        <td>' . $item['deskripsi'] . '</td>
        <td>' . $item['product_name'] . '</td>
        <td>
            <form action="function.php" method="POST">
                <input type="hidden" name="id" value="' . $item['id'] . '">
                <button type="submit" name="delete_pesanan" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>';
}
?>

                </tbody>
            </table>
        </div>
        </>



        <!-- Order Modal -->
        <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">Place an Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-8">
                                <h5 id="selectedMenuItemTitle"></h5>
                                <p id="selectedMenuItemPrice"></p>
                            </div>
                        </div>
                        <form action="function.php" method="POST">
                            <input type="hidden" name="product_id" id="product_id">
                            <div class="mb-3">
                                <label for="orderDate" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" id="orderDate">
                            </div>
                            <div class="mb-3">
                                <label for="orderName" class="form-label">Name</label>
                                <input type="text" name="nama_pemesan"class="form-control" id="orderName">
                            </div>
                            <div class="mb-3">
                                <label for="orderAddress" class="form-label">Alamat</label>
                                <input type="text" name="alamat_pemesan" class="form-control" id="orderAddress">
                            </div>
                            <div class="mb-3">
                                <label for="orderPhone" class="form-label">Phone</label>
                                <input type="tel" name="no_hp" class="form-control" id="orderPhone">
                            </div>
                            <div class="mb-3">
                                <label for="orderEmail" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="orderEmail">
                            </div>
                            <div class="mb-3">
                                <label for="orderQuantity" class="form-label">Jumlah Pesanan</label>
                                <input type="number" name="jumlah_pesanan" class="form-control" id="orderQuantity" min="1">
                            </div>
                            <div class="mb-3">
                                <label for="orderNotes" class="form-label">Notes</label>
                                <textarea class="form-control" name="deskripsi" id="orderNotes" rows="3"></textarea>
                            </div>
                            <button type="submit" name="add_pesanan" class="btn btn-primary">Place Order</button>
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
        function setFormData(id,nama , harga) {
            
  document.getElementById('selectedMenuItemTitle').innerHTML = nama;
  document.getElementById('product_id').value = id;
  document.getElementById('selectedMenuItemPrice').innerHTML = `Harga Rp${harga}`;
    }
</script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
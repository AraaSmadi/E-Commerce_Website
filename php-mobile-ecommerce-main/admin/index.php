<?php 
//header include
// include_once ('../headfoot/header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
    
</head>

<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#" style = "margin-left: 3.8%;">
      Admin Dashboard
    </a>
  </div>
</nav>

    <div class="row row-cols-1 row-cols-md-3 g-4" style="margin: 15px;  margin-left: 80px;">
        <div class="col" style = "width: 450px; height: 350px;">
            <div class="card h-100">
                <img src="https://thumbs.dreamstime.com/b/admin-seal-print-corroded-texture-red-vector-rubber-text-unclean-title-placed-double-parallel-lines-scratched-122073406.jpg" class="card-img-top" style = "height: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Admin</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to</p>
                    <a href="./adminn/index.php" class="btn btn-success ">Edit Product</a>
                </div>
            </div>
        </div>
        <div class="col" style = "width: 450px; height: 350px;">
            <div class="card h-100">
                <img src="https://rietveld-ict.nl/wp-content/uploads/2014/01/users.png" class="card-img-top" style = "height: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to</p>
                    <a href="./users/index.php" class="btn btn-success">Edit Users</a>
                </div>
            </div>
        </div>
        <div class="col" style = "width: 450px; height: 350px;">
            <div class="card h-100">
                <img src="https://www.anandnair.com/.a/6a00d8341cbcd853ef0240a484b39f200d-600wi" class="card-img-top" style = "height: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Category</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to.</p>
                    <a href="./categories/index.php" class="btn btn-success">Edit Product</a>
                </div>
            </div>
        </div>
        <div class="col" style = "width: 450px; height: 375px;">
            <div class="card h-100">
                <img src="https://realbusiness.co.uk/wp-content/uploads/2015/02/media.caspianmedia.comimage97dd9a06edb37bc5c3ab75d27e1398b2-6350489d6aba5170ffba3c6780c7c7db9f8a94bc.jpg" class="card-img-top" style = "height: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Product</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                        additional content. This content is a little bit longer.</p>
                    <a href="./product/index.php" class="btn btn-success">Edit Product</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
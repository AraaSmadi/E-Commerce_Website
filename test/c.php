<?php
require "config.php";
session_start();
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>Title</title>
        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

        <!-- Slick -->
        <link type="text/css" rel="stylesheet" href="css/slick.css" />
        <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

        <!-- nouislider -->
        <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="css/font-awesome.min.css">

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
        <link rel="stylesheet" href="cart.css">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body>
        <!-- BREADCRUMB -->
        <div id="breadcrumb" class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="breadcrumb-header">CART</h3>
                        <ul class="breadcrumb-tree">
                            <li><a href="#">Home</a></li>
                            <li class="active">CART</li>
                        </ul>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /BREADCRUMB -->
        <!--  defining variables & Select-->
        <?php
    $user_f_id  = (isset($_POST['user_f_id ']) ? $_POST['user_f_id '] : '');
    $product_name = (isset($_POST['product_name']) ? $_POST['product_name'] : '');
    $product_price = (isset($_POST['product_price']) ? $_POST['product_price'] : '');
    $product_main_image     = (isset($_POST['product_main_image	']) ? $_POST['product_main_image'] : '');
    $product_quantity = (isset($_POST['product_quantity']) ? $_POST['product_quantity'] : '');
    $product_f_id = (isset($_POST['product_f_id']) ? $_POST['product_f_id'] : '');
    $cart_id = (isset($_POST['cart_id']) ? $_POST['cart_id'] : '');
    $total = (isset($_POST['total']) ? $_POST['total'] : '');
    $add = (isset($_GET['add']) ? $_GET['add'] : '');
    $shopping_cart = (isset($_GET['shopping_cart']) ? $_GET['shopping_cart'] : '');
    $grand_total = (isset($_POST['grand_total']) ? $_POST['grand_total'] : '');
    $coupon_text = (isset($_POST['coupon_text']) ? $_POST['coupon_text'] : '');
    $coupon_percent = (isset($_POST['coupon_percent']) ? $_POST['coupon_percent'] : '');
    $coupon_id = (isset($_POST['coupon_id']) ? $_POST['coupon_id'] : '');
    $sum= (isset($_SESSION['sum']) ? $_SESSION['sum'] : '');
    $grand_total = 0;
    $total = 0;
    $sum = 0;




    try {

        $statement = $pdoconnect->prepare("SELECT * FROM cart  JOIN products  ON (cart.product_f_id =products.product_id)");
        $statement->execute();
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOExeption $err) {
        echo $err->getMessage();
    }

    if (isset($_POST['cart_id']) && empty($_POST['cart_id'])) {
        echo 'Your shopping cart is empty.';
    }
    ?>
            <div class="section">
                <!-- container -->
                <div class="container">
                    <form action="edit.php" method="POST">
                        <p>MY Cart</p>

                        <table class="table table-bordered table-hover table-md h4" name="SHOPPING_CART">
                            <thead>
                                <tr style="background-color:#E4E7ED;">

                                    <th scope="col">Item name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Remove </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                    $attempt = $pdoconnect->query('SELECT * FROM cart');
                    $row =$attempt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                                <?php  if(empty($row)) :?>
                                <tr>
                                    <td colspan="6" style="text-align:center ;"> your cart is empty. </td>
                                </tr>
                                <?php endif;?>



                                <?php
                        if (isset($_GET['delete'])) {
                            $product_f_id = $_GET['delete'];
                            $sql = ("DELETE FROM `cart` WHERE  product_f_id =$product_f_id");
                            $stat = $pdoconnect->query($sql);
                        } ?>
                                    <?php $_SESSION['sum'] = $sum;
                        $_SESSION['grand_total'] = $grand_total; ?>
                                    <?php foreach ($products as $product) : ?>

                                    <tr>
                                        <td>
                                            <?php echo $product['product_name'] ?>
                                        </td>
                                        <td><img src="./image/<?php echo $product['product_main_image'] ?>" width="90px"></td>
                                        <td>
                                            <?php echo $product['product_price'] ?>
                                        </td>

                                        <td>
                                            <input type="number" name="update<?php echo $product['product_f_id'] ?>" style=" width: 50px;border:none" value="<?php echo $product['product_quantity']; ?>">
                                        </td>
                                        <td>
                                            <?php
                                        $total =   ($product['product_price'] * $product['product_quantity']);
                                        $grand_total += $total;
                                        ?>
                                                <h5 id="cart-total-price" style="font-size:18px">$
                                                    <?php echo  $total ?>
                                                </h5>
                                        </td>
                                        <!-- <?php var_dump($product)  ?> -->
                                        <td><button type="button" name="delete" class="btn btn-outline-secondary  btn-lg"> <a href="cart.php?delete=<?php echo $product['product_f_id'] ?>"><i class="fa fa-trash" aria-hidden="true" style="color: #660708;"></i></a></button></td>

                                    </tr>

                                    <?php endforeach ?>
                                    <tr>
                                        <?php
                                   $statement = $pdoconnect->prepare("SELECT * FROM coupons  ");
                                   $statement->execute();
                                  $coupons = $statement->fetchAll(PDO::FETCH_ASSOC);
                             ?>
                                            <td colspan="2"><button type="submit" name="back" class="btn btn-warning my-3 row3" style="  color: #fff; background-color:#660708 !important; border-color: #660708;"><a href="" style="text-decoration: none;color:white;">Continue shopping <i class="fas fa-shopping-cart"></i></a></button></td>
                                            <td></td>
                                            <td>
                                                <a href="cart.php?edit=<?php echo $product['product_f_id'] ?>">
                                                    <input type="submit" class="btn btn-primary mt-2 row3" name="edit" value="Update Cart" style="  color: #fff; background-color:#660708 !important; border-color: #660708;"></a>
                                            </td>
                                            <td>
                                                <h5 id="cart-total-price" style="font-size:20px" name="t">$
                                                    <?php echo $grand_total; ?> </h5>

                                            </td>

                                            <td>
                                                <button type="submit" name="out" class="btn btn-success my-3 mx-1 row3 " style="  color: #fff; background-color:#660708 !important; border-color: #660708;"><a href="attempt.php?out=<?php echo $product['user_f_id'] ?>" style="text-decoration: none;color:white;">Proceed to Checkout </a><i class="fas fa-shopping-cart"></i></button>
                                            </td>
                                    </tr>
                            </tbody>
                        </table>


                    </form>



                    <div class="row g-3 align-items-center" style="margin-left:5vw;">
                        <form action="" method="GET">
                            <div class="col-auto">

                                <input type="text" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline" placeholder="Add Coupon here" name="discount" value="" style="font-size:17px">
                            </div>

                            <!-- <?php foreach ($coupons as $coupon) : ?> -->
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success my-3 " style="  color: #fff; background-color:#660708 !important; border-color: #660708;font-size:15px;" name="apply">Apply Coupon</button>

                                <!-- <a href="cart.php?coupon=<?php echo $coupon['coupon_id'] ?>" style="text-decoration: none;color:white;font-size:17px"></a> -->


                            </div>
                            <!-- <?php break; ?>

                    <?php endforeach; ?> -->
                    </div>

                    </form>
                    <span id="passwordHelpInline" class="form-text " style="font-size: 20px;">   
      <?php

if (isset($_GET['apply'])) {
 
    if ($_GET['discount'] ===  'ahmad123') {

        $sum = $grand_total - ($grand_total * 20 / 100) ;
        echo 'Total Amount after discount :'. '$'.$sum;
    } else {
        echo 'invalid coupon';
        echo 'Total Amount :'.'$' . $sum = $grand_total;
    }
}
$_SESSION['sum']=$sum;

?>
    </span>
                </div>
            </div>

            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

    </html>
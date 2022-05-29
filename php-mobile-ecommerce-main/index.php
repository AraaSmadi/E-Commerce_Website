<?php
// session_start();
// $connection = mysqli_connect("localhost", "root", "", "ecommerce");

require_once("./header.php");

if (isset($_SESSION['refresh']) && $_SESSION['refresh'] == true) {
  echo "<script> Swal.fire('The Order Confirmed','It will be delivered within 3 to 5 working days <br><br> Thank you for your visit  ','success') </script>";
  unset($_SESSION['refresh']);
}

?>

<head>
  <style>
    .single-feature {
      transition: all 0.3s linear;
    }

    .single-feature:hover {
      transform: scale(1.1);
    }

    .swal2-select {
      display: none;
    }
    .single-feature {
    padding: 30px 15px;
    text-align: center;
    border: 1px solid #fff;
    margin-bottom: 50px;
    border-radius: 10px;
    /* background-color: #707bfb ; */
    background-color: rgb(112, 123, 251);
    color: white;
  }
  .single-feature h3 {
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    margin-top: 25px;
    color: white;
  }
    .single-product .product-img .p_icon {
  background: rgb(234, 237, 254,0.4);
  
}
.offer_area {
  background-image: url('image/store-pc.jpg');
  /* background-repeat: no-repeat; */
  /* background-size: cover; */
}

  </style>
</head>


<!--================Home Banner Area =================-->

<?php include_once ("./slider.php")?>;

<!--================End Home Banner Area =================-->







<!--================ Start category Area =================-->
<div class="">
<section style="margin-top:0 !important; margin-bottom:0 ; padding-top:60px; background:#ffffff" class="feature_product_area section_gap_bottom_custom container-fluid ">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="main_title">
          <h1><span style="color:#707bfb;">Top Category</span></h1>
          <p>Bring called seed first of third give itself now ment</p>
        </div>
      </div>
    </div>

    <div class="row">
      <?php
      //show all categories
      $query2 = "SELECT * FROM categories";
      $stmt2 = $pdo->prepare($query2);
      $stmt2->execute();
      // $select_category = mysqli_query($connection, $query);
      while ($category2 =  $stmt2->fetch()) {
        $category_id = $category2['category_id'];
        $category_name = $category2['category_name'];
        $category_img = $category2['category_img'];
      ?>

        <div class="col-lg-3 col-md-3">
          <div class="single-product">
            <div class="product-img">
              <img class="img-fluid w-100" src="./admin/categories/images/<?php echo $category_img ?>" style="height: 300px"alt="image" />
              <div class="p_icon">
              <a href="individual_category.php?c_id=<?php echo $category_id  ?>">
                <i class="fa-regular fa-eye" style="font-size:1.5em; "></i>
                </a>

              </div>
            </div>
            <div class="product-btm">
              <a href="#" class="d-block">
                <h4 class="text-center" style="font-size: 18px;"><?php echo "<strong>" . $category_name . "</strong>" ?></h4>
              </a>

            </div>
          </div>
        </div>

      <?php  } ?>
    </div>
  </div>

</section>
      </div>
<!--================ End category Area =================-->

<!-- Start feature Area -->
<section class=" my-5">
  <div class="container  ">
    <div class="row ">
      <div class="col-lg-3 col-md-6">
        <div class="single-feature ">
        <i class="fa-solid fa-dollar-sign" style="font-size:2.5em;"></i>
          <h3>Money back gurantee</h3>
          <p>Shall open divide a one</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="single-feature">
        <i class="fa-solid fa-truck" style="font-size:2.5em;"></i>
          <h3>Free Delivery</h3>
          <p>Shall open divide a one</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="single-feature">
        <i class="fa-regular fa-circle-question" style="font-size:2.5em;"></i>
          <h3>Alway support</h3>
          <p>Shall open divide a one</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="single-feature">
        <i class="fa-solid fa-money-check-dollar" style="font-size:2.5em;"></i>
          <h3>Secure payment</h3>
          <p>Shall open divide a one</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End feature Area -->

<!--================ Offer Area =================-->
<?php if( empty ($_SESSION['userLogin']))
{ ?>
<section class="offer_area my-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="offset-lg-4 col-lg-6 text-center">
        <div class="offer_content">
          <h3 class="text-uppercase mb-40 text-light">All Mobile’s Accessories</h3>
          <h2 class="text-uppercase text-light">20% off</h2>
          <div class="container" style = " text-align: center ">
  <button type="button" class="btn " data-toggle="modal" data-target="#discountModal"  style = " background-color: #707bfb; color :white;">
    Show Discount
  </button>
</div>

<div class="modal fade" id="discountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <div class="icon text-danger">
          <img src="image/grunge-limited.png" width="50%">
        </div>
        <div class="code" style="font-size: 19px;" >Please login <span style="color:brown;" >  <a href="login.php" class="btn btn-primary cart-btn-transform " data-abc="true" style="background-color: #717ce8;">Login</a></span></div><br><br>
      </div>

    </div>
  </div>
</div>
          <p class="text-light my-3">Limited Time Offer</p>
        </div>
      </div>
    </div>
  </div>
</section>


<?php } else { ?>
  <section class="offer_area my-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="offset-lg-4 col-lg-6 text-center">
        <div class="offer_content">
          <h3 class="text-uppercase mb-40 text-light">All Mobile’s Accessories</h3>
          <h2 class="text-uppercase text-light">20% off</h2>
          <div class="container" style = " text-align: center ">
  <button type="button" class="btn " data-toggle="modal" data-target="#discountModal"  style = " background-color: #707bfb; color :white;">
    Show Discount
  </button>
</div>

<div class="modal fade" id="discountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <div class="icon text-danger">
          <img src="image/grunge-limited.png" width="50%">
        </div>
        <div class="notice">
          <h4>Get 20% Discount</h4>
          <p>For the next 24 hours you can get any product at half-price.</p>

          <p>Use promo code 20-OFF at checkout.</p>
        </div>
        <div class="code" style="font-size: 19px;" >promo code :<span style="color:brown;" >  smart100</span></div><br><br>
      </div>

    </div>
  </div>
</div>
    
          <p class="text-light my-3">Limited Time Offer</p>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>
<!--================ End Offer Area =================-->

<!--================ Feature Product Area =================-->

<section style="margin-top:0 !important; margin-bottom:0 ; padding-top:60px" class="feature_product_area section_gap_bottom_custom bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="main_title">
          <h1><span style="color:#707bfb;">Featured product</span></h1>
          <p>Bring called seed first of third give itself now ment</p>
        </div>
      </div>
    </div>

    <div class="row">

      <?php
      //show featured products
      $sqlShowFeatured = "SELECT * FROM products LIMIT 6 ";
      $stmt = $pdo->prepare($sqlShowFeatured);
      $stmt->execute();
      while ($product = $stmt->fetch()) {
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_description = $product['product_description'];
        $product_price = $product['product_price'];
        // $product_price_on_sale = $product['product_price_on_sale'];
        $product_img = $product['product_m_img'];
        // $product_sale_status = $product['sale_status'];
        $category_id = $product['category_id'];
      ?>
        <div class="col-lg-4 col-md-4">
          <div class="single-product card pb-3">
            <div class="product-img">
              <img class="img-fluid" src="./admin/product/images/<?php echo $product_img ?>" style="height:200px" alt="image" />
              <!-- <img class="img-fluid w-100" src="./image/1920x665_1__60.jpg" alt="image" /> -->
              <div class="p_icon">
                <a href="single-product.php?id=<?php echo $product_id; ?>">
                <i class="fa-regular fa-eye" style="font-size:1.5em;"></i>
                </a>
                <!-- <a href=""> -->
                  <form method="POST" action="" class = "d-inline">
                    <input type="hidden" name="action" value="add_to_cart">
                    <input type="hidden" name="page" value="index">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="color" value="black">
                    <input type="hidden" name="pcid" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="ucid" value="<?php echo $_SESSION['userLogin'] ?>">
                    <input type="hidden" name="image" value="<?php echo $product_img ?>">
                    <input type="hidden" name="name" value="<?php echo $product_name ?>">
                    <input type="hidden" name="price" value="<?php echo $product_price ?>">
                    <input type="hidden" name="addlog" value="addalert">
                    <button type="submit" name="addlog" value="addalert"><i class="fa-solid fa-cart-arrow-down" style="font-size:1.5em;"></i></button>
                    
                  </form>

                  <!-- <a href="index.php?action=add_to_cart&page=index&quantity=1&size=25&pcid=<?php echo $product_id; ?>&ucid=<?php echo $_SESSION['userLogin'] ?>&image=<?php echo $product_img ?>&name=<?php echo $product_name ?>&price=<?php echo $product_price ?>&addlog=addalert"> -->
                    
                    <!-- </a> -->
                  </div>
                </div>
                <div class="product-btm text-center">
                  <a href="#" class="d-block">
                    <h4 style="font-size: 18px;"><?php echo "<strong>" . $product_name . "</strong>" ?></h4>
                    
                  </a>
                  <div class="mt-3">
                  <!-- <h6></h6> -->
                  <p class="h6"><?php echo substr($product_description,0,22) ?></p>
                </div>
                  <div class="mt-3">
                  <p class="h4"><?php echo $product_price . " JOD" ?></p>
                </div>
                </div>
              </div>
            </div>
            <?php  } ?>
            
          </div>
        </div>
      </section>
      
<!--================ End Feature Product Area =================-->


<!--================ start footer Area  =================-->
<?php include("./footer.php") ?>
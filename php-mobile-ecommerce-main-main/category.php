<?php
// session_start();
include("./header.php");

?>
<!--================Header Menu Area =================-->

<!--================Home Banner Area =================-->
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2>Shop Category</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="index.php">Home</a>
          <a href="category.php">Shop</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Category Product Area =================-->
<section class="cat_product_area section_gap my-5">
  <div class="container">
    <div class="row flex-row-reverse">
      <div class="col-lg-9">
        <div class="latest_product_inner">
          <div class="row">
            <?php
            $sqlProducts = "SELECT * FROM products ORDER BY product_price ASC LIMIT 9";
            $stmt = $pdo->prepare($sqlProducts);
            $stmt->execute();
            while ($product = $stmt->fetch()) {
              $product_id = $product['product_id'];
              $product_name = $product['product_name'];
              $product_description = $product['product_description'];
              $product_m_img = $product['product_m_img'];
              $product_price = $product['product_price'];
              
            ?>
            
              <div class="col-lg-4 col-md-6 my-5">
                <div class="single-product card pb-3">
                  <div class="product-img">
                    <a href="single-product.php?id=<?php echo $product_id; ?>">
                      <img class="card-img" src="./admin/product/images/<?php echo $product_m_img; ?>" style="height:200px" alt="" />
                    </a>
                    <div class="p_icon text-center">
                      <a href="single-product.php?id=<?php echo $product_id; ?>">
                      <i class="fa-regular fa-eye" style="font-size:1.5em; color :#707bfb;"></i>
                      </a>
                      <a href="#">
                      <i class="fa-regular fa-heart" style="font-size:1.5em; color :#707bfb;"></i>
                      </a>
                      <a href="category.php?&&action=add_to_cart&page=index&quantity=1&size=25&pcid=<?php echo $product_id ?>&ucid=<?php echo $_SESSION['userLogin'] ?>&image=<?php echo $product_m_img ?>&name=<?php echo $product_name ?>&price=<?php echo $product_price ?>">
                      <!-- <a href="category.php?action=add_to_cart&page=index&quantity=1&size=25&pcid=<?php echo $product_id; ?>&ucid=<?php echo $_SESSION['userLogin'] ?>"> -->
                      <i class="fa-solid fa-cart-arrow-down" style="font-size:1.5em; color :#707bfb;"></i>
                      </a>
                    </div>
                  </div>
                  <div class="product-btm text-center">
                    <a href="#" class="d-block">
                      <h4><?php echo $product_name ?></h4>
                    </a>
                    
                      <div class="mt-3">
                        <span class="mr-4"><?php echo $product_price . " JOD" ?></span>
                      </div>
                  </div>
                </div>
              </div>
              
            <?php    }  ?>
          </div>
          <nav aria-label="Page navigation example" class="mx-auto my-5">
            <ul class="pagination pg-blue justify-content-center">
              <li class="page-item"><a class="page-link">Previous</a></li>
              <li class="page-item"><a href="secondPage.php" class="page-link">1</a></li>
              <li class="page-item"><a href="secondPage.php" class="page-link">2</a></li>
              <li class="page-item"><a href="thirdPage.php" class="page-link">3</a></li>
              <li class="page-item"><a class="page-link">Next</a></li>
            </ul>
          </nav>

        </div>
      </div>

      <!-- ===============SIDE BAR ===================== -->
      <?php include("./sidebar.php") ?>
    </div>
  </div>
</section>
<!--================End Category Product Area =================-->

<!--================ start footer Area  =================-->
<?php include("./footer.php") ?>
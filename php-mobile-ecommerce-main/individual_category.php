<?php

include("./header.php");
?>
<!--================Header Menu Area =================-->
<?php if (isset($_GET['c_id'])) {
  $c_id = $_GET['c_id'];
  // global $connection;
} ?>
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
          <a href="category.php">Home</a>
          <a href="category.php">Shop</a>
          <?php
          $query = "SELECT * FROM categories WHERE category_id = {$c_id}";
          $cat_query = $pdo->query($query);
          while ($category = $cat_query->fetch()) {
            $category_name = $category['category_name'];
            $category_id = $category['category_id'];
          ?>
            <a href="individual_category.php?c_id=<?php echo $category_id ?>"><?php echo $category_name ?> </a>

          <?php } ?>

        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Category Product Area =================-->
<section class="cat_product_area section_gap">
  <div class="container">
    <div class="row flex-row-reverse">
      <div class="col-lg-9">
        <!-- <div class="product_top_bar">
          <div class="left_dorp">
            <select class="sorting">
              <option value="1">Default sorting</option>
              <option value="2">Default sorting 01</option>
              <option value="4">Default sorting 02</option>
            </select>
            <select class="show">
              <option value="1">Show 12</option>
              <option value="2">Show 14</option>
              <option value="4">Show 16</option>
            </select>
          </div>
        </div> -->

        <div class="latest_product_inner">
          <div class="row">
            <?php

            // global $connection;
            $query = "SELECT * FROM products WHERE category_id = {$c_id}";
            $productcat = $pdo->query($query);
            while ($category = $productcat->fetch()) {

              $product_id = $category['product_id'];
              $product_name = $category['product_name'];
              $product_description = $category['product_description'];
              $product_m_img = $category['product_m_img'];
              $product_price = $category['product_price'];
              // $product_price_on_sale = $row['product_price_on_sale'];
              // $sale_status = $row['sale_status'];
            ?>
              <div class="col-lg-4 col-md-6 ">
                <div class="single-product card pb-3">
                  <div class="product-img">
                    <a href="single-product.php?id=<?php echo $product_id; ?>">
                      <img class="card-img" src="./admin/product/images/<?php echo $product_m_img ?>" style="height:200px" alt="" />
                    </a>
                    <div class="p_icon text-center">
                      <a href="single-product.php?id=<?php echo $product_id; ?>">
                      <i class="fa-regular fa-eye" style="font-size:1.5em;"></i>
                      </a>
                      <form method="POST" action="" class = "d-inline">
                    <input type="hidden" name="c_id" value="<?php echo $c_id; ?>">
                    <input type="hidden" name="action" value="add_to_cart">
                    <input type="hidden" name="page" value="index">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="color" value="black">
                    <input type="hidden" name="pcid" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="ucid" value="<?php echo $_SESSION['userLogin'] ?>">
                    <input type="hidden" name="image" value="<?php echo $product_m_img ?>">
                    <input type="hidden" name="name" value="<?php echo $product_name ?>">
                    <input type="hidden" name="price" value="<?php echo $product_price ?>">
                    <input type="hidden" name="addlog" value="addalert">
                    <button type="submit" name="addlog" value="addalert"><i class="fa-solid fa-cart-arrow-down" style="font-size:1.5em;"></i></button>
                    
                  </form>
                 
                          
                    </div>
                  </div>
                  <div class="product-btm text-center">
                    <a href="#" class="d-block">
                      <h4><?php echo $product_name ?></h4>
                    </a>
                  </div>
                  <div class="product-btm text-center">
                    <a href="#" class="d-block">
                      <h4>
                          <div class="mt-3">
                            <span class=""><?php echo $product_price . " JOD" ?></span>
                          </div>
                        
                      </h4>
                    </a>
                  </div>
                </div>
              </div>
            <?php    }  ?>
          </div>

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
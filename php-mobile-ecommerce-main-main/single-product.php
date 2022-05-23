<?php
// session_start();
// $connection = mysqli_connect("localhost", "root", "", "ecommerce");
require_once("./header.php");
?>
<?php 
  if (isset($_GET['comment'])) {
    if (isset($_SESSION['userLogin'])) {
        $user_id = $_GET['uid'];
        $prodcut_id = $_GET['pid'];
        $comment_content = $_GET['message'];
      $sqlInserComment = "INSERT INTO comments (user_id,prodcut_id,comment_content,comment_date) 
      VALUES ('$user_id','$prodcut_id','$comment_content',NOW())";
      $stmt = $pdo->query($sqlInserComment);
      // $stmt->execute([$user_id,$prodcut_id,$comment_content]);
  
      
      // $id = $_GET['id'];
      // header("location: single-product.php?id={$id}");
    } else {
      echo "<script>alert('You must be logged in')</script>";
    }
  }
?>

<!--================Home Banner Area =================-->
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2>Product Details</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="./index.php">Home</a>
          <a href="./category.php">Product Details</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Single Product Area =================-->

<?php
if ($_GET['id']) {
  $p_id =  $_GET['id'];
}
// global $connection;
$sqlSelectProduct = "SELECT * FROM products WHERE product_id = ? ";
$stmt = $pdo->prepare($sqlSelectProduct);
$stmt->execute([$p_id]);
// $single_product_query = mysqli_query($connection, $query);
if (!$stmt->execute([$p_id])) {
  echo "NO";
}
?>
<div class="product_image_area">
  <div class="container">
    <div class="row s_product_inner">
      <div class="col-lg-6">
        <div class="s_product_img">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                <?php
                while ($product = $stmt->fetch()) {
                  $product_id = $product['product_id'];
                  $product_name = $product['product_name'];
                  $product_description = $product['product_description'];
                  // $product_sub1_img = $product['product_sub1_img'];
                  // $product_sub2_img = $product['product_sub2_img'];
                  // $product_sub3_img = $product['product_sub3_img'];
                  $product_m_img = $product['product_m_img'];
                  $product_price = $product['product_price'];
                  // $product_price_on_sale = $product['product_price_on_sale'];
                  // $sale_status = $product['sale_status'];
                  $product_size = $product['product_sizes'];
                ?>
                  <!-- <img class="img-responsive" width="100%" src="./logo.jpg" alt="" /> -->
                  <!-- <img class="img-responsive" width="100%" src="image/<?php echo $product_m_img ?>" alt="" /> -->
              </li>
              <!-- <li data-target="#carouselExampleIndicators" data-slide-to="1">
                <img class="img-responsive" width="100%" src="image/<?php echo $product_sub1_img ?>" alt="" />
              </li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2">
                <img class="img-responsive" width="100%" src="image/<?php echo $product_sub2_img ?>" alt="" />
              </li> -->
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="./image/<?php echo $product_m_img; ?>"  alt="First slide" />
                <!-- <img class="d-block w-100" src="image/<?php echo $product_m_img  ?>" alt="First slide" /> -->
              </div>
              <!-- <div class="carousel-item">
                <img class="d-block w-100" src="image/<?php echo $product_sub1_img ?>" alt="Second slide" />
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="image/<?php echo $product_sub2_img ?>" alt="Third slide" />
              </div> -->
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5 offset-lg-1">
        <div class="s_product_text">
          <h3><?php echo $product_name ?></h3>

          <!-- <h2 class="d-inline"> <?php
                                if ($sale_status == "on") { ?>
              <div class="mt-3">
                <span class="mr-4"><?php echo $product_price . " JOD" ?></span>
                <del><?php echo $product_price_on_sale . " JOD" ?></del>
              </div>
            <?php } else { ?>
              <div class="mt-3">
                <span class="mr-4"><?php echo $product_price . " JOD" ?></span>
              </div>
            <?php } ?>
          </h2> -->
          <ul class="list">
            <?php

                  $sqlJoinProducts = "SELECT * FROM products INNER JOIN categories 
                        ON products.category_id = categories.category_name ";
                        $stmt = $pdo->prepare($sqlJoinProducts);
                        $stmt->execute();
                  // $category_query = mysqli_query($connection, $query);

                  while ($category = $stmt->fetch()) {
                    $category_name = $category['category_name'];
                    $category_id = $category['category_id'];

            ?>
              <li>
                <a class="active" href="#">
                  <span>Category</span> : <?php echo $category_name ?></a>
              </li>
            <?php } ?>

            <!-- <li>
              <a href="#"> <span>Availibility</span> : In Stock</a>
            </li> -->
          </ul>
          <p>
            <?php echo $product_description ?>
          </p>
          <form action="" method="get">
            <div class="product_count">
              <label for="sst"  style="color:#707bfb;fontsize">Quantity:</label><br />
              <input type="number" name="quantity"  id="sst" min="1" value="1" title="Quantity:" class="form-control" />
              <input type="hidden" name="pcid" value="<?php echo $product_id; ?>">
              <input type="hidden" name="ucid" value="<?php echo $_SESSION['userLogin'] ?>">
              <input type="hidden" name="image" value="<?php echo $product_m_img ?>">
              <input type="hidden" name="name" value="<?php echo $product_name ?>">
              <input type="hidden" name="price" value="<?php echo $product_price = $product['product_price'] ?>">
               <!-- <a href="index.php?action=add_to_cart&page=index&quantity=1&size=25&pcid=<?php echo $product_id; ?>&ucid=<?php echo $_SESSION['userLogin'] ?>&image=<?php echo $product_img ?>&name=<?php echo $product_name ?>&price=<?php echo $product_price ?>"> -->
              <input type="hidden" name="action" value="add_to_cart">

              <!-- <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                <i class="lnr lnr-chevron-up"></i>
              </button>
              <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">
                <i class="lnr lnr-chevron-down"></i>
              </button> -->
            </div>
            <br>
            <input type="hidden" name="id" value="<?php echo $p_id ?>">
            <label for ="size" style="color:#707bfb;fontsize">Size</lable>
            <select name="size" id ="size" class="form-select w-50 mr-3 text-dark" aria-label="Default select example">


              <?php

                  $sizes =   explode(',', $product_size);
                  foreach ($sizes as $key => $value) {

              ?>
                <option  value="<?php echo $value; ?>" ><?php echo $value; ?> </option>


              <?php } ?>

            </select>
            
            <div class="card_area">
              <button class="myBtn" type="submit"><a class="main_btn my-3">Add to cart</a></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
<section class="product_description_area" style="padding-bottom: 0px">
  <div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">Comments</a>
      </li>

    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
        <p>
          <?php echo $product_description; ?>
        </p>
      </div>
      <?php

      $sqlJoinComments = "SELECT * FROM comments INNER JOIN users 
              ON comments.user_id = users.user_id ";
              $stmt = $pdo->prepare($sqlJoinComments);
              $stmt->execute();
      // $comments_query = mysqli_query($connection, $query);

      while ($comment = $stmt->fetch()) {
        $comment_id = $comment['id'];
        $user_id = $comment['user_id'];
        $product_id = $comment['prodcut_id'];
        $comment_date = $comment['comment_date'];
        $comment_content = $comment['comment_content'];
        $user_name = $comment['user_name'];
        $user_img = $comment['user_img'];
      } ?>
      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <div class="row">
          <div class="col-lg-6">
            <div class="comment_list">
              <?php
              // NEW
              $query = "SELECT * FROM comments INNER JOIN users 
                      ON (comments.user_id = users.user_id) WHERE prodcut_id = ? ";
                      $stmt = $pdo->prepare($query);
                      $stmt->execute([$_GET['id']]);
              // $comments_query = mysqli_query($connection, $query);

              while ($comment = $stmt->fetch()) {
                $comment_id = $comment['id'];
                $user_id = $comment['user_id'];
                $product_id = $comment['prodcut_id'];
                $comment_date = $comment['comment_date'];
                $comment_content = $comment['comment_content'];
                $user_name = $comment['user_name'];
                $user_img = $comment['user_img'];
                // $comment_status = $comment['comment_status'];
              ?>
                <div class="review_item">
                  <div class="media">
                    <div class="d-inline mr-3">
                      <img width="75px" class="rounded-circle" src="image/<?php echo $user_img; ?>" alt="" />
                    </div>
                    <div class="media-body">
                      <h4><?php echo $user_name ?></h4>
                      <h5><?php echo $comment_date ?></h5>
                      <p class="">
                        <em class="">
                          <?php echo  $comment_content; ?>
                        </em>
                      </p>
                    </div>
                  </div>
                </div>
                <hr style="background-color:#707bfb">

              <?php }
              if (isset($_SESSION['userLogin'])) { ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea class="form-control" name="message" id="message" rows="3" placeholder="Add your comment" value=""></textarea>
                      <input type="hidden" name="id" value="<?php echo $p_id ?>">
                      <input type="hidden" name="pid" value="<?php echo $p_id ?>">
                      <input type="hidden" name="uid" value="<?php echo $_SESSION['userLogin'] ?>">
                    </div>
                  </div>
                  <div class="col-md-12 text-right">
                    <button type="submit" name="comment" class="btn submit_btn">
                      Submit Now
                    </button>
                  </div>
                </form>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>







  <!--================End Product Description Area =================-->

  <!--================ start footer Area  =================-->
  <?php include("./footer.php") ?>
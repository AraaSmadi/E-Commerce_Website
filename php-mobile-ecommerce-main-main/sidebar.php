<?php
$sqlSelectcategories = "SELECT * FROM categories";
$stmt = $pdo->prepare($sqlSelectcategories);
$stmt->execute();
// $product_query = mysqli_query($connection, $query);
?>
<div class="col-lg-3">
  <div class="left_sidebar_area">
    <aside class="left_widgets p_filter_widgets">
      <div class="l_w_title">
        <h3>Browse Categories</h3>
      </div>
      <div class="widgets_inner">
        <ul class="list">
          <?php
          while ($category = $stmt->fetch()) {
            $category_id = $category['category_id'];
            $category_name = $category['category_name'];

          ?>
            <li>
              <a href="individual_category.php?c_id=<?php echo $category_id  ?>"><?php echo $category_name ?></a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </aside>
  </div>
</div>
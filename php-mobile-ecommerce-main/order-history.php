<?php require_once ('./header.php') ?>
<?php

 if(isset($_POST['historysubmit'])) {
    $id = $_SESSION['userLogin'];
    // $order_date = $_POST['orderDate'];
    $order_date = $_POST['order_date'];
    // SELECT * FROM users JOIN users_cart ON users.user_id = users_cart.user_id WHERE users.user_id = $id;
    // SELECT * FROM orders JOIN order_history ON orders.order_id = order_history.order_id WHERE orders.user_id = $id ;
    
      $sql = "SELECT order_total_amount, order_date,phone_number,order_address, product_name,quantity,sub_total FROM order_history JOIN orders ON order_history.order_id = orders.order_id JOIN products ON order_history.product_id = products.product_id WHERE orders.user_id = $id AND order_date = '$order_date' ;";
      $stat = $pdo->query($sql);
      $order = $stat->fetchAll();
      $order_total_amount = $order[0]['order_total_amount'];
      $orderDate = $order[0]['order_date'];
      $coun = $stat->rowCount();
  if ($coun === 0 ){
  echo '<div class="container-fluid  mt-100">
  <div class="row">
  
  <div class="col-md-12">
  
  <div class="card">
    <div class="card-header">
        <h5>Cart</h5>
    </div>
    <div class="card-body cart">
        <div class="col-sm-12 empty-cart-cls text-center">
            <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3">
            <h3><strong>Your order is Empty</strong></h3>
            <h4>Add order to make me happy:)</h4>
            <a href="#" class="btn btn-primary cart-btn-transform m-3" data-abc="true" style="background-color: #717ce8;">continue shopping</a>
  
  
        </div>
    </div>
  </div>
  
  
  </div>
  
  </div>
  
  </div>';
  }else {
       ?>
  <div class="container">
          <h3>Your order</h3>
          <br>
          <table class="table table-striped table-hover border border-secoundry">
              <thead>
                  <tr>
                      <!-- <th scope="col">Name </th> -->
                      <!-- <th scope="col">Order Date</th> -->
                      <th scope="col">Address</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Product Name</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Sub Total</th>
                  </tr>
              </thead>
              <tbody>
                     <?php
               
                foreach($order as $value):
                 
  
                  ?>
                  
                      <tr scope="row">
                      <!-- <td> <?php  echo  $value['order_total_amount']; ?></td> -->
                          <!-- <td> <?php  echo  $value['order_date'] ; ?></td> -->
                          <td><?php echo   $value['order_address']; ?></td>
                          <td> <?php  echo '(+962)'.$value['phone_number'] ; ?></td>
                          <td><?php echo   $value['product_name']; ?></td>
                          <td><?php echo   $value['quantity']; ?></td>
                          <td><?php echo   $value['sub_total']." JOD"; ?></td>
                            
                      </tr>     <?php
                     endforeach;
                  }}?>
                  
                  <tr scope="row" >
                      
                      <p class="h3 text-dark"><?php echo  "Order Total Amount : $order_total_amount JOD"; ?></p>
                     </tr> 
                  <tr scope="row" >
                      
                      <p class="h5"><?php echo "Order Date : $orderDate"; ?></p>
                     </tr> 
              </tbody>
            </table>
  </div>

  <?php include_once ('./footer.php') ?>
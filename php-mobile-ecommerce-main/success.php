<?php require './header.php';?>




<!-- <img src = "images/order.png" width = "30%" class=" mx-auto d-block" > -->
    <div class="container">
        <div class="alert alert-success" role="alert">
        <i style='font-size:24px' class='fas'>&#xf14a;</i> Thank you. Your order has been received.
    </div>
    <img src = "image/received.png" width = "200px" class=" mx-auto d-block" >
 
        <h3>Your order</h3>
        <br>
        <table class="table  table-hover">
            <thead>
                <tr>
                    <th scope="col">Name </th>
                    <th scope="col">Email</th>
                    <th scope="col">Address </th>
                    <th scope="col">Phone</th>
                    <th scope="col">Totel</th>
                </tr>
            </thead>
            <tbody>
                <?php
              try {
                $id = $_SESSION['userLogin'];
                // SELECT * FROM orders  JOIN users ON orders.user_id = users.user_id WHERE orders.user_id = $id ;
                $sql = "SELECT * FROM orders  JOIN users WHERE orders.user_id = $id   AND users.user_id = $id;";
                $stat = $pdo->query($sql);
                $order = $stat->fetchAll();
                }
                catch (PDOException $e){
                  echo "Faild"  . $e->getMessage() . "<br/>";
                 
                }
                ?>
                     <?php
               
               foreach($order as $value):
                
 
                 ?>
                 
                     <tr scope="row">
                     <td> <?php  echo  $value['user_name']; ?></td>
                         <td> <?php  echo  $value['user_email'] ; ?></td>
                         <td><?php echo   $value['order_address']; ?></td>
                         <td> <?php  echo '(+962)'.$value['phone_number'] ; ?></td>
                         <td><?php echo   $value['order_total_amount']; ?></td>
                           
                     </tr>     <?php
                    endforeach;
                 ?></tbody> </table>
                    
            </div>
                    
                    <?php require './footer.php';?>

                    
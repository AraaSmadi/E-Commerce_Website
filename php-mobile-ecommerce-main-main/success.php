<?php require './header.php'; ?>

<div class="container">
    <div class="alert alert-success" role="alert">
        <i style='font-size:24px' class='fas'>&#xf14a;</i> Thank you. Your order has been received.
    </div>
    <img src="image/received.png" width="200px" class=" mx-auto d-block">

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
                $sql = "SELECT * FROM orders  JOIN users WHERE orders.user_id = $id   AND users.user_id = $id;";
                $stat = $pdo->query($sql);
                $order = $stat->fetchAll();
                $count = ($stat->rowCount() - 1);
            } catch (PDOException $e) {
                echo "Faild"  . $e->getMessage() . "<br/>";
            }
            ?>
            <tr scope="row">
                <td> <?php echo  $order[$count]['user_name']; ?></td>
                <td> <?php echo  $order[$count]['user_email']; ?></td>
                <td><?php echo   $order[$count]['order_address']; ?></td>
                <td> <?php echo '(+962)' . $order[$count]['phone_number']; ?></td>
                <td><?php echo   $order[$count]['order_total_amount']; ?></td>
            </tr>
        </tbody>
    </table>

</div>


<?php require './footer.php'

?>
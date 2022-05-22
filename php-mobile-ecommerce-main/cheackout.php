


    <?php
    require_once ("./header.php");
 
    try {
        $id = $_SESSION['userLogin'];
        // $user = $_SESSION['userLogin'];
        $query = "SELECT * FROM users JOIN users_cart ON users.user_id = users_cart.user_id WHERE users.user_id = $id;";
        // $query = "SELECT * FROM users WHERE user_id = 11;";
        $stat = $pdo->query($query);
        // $stat->execute([$user]);
        $orders = $stat->fetch();
        // print_r($orders);
    } catch (PDOException $err) {
        echo $err->getMessage();
    }

    if (isset($_POST['checkbtn'])) {
        $state = check($_POST['U-name'], $_POST['email'], $_POST['phone']);
        try {
            
            $id = $_SESSION['userLogin'];
            $sql = "INSERT INTO orders (user_id, order_total_amount,product_quantity, phone_number ,order_address) VALUES
            (:id, :total, :quantity, :phone, :address);";
            $stat = $pdo->prepare($sql);
            $stat->execute([':id' => $id, ':total' => $_SESSION['totel'], ':quantity' => $_SESSION['q'], ':phone' => $_POST['phone'], ':address' => $_POST['Address']]);
            
            // $sql2 = "ALTER TABLE users_cart  DELETE WHERE user_id = ? ;";
            $sql2 = "DELETE FROM users_cart WHERE user_id = ? ;";
            $statement = $pdo->prepare($sql2);
            $statement->execute([$id]);
           echo "<script> window.location.href ='success.php'</script>";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
       
    }
    ?>
    <br><br>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3" style="color: #717ce8;">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill"></span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">
                            </h6>
                            <small class="text-muted">Quantity:</small>
                        </div>
                        <span class="text-muted"><?php echo $_SESSION['q']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total :<?php echo $_SESSION['totel']; ?>$</span> 
                    </li>
                </ul>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">
                            </h6>
                            <small class="text-muted">Your personal data will be used to process your order , support your experience throughout this website. and for other purposes described in our privecy policy.</small>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3" style="color:  #717ce8;">Billing Details</h4><br>
                <form class="needs-validation"  method="POST">
                    <div class="mb-3">
                        <label for="Item">User Name :</label>
                        <input type="text" class="form-control" name="U-name" required value="<?php echo  $orders['user_name'] ?>">
                        <span class="error" style="color:red;"><?php echo $errors[0] ?? "" ?></span>
                    </div>
                    <div>
                    </div>
                    <div class="mb-3">
                        <label for="Image">Email :</label>
                        <input type="text" class="form-control" name="email" required value="<?php echo  $orders['user_email'] ?>">
                        <span class="error" style="color:red;"><?php echo $errors[1] ?? "" ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="Price">Address :</label>
                        <input type="text" class="form-control" name="Address" required value="<?php echo  $orders['user_address'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="Image">Phone :</label>
                        <input type="text" class="form-control" name="phone" required value="<?php echo  $orders['user_phone'] ?>">
                        <span class="error" style="color:red;"><?php echo $errors[2] ?? "" ?></span>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3" style="color:  #717ce8;">Payment</h4>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="cashOnDelivery" name="cashOnDelivery" type="radio" class="custom-control-input" checked="">
                            <label class="custom-control-label" for="cashOnDelivery">Cash on Delivery</label>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <input class="btn btn-primary btn-lg btn-block" type="submit" name="checkbtn" value="Continue to checkout" style="background-color:  #717ce8;  color: white; border: none; ">
                </form>
            </div>
        </div>
    </div>
    <?php
    function check($name, $email, $phone)
    {
        global $errors;
        $regexName      = "/^[A-z ]{3,}$/";
        $regexPhone      = "/^((\+*)((0[ -]*)*|((91 )*))((\d{12})+|(\d{10})+))|\d{5}([- ]*)\d{6}$/";
        $regexEmail     = "/^[A-z0-9._-]+@(hotmail|gmail|yahoo).com$/";
        $state = true;
        // Validation
        if (empty($name) || trim($name) == "") {
            $errors[0] = "This field is required";
            $state     = false;
        } else if (!preg_match($regexName, $name)) {
            $errors[0] = "This field is not correct, only letters are allowed";
            $state     = false;
        }
        if (empty($email) || trim($email) == "") {
            $errors[1] = "This field is required";
            $state     = false;
        } else if (!preg_match($regexEmail, $email)) {
            $errors[1] = "This field is not correct";
            $state     = false;
        }
        if (empty($phone) || trim($phone) == "") {
            $errors[2] = "This field is required";
            $state     = false;
        } else if (!preg_match($regexPhone, $phone)) {
            $errors[2] = "This field is not correct, enter a valid phone number";
            $state     = false;
        }
        return $state;
    }
    ?>
<?php require './footer.php';
?>
    
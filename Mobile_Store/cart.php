<?php require 'config.php';
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<head>
    <title>Cart</title>
</head>
<body >
<?php 
try {
$stat = $con->prepare ("SELECT * FROM users_cart WHERE 	user_id =2 ;");
$stat->execute();
$cart = $stat->fetchAll();
$coun = $stat->rowCount();
if ($coun === 0 ){
  echo '    <div class="container  mt-100">
  <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <h5>Cart</h5>
              </div>
              <div class="card-body cart">
                  <div class="col-sm-12 empty-cart-cls text-center">
                      <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3">
                      <h3><strong>Your Cart is Empty</strong></h3>
                      <h4>Add something to make me happy :)</h4>
                      <a href="#" class="btn btn-primary cart-btn-transform m-3" data-abc="true" style="background-color: #717ce8;">continue shopping</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>';
}else {
?>
<div class= "container" >
<div class="card-header">
<h1  style=" color : #9da3fb;  font:bold;"> Cart : </h1></div>
  <table class="table">
  <thead>
    <tr>
    <th scope="col"></th>
    <th scope="col">Image</th>
    <th scope="col">Item Name</th>
    <th scope="col">Quantity</th>
    <th scope="col">Sub Price</th>
    </tr>
  </thead>
  <tbody>

<?php
$Qu = 0 ;
$totel = 0 ;
$sub_price= 0 ;
foreach ($cart  as $value) :
?>
<tr scope='col'>
<td>
<form  method="post" style=" color: #f4b7b4;">
<input type="hidden"  name="ID" value ="<?php echo $value['product_id']; ?>">
<button type="submit" name ="delete" style="background-color: white; border : none;" ><i class='far fa-times-circle' style='font-size:24px ; padding-top : 40px; color:gray;'></i></button>
</td>
<td  ><img src = "images/<?php echo $value['Product_image']; ?>" width = "90px"></td>
<td style='padding-top : 50px;'><?php echo $value['Product_name']; ?></td> 
<td  style='padding-top : 50px;'><input type="number" name="q" style=" width: 50px" value="<?php echo $value['quantity'];
$Qu+=$value['quantity'];?>"> </td> 
<td  style='padding-top : 50px;'><label name ="price"> <?php   $sub_price =$value['quantity'] * $value['sub_total'] ; echo $sub_price; 
$totel += $sub_price; ?></label></td>
</tr> 
<?php
endforeach ;
?>

<tr scope='col' >
<td colspan="5"  style=" padding:2% 0;">
<input type="text" name="copone" style="  height: 30px" placeholder="Coupon code">
<input type="submit" class="btn btn-primary" name="couponbtn" value="Applay coupon" style="background-color: #717ce8;  color: white; border: none;">
<input type="submit" class="btn btn-primary" name="Update" value="Update Cart" style="background-color:  #717ce8;  color: white; border: none; ">
</form>
</td>
</tr>
<tr >
<td > <h3> Cart totels </h3></td></tr>
<tr >
<td colspan="2">
<h5> Totel : <?php echo $totel . '$'; ?>
</h5>
</td>
</tr>
<tr >
<td colspan="2">
<h5> Coupon : <?php if(isset($_POST['couponbtn'])){
    $copone_name =$_POST['copone'];
    if ($copone_name === "smart100"){
      echo  'smart100 -'. ( $totel *20/ 100) . '$ from total price';
    }else {
      echo $totel  . '$ invalid coupon';
    }
    
    } ?></h5>
</td>
</tr>
<tr >
<td colspan="2">
<h5> Totel after discount : 
  <?php if(isset($_POST['couponbtn'])){
    $copone_name =$_POST['copone'];
    if ($copone_name === "smart100"){
      $totel = $totel - ( $totel * 20/ 100) ;
      echo $totel.'$';
    }else {
      echo $totel  . '$ invalid coupon';
    }
    
    } ?></h5>
</td>
</tr>
</tbody>
</table> 
<form  method="post" style=" color: #f4b7b4;">
<div class="col-md-12 text-right">
<a href="#" class="btn btn-primary cart-btn-transform " data-abc="true" style="background-color: #717ce8;">continue shopping <i class='fas fa-cart-arrow-down'></i></a>
<a href="cheackout.php" class="btn btn-primary cart-btn-transform " data-abc="true" style="background-color: #717ce8;">Proceed to checkout</a>
</div>
</form>
</div>
<?php 
if(isset($_POST['delete'])){
  
  try{
  $product_id =$_POST['ID'];
  $sql="DELETE FROM `users_cart` WHERE product_id =  $product_id ";
  $stat=$con->query($sql);
  header('location:cart.php');
}
catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
finally {
    $con = NULL;
}
  }
$_SESSION['totel']= $totel ;

$_SESSION['q']= $Qu ;

  if(isset($_POST['Update'])){
    try{
    $quantity =$_POST['q'];
    $product_id =$_POST['ID'];
    $sql="UPDATE `users_cart` SET `quantity` = '$quantity' WHERE product_id = $product_id ";
    $stat=$con->query($sql);
    $price =$_POST['price']  ;
    $_POST['price'] = $price * $quantity;
    $value['sub_total'] =  $sub_price;
    header('location:cart.php');
  }
  catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
  }
  finally {
      $con = NULL;
  }
    } 
?>
<?php } }
catch (PDOException $e){
  echo "Faild"  . $e->getMessage() . "<br/>";
 
}?>
</body>
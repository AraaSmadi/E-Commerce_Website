<?php require './header.php';
?>

<?php 
try {
  if (isset($_SESSION['userLogin']) ){
    $stat = $pdo->prepare ("SELECT * FROM users_cart WHERE 	user_id =?;");
$stat->execute([$_SESSION['userLogin']]);
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
<form action ="#"  method="post" style=" color: #f4b7b4;">
<input type="hidden"  name="ID" value ="<?php echo $value['product_id']; ?>">
<button type="submit" name ="delete" style="background-color: white; border : none;" ><i style='font-size:20px ;color:red;margin-top:20px;' class='far'>&#xf2ed;</i></button>
</form></td>
<td  ><img src = "./admin/product/images/<?php echo $value['Product_image']; ?>" width = "90px"></td>
<td style='padding-top : 50px;'><?php echo $value['Product_name']; ?></td> 
<td  style='padding-top : 50px;'><form action ="#"  method="post" style=" color: #f4b7b4;"><input type="hidden"  name="ID" value ="<?php echo $value['product_id']; ?>"><input type="number" name="q" min ="1" style=" width: 50px" value="<?php echo $value['quantity'];
$Qu+=$value['quantity'];?>">  <input type="submit" class="btn btn-primary" name="Update" value="Update Cart" style="background-color:  #717ce8;  color: white; border: none; "></td> 
<td  style='padding-top : 50px;'><input type ='hidden' name ="priceid" value ="<?php   $sub_price =$value['quantity'] * $value['sub_total'] ; echo $sub_price ?>" > 
<label><?php $totel += $sub_price ; 
echo $sub_price ;?></label>
</form></td>
</tr> 
<?php
endforeach ;
?>

<tr scope='col' >
<td colspan="5"  style=" padding:2% 0;">
<form action ="#"  method="post" style=" color: #f4b7b4;">
<input type="text" name="copone" style="  height: 30px" placeholder="Coupon code">
<input type="submit" class="btn btn-primary" name="couponbtn" value="Applay coupon" style="background-color: #717ce8;  color: white; border: none;">
<!-- <input type="submit" class="btn btn-primary" name="Update" value="Update Cart" style="background-color:  #717ce8;  color: white; border: none; "> -->
</form>
</td>
</tr>
<tr >
<td > <h3> Cart Totals </h3></td></tr>
<tr >
<td colspan="2">
<h5> Total : <?php echo $totel . '$'; ?>
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
<h5> Total after discount : 
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
<a href="./category.php" class="btn btn-primary cart-btn-transform " data-abc="true" style="background-color: #717ce8;">continue shopping <i class='fas fa-cart-arrow-down'></i></a>
<a href="cheackout.php" class="btn btn-primary cart-btn-transform " data-abc="true" style="background-color: #717ce8;">Proceed to checkout</a>
</div>
</form>
</div>
<?php 
if(isset($_POST['delete'])){
  
  try{
  $product_id =$_POST['ID'];
  $sql="DELETE FROM `users_cart` WHERE product_id =  $product_id ";
  $stat=$pdo->query($sql);
  echo "<script> window.location.href ='cart.php'</script>";
}
catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
finally {
    $pdo = NULL;
}
  }
$_SESSION['totel']= $totel ;

$_SESSION['q']= $Qu ;

if(isset($_POST['q'])){
  try{
  $quantity =$_POST['q'];
  $product_id =$_POST['ID'];
  $sql="UPDATE `users_cart` SET `quantity` = '$quantity' WHERE product_id = $product_id ";
  $stat=$pdo->query($sql);
  $price =$_POST['priceid']  ;
  $_POST['price'] = $price * $quantity;
  $value['sub_total'] =  $sub_price;

  echo "<script> window.location.href ='cart.php'</script>";
}
catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
finally {
    $pdo = NULL;
}
  } 
?>
<?php }} }
catch (PDOException $e){
  echo "Faild"  . $e->getMessage() . "<br/>";
 
}?>

<?php require './footer.php';
?>
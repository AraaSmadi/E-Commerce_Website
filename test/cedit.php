<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
var_dump($_POST);
}else{

    echo'problem';
}
require"config.php"; 


try {

    $statement = $pdoconnect->prepare("SELECT * FROM cart");
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOExeption $err) {
    echo $err->getMessage();
}
foreach($products as $product){
echo "<br>";
var_dump($product);
echo $product["product_f_id"];
echo $_POST["update".$product["product_f_id"]];
$id= $product["product_f_id"];
 $products=$pdoconnect->prepare("UPDATE cart SET product_quantity=:county
                                               WHERE product_f_id=$id");
 
 $products->bindValue(':county',$_POST["update".$product["product_f_id"]]);
 $products->execute();
}

header("location:cart.php");

?>
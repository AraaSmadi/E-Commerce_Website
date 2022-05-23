<?php
 require_once ("./connect.php");


session_start();
// session_destroy();
 

// For Logout
if (isset($_GET['status']) && $_GET['status'] == 'logout') {
  unset($_SESSION['userLogin']);
  unset($_SESSION['adminLogin']);
//   unset($_SESSION['shopping_cart']);
  header("Location: index.php");
}

// For Comments
// if (isset($_GET['comment'])) {
//   if (isset($_SESSION['userLogin'])) {
//       $user_id = $_SESSION['userLogin'];
//       $prodcut_id = $_GET['id'];
//       $comment_content = $_GET['message'];
//     $sqlInserComment = "INSERT INTO comments (user_id,prodcut_id,comment_content,comment_date) 
//     VALUES ($user_id,$prodcut_id,'$comment_content',NOW())";
//     $stmt = $pdo->query($sqlInserComment);
//     // $stmt->execute([$user_id,$prodcut_id,$comment_content]);

    
//     $id = $_GET['id'];
//     header("location: single-product.php?id={$id}");
//   } else {
//     echo "<script>alert('You must be logged in')</script>";
//   }
// }

// For Add To Cart
if (isset($_GET["action"]) && $_GET["action"] == "add_to_cart") {

  $userCart_id = $_GET['ucid'];
  $prodcutCart_id = $_GET['pcid'];
  $prodcutQuantity = $_GET['quantity'];
  $sub_total = $_GET['price'];
  $Product_image = $_GET['image'];
  $Product_name = $_GET['name'];
  $insertIntoCart = "INSERT INTO users_cart (user_id, product_id, quantity, sub_total, Product_image, Product_name) VALUES (?,?,?,?,?,?)";
  $stmt = $pdo->prepare($insertIntoCart);
  $stmt->execute([$userCart_id, $prodcutCart_id, $prodcutQuantity, $sub_total, $Product_image, $Product_name]);
  // header('location:index.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Mini-E-commerce Site">
  <title>Mini-E-commerce Site</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="Welcome-Page.css">

  
<!-- <!DOCTYPE html>
<html lang="en">

<head> -->
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>Eiser ecommerce</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./css/bootstraps.css" />
  <link rel="stylesheet" href="./css/font-awesome.mins.css" />
  <link rel="stylesheet" href="./css/themify-iconss.css" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <!-- main css -->
  <link rel="stylesheet" href="./css/styless.css" />
<style>
    :root {
  --mainColor: #eaedfe;
  --mediumColor: #9da3fb; /#8b22e2/
  --lightColor: #c1c3fc;
  --button-color: #717ce8;
}
* {
  font-family: 'Heebo', sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  scroll-behavior: smooth;
}
body {
  background-color: #f8f9fa;
}
header { 
  background-color: #eaedfe;
}
  .header_area{
      
    background-color:#eaedfe !important;
}
    i.ti {
      cursor: pointer;
    }

    .myBtn {
      border: none;
      background: transparent;
    }

    .myBtn a {
      color: white !important;
    }

    .myBtn a:hover {
      color: black !important;
    }

    .mylinks>li,
    .mylinks>p {
      transition: 0.3s all ease;
    }

    .mylinks>li:hover,
    .mylinks>p:hover {
      color: white;
    }

    [class^="ti-"] {
      font-size: 20px;
    }

    .cont {
      display: flex;
    }

    @media (max-width:500px) {
      .cont {
        margin-top: 10px;
      }

      .cont>li:nth-of-type(1) {
        margin-left: 0;
      }
    }
  .searchTerm{
      border-color: transparent;
      border-radius: 5px;
  }
  
  h6 {
    color: white;
  }
  .cartCounter {
    /* color: green; */
    position: relative;
    top: -10px;
  }
  /* .qty {
    width: 85px;
    height: 40px;
  } */
  </style>

</head>


<body>
  <!--================Header Menu Area =================-->
  <header class="" >
    <div class="">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light w-100 d-flex justify-content-between">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="./index.php">
              
            <img src="./image/logo2.png" style=" width: 90px ;" alt="" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <!-- <span class="icon-bar"></span>
            <span class="icon-bar"></span> -->
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset w-100 " id="navbarSupportedContent">
            <div class="row  mr-0">
              <div class="col-lg-7 pr-0 ">
                <ul class="nav navbar-nav d-flex justify-content-end align-items-center ">
                  <li class="nav-item active">
                    <a class="nav-link  " href="index.php">Home</a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link  " href="./about.php">About </a>
                  </li>
                  <!-- <li class="nav-item ">
                    <a class="nav-link  " href="index.php">Contact </a>
                  </li> -->
                  
                  <li class="nav-item submenu dropdown">

                    <a href="category.php" class="nav-link dropdown-toggle " id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu rounded-3 border border-primary" aria-labelledby="navbarDropdown">
                      <li class="dropdown-item">
                        <a class="nav-link" href="category.php">All Categories</a>
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <?php
                      $sqlSelectcategories   = "SELECT * FROM categories";
                      $stmt1 = $pdo->prepare($sqlSelectcategories);
                      $stmt1->execute();
                      while ($category1 =  $stmt1->fetch() ) {
                        $category_id = $category1['category_id'];
                        $category_name = $category1['category_name'];
                      ?>
                        <li class=" dropdown-item">
                          <a class="nav-link" href="individual_category.php?c_id=<?php echo $category_id; ?>"><?php echo $category_name ?></a>
                        </li>
                        <!-- <li><hr class="dropdown-divider"></li> -->
                      <?php } ?>

                    </ul>
                  </li>
                  <?php
                  if (isset($_SESSION['userLogin']) || isset($_SESSION['adminLogin'])) { ?>
                    <li class="nav-item">
                      <a class="nav-link mylink  " href="index.php?status=logout">Logout</a>
                    </li>
                  <?php
                  } else { ?>
                    <li class="nav-item">
                      <a class="nav-link mylink  " href="login.php">Login</a>
                    </li>
                  <?php } ?>
                  <?php
                  if (isset($_SESSION['adminLogin'])) { ?>
                    <li class="nav-item">
                      <a class="nav-link  " href="./admin/index.php">Admin</a>
                    </li>
                  <?php } ?>
                </ul>
              </div>

              <div class="col-lg-5 pr-0 d-flex justify-content-center align-items-center ">
                <ul class="nav navbar-nav navbar-right right_nav pull-right">
                  <div class="h-25  header-search my-auto d-flex justify-content-center">
                    <form action="./search.php" method="POST">
                        <div class="input-group ">
                            <input type="text" name="search" placeholder="Search For Product" class="form-control" aria-label="Search For Product" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" name="submit" id="button-addon2"><i  class="fa fa-search text-white" aria-hidden="true" ></i></button>
                        </div>
                      <!-- <input class="px-2 py-1 searchTerm" name="search" type="text" placeholder="SEARCH">
                      <button class="myBtn" type="submit" name="submit" class="searchButton">
                      <i  class="fa fa-search " aria-hidden="true" style="cursor:pointer; color :#717ce8;"></i>
                      </button> -->
                    </form>
                  </div>
                  <div class="d-flex  justify-content-center align-items-center px-2 mt-2">
                    <li class="nav-item " style="padding-top: 3px;">
                      <a href="cart.php" class="icons">
                          <span class="cartCounter"><?php
                                            if (isset($_SESSION['userLogin'])) {
                                            $sqlCount = "SELECT * FROM users_cart WHERE user_id = ?";
                                            $stmt = $pdo->prepare($sqlCount);
                                            $stmt->execute([$_SESSION['userLogin']]);
                                            $cartCounter = $stmt->rowCount();
                                                        echo "$cartCounter";
                                                        }
                                                        ?>
                        </span>
                        <i class="fa fa-shopping-cart " style="font-size:1.5em; color :#707bfb;"></i>
                      </a>
                    </li>
                    <?php if (isset($_SESSION['userLogin'])) { ?>
                    <li class="nav-item" style="padding-top: 3px;">
                      <a href="./profile.php" class="icons">
                        <i class="fa-solid fa-user mx-2" style="font-size:1.5em; color :#707bfb;"></i>
                      </a>
                    </li>
                  <?php } ?>
                  </div>
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </header>
  <!--================Header Menu Area =================-->


  
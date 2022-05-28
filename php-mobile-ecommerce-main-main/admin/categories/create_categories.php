<?php 
include_once('../../connection/conn.php');
//header include
include_once('../../headfoot/header.php');



if($_SERVER['REQUEST_METHOD']=='POST'){
  if (!is_dir('images')) {
    mkdir('images');
}
    $category_name = $_POST['category_name'];


    $image = $_FILES['category_img'] ?? null;
    $imagePath = '';
    if ($image) {
        $imagePath = 'IMG-' . randomString(8) . $image['name'];
        move_uploaded_file($image['tmp_name'], "images/" . $imagePath);
        // move_uploaded_file($image['tmp_name'], $imagePath);
    }
    

    $statment = $pdo->prepare("INSERT INTO `categories` (`category_name`, `category_img`)
                              VALUES (:category_name, :image)");
    $statment->bindValue(':category_name', $category_name);
    $statment->bindValue(':image', $imagePath);
    $statment->execute();
    header("location: index.php");
    }



    
function randomString($n)
{
    $str = '';
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }
    return $str;
}

      

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add category</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
    integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
  </script>
</head>

<body>
  <section style="margin-left: 4%;">

    <form method="post" style="margin-left: 2%; margin-right: 2%" enctype="multipart/form-data">
      <h3>Add categories</h3>

      <div class="form-group">
        <label>category Name</label>
        <input type="text" class="form-control" name="category_name">
      </div>
      <div class="form-group">
        <label>category Image</label>
        <input type="file" class="form-control" name="category_img">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="./index.php" class="btn btn-primary">category Page</a>
    </form>

  </section>

</body>

</html>
<?php

//sidebar include 
include_once('../../headfoot/saidebar.php');

?>
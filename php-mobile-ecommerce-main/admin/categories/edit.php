<?php 
include_once('../../connection/conn.php');
//header include
include_once('../../headfoot/header.php');



$id = $_GET['id'] ?? null;
if(!$id) {
    header('location: index.php');
    exit;
}

$statment = $pdo->prepare('SELECT * FROM categories WHERE category_id = :id');
$statment->bindvalue(':id', $id);
$statment->execute();
$categories = $statment->fetchAll(PDO::FETCH_ASSOC);

    //print_r($categories);
    $category_name = $categories[0]['category_name'];
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if (!is_dir('images')) {
          mkdir('images');
      }
      
    $category_name = $_POST['category_name'];
      
      
          function imagePath()
        {
            global $imagePath;
            $image = $_FILES['image'] ?? null;
            
            $imagePath = $_POST["path"] ;
            if ($image && $image['tmp_name']) {
                $imagePath = 'IMG-' . uniqid() . "-" . $image['name'];
                move_uploaded_file($image['tmp_name'], "images/" . $imagePath);
            }
        }
        imagePath();
           
      
          $statment = $pdo->prepare("UPDATE `categories` SET `category_name` = :category_name, 
                                      `category_img` = :image WHERE category_id = :id");
          $statment->bindValue(':category_name', $category_name);
          $statment->bindValue(':image', $imagePath);
          $statment->bindValue(':id', $id);

          $statment->execute();
          header("location: index.php");
          }
      
      
      
          
function randomString($n) {
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
    <title>edit categories</title>
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

            <?php if ($categories[0]['category_img']): ?>
            <img src="./images/<?php echo $categories[0]['category_img']; ?>" style="width: 150px; height: 150px; display: block;">
            <?php endif ?>

            <div class="form-group">
                <label>category Name</label>
                <input type="text" class="form-control" name="category_name" value="<?php echo $categories[0]['category_name']; ?>">
            </div>
            <div class="form-group">
                <label>category Image</label>
                <input type="file" class="form-control" name="image" value="<?php echo $categories[0]['category_img']; ?>">
                <input type="hidden" class="form-control" name="path" value="<?php echo $categories[0]['category_img']; ?>">

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
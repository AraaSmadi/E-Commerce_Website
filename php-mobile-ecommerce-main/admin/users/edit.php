<?php 
include_once('../../connection/conn.php');
//header include
include_once('../../headfoot/header.php');



$id = $_GET['id'] ?? null;
if(!$id) {
    header('location: index.php');
    exit;
}

$statment = $pdo->prepare('SELECT * FROM users WHERE user_id = :id');
$statment->bindvalue(':id', $id);
$statment->execute();
$users = $statment->fetchAll(PDO::FETCH_ASSOC);

    //print_r($users);
    $user_name = $users[0]['user_name'];
    $user_email = $users[0]['user_email'];
    $user_password = $users[0]['user_password'];
    $user_address = $users[0]['user_address'];
    $user_phone = $users[0]['user_phone'];
    

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (!is_dir('images')) {
            mkdir('images');
        }
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $user_address = $_POST['user_address'];
        $user_phone = $_POST['user_phone'];
        
    
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
           
    $statment = $pdo->prepare ("UPDATE `users` SET `user_name` = :user_name, 
                               `user_email` = :user_email, 
                               `user_img`= :image, `user_password`= :user_password, `user_address` = :user_address , `user_phone` = :user_phone WHERE user_id = :id");

        
        $statment->bindValue(':user_name', $user_name);
        $statment->bindValue(':user_email', $user_email);
        $statment->bindValue(':image', $imagePath);
        $statment->bindValue(':user_password', $user_password);
        $statment->bindValue(':user_address', $user_address);
        $statment->bindValue(':user_phone', $user_phone);
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
  <title>edit user</title>
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

    <?php if ($users[0]['user_img']): ?>
          <img src="<?php echo $users[0]['user_img']; ?>" style="width: 150px; height: 150px; display: block;">
      <?php endif ?>
      <div class="form-group">
        <label>user Image</label>
        <input type="file" class="form-control" name="user_img" value = "<?php echo $users[0]['user_img']; ?>">
        <input type="hidden" class="form-control" name="path" value = "<?php echo $users[0]['user_img']; ?>">
      </div>
      <div class="form-group">
        <label>user name</label>
        <input type="text" class="form-control" name="user_name" value = "<?php echo $users[0]['user_name']; ?>">
      </div>
      <div class="form-group">
        <label>user email</label>
        <input type="email" class="form-control" name="user_email" value = "<?php echo $users[0]['user_email']; ?>">
      </div>
      <div class="form-group">
        <label>user password</label>
        <input type="password" class="form-control" name="user_password" value = "<?php echo $users[0]['user_password']; ?>">
      </div>
      <div class="form-group">
        <label>user address</label>
        <input type="text" class="form-control" name="user_address" value = "<?php echo $users[0]['user_address']; ?>">
      </div>
      <div class="form-group">
        <label>user phone</label>
        <input type="text" class="form-control" name="user_phone" value = "<?php echo $users[0]['user_phone']; ?>">
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
      <a href="./index.php" class="btn btn-primary">Users Page</a>

    </form>

  </section>

</body>

</html>
<?php

//sidebar include 
include_once('../../headfoot/saidebar.php');

?>
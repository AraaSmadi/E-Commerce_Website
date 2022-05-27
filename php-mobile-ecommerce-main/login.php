<?php
 $dbServerName = 'localhost';
 $dbUserName = 'root';
 $dbPassword = '';
 $dbName = 'mobile';
 // set DSN (Data Source Name) :string has the associated data structure to describe a connection to the data source.
 $dsn = "mysql:host=$dbServerName;dbname=$dbName";

 // create PDO instance
 $pdo = new PDO($dsn,$dbUserName,$dbPassword);
 $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

session_start();



$imagePath = "";
$errors = [];
// Validation Function
function check($name, $email, $pass, $confirmPassword, $address, $phone)
{
	global $errors;
	$regexName      = "/^[A-z ]{3,}$/";
	$regexPhone      = "/^((\+*)((0[ -]*)*|((91 )*))((\d{12})+|(\d{10})+))|\d{5}([- ]*)\d{6}$/";
	$regexEmail     = "/^[A-z0-9._-]+@(hotmail|gmail|yahoo).com$/";
	$regexPassword  = "/^(?=.*[A-Z])(?=.*[@$!%*#?&])(?=.*[a-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,}$/";
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
	if (empty($pass) || trim($pass) == "") {
		$errors[2] = "This field is required";
		$state     = false;
	} else if (!preg_match($regexPassword, $pass)) {
		$errors[2] = "The password is not correct, it must be at least 8 characters and must contains (upper case, lower case, numbers, special character, no spaces ";
		$state     = false;
	}
	if (empty($confirmPassword) || trim($confirmPassword) == "") {
		$errors[3] = "This field is required";
		$state     = false;
	} else if (!preg_match($regexPassword, $pass)) {
		$errors[3] = "The password are not match";
		$state     = false;
	}
	// if (empty($address) || trim($address) == "") {
	// 	$errors[5] = "This field is required";
	// 	$state     = false;
	// } else if (!preg_match($regexName, $address)) {
	// 	$errors[5] = "This field is not correct, only letters are allowed";
	// 	$state     = false;
	// }
	if (empty($phone) || trim($phone) == "") {
		$errors[6] = "This field is required";
		$state     = false;
	} else if (!preg_match($regexPhone, $phone)) {
		$errors[6] = "This field is not correct, enter a valid phone number";
		$state     = false;
	}
	return $state;
}

// To add image
function imagePath()
{
	global $imagePath;
	$image = $_FILES['image'] ?? null;
	
	$imagePath = "";
	if ($image && $image['tmp_name']) {
		$imagePath = 'IMG-' . uniqid() . "-" . $image['name'];
		move_uploaded_file($image['tmp_name'], "image/" . $imagePath);
	}
}

// Signup
if (isset($_POST['signupSubmit'])) {
	$state = check($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'], $_POST['address'], $_POST['phone']);
	if ($state == true) {
		// To add image
		imagePath();
		$user_name = $_POST['name'];
		$user_email = $_POST['email'];
		$user_password = $_POST['password'];
		$user_img = $imagePath;
		$user_address = $_POST['address'];
		$user_phone = $_POST['phone'];
		$sqlInsertUser= "INSERT INTO users (user_name, user_email, user_password, user_img, user_address, user_phone) VALUES (?,?,?,?,?,?)";
		$stmt = $pdo->prepare($sqlInsertUser);
		$stmtStatus = $stmt->execute([$user_name,$user_email,$user_password,$user_img,$user_address,$user_phone]);
		if ($stmtStatus) {
			$_POST = array();
			$_SESSION['stateSignUp'] = true;
			header("Location: login.php?status=done");
			die();
		} else {
			$errors[1] = "The account is used";
		}
	}
}

// Login
if (isset($_POST['loginSubmit'])) {
	if (trim($_POST['email']) == "" || trim($_POST['password'] == "")) {
		$errors[4] = "The email or password is not correct";
	} else {
		// For Users
		$user_email = $_POST['email'];
		$user_password = $_POST['password'];

		$sqlSelectUser  = "SELECT * FROM users where user_email = ? AND user_password = ? ;";
		$stmt = $pdo->prepare($sqlSelectUser);
		$stmt->execute([$user_email, $user_password]);
		$user = $stmt->fetchAll();
		$userCount = $stmt->rowCount();
		if ($userCount == 1) {
			$_SESSION['userLogin'] = $user[0]['user_id'];
			// echo $_SESSION['userLogin'];
			unset($_SESSION['adminLogin']);
			header("location:index.php");
			die();
		}
		$admin_email = $_POST['email'];
		$admin_password = $_POST['password'];
		$sqlSelectAdmin  = "SELECT * FROM admins where admin_email = ? AND admin_password = ? ;";
		$stmt = $pdo->prepare($sqlSelectAdmin);
		$stmt->execute([$admin_email, $admin_password]);
		$admin = $stmt->fetchAll();
		$adminCount = $stmt->rowCount();
		if ($adminCount == 1) {
			$_SESSION['adminLogin'] = $admin[0]['admin_id'];
			header("location:index.php");
			die();
		}
		$errors[4] = "The email or password is not correct";
	}
}

?>

<?php
// include_once ('./head.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Login | Page</title>
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
	<link rel="icon" href="./image/logo2.png" type="image/png" />
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" href="./css/login.css">
</head>

<body>
	<!-- <!DOCTYPE html>
	<html> -->

	
	<header>
        <a href="./index.php" class="logo"><img src="./image/logof.png" style=" width: 100px ;" alt="" /></a>
        <nav class="navbar">
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./category.php">Shop</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="about.php">Contact</a></li>
            </ul>
        </nav>
    </header>

	<!-- If the user add to cart without login -->
	<?php if (!isset($_SESSION['userLogin']) && isset($_GET['addlog']) && $_GET['addlog'] == 'addalert') { ?>
    <div style ="width: 370px ; padding: 10px; margin: 20px auto; color:#9966ff; background-color :#eaedfe; font-size : 2em; text-align: center; border-radius: 10px" >
      You Have to Login, To purchase the products !
    </div>
  <?php } ?>

	<section>
		<div class="main">
			<input type="checkbox" id="chk" aria-hidden="true">
			<div class="signup">
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
					<label for="chk" aria-hidden="true">Sign up</label><br />
					<?php if (isset($_GET['status']) && $_GET['status'] == 'done') { ?>
						<div class="alert alert-success" role="alert">
							Successfully Registered!
						</div>
					<?php	}					?>
					<div class="inputContainer">
						<input type="text" name="name" placeholder="Username" value="<?php echo $_POST['name'] ?? ""  ?>">
						<span class="error"><?php echo $errors[0] ?? "" ?></span>
					</div>
					<div class="inputContainer">
						<input type="text" name="email" placeholder="Email" value="<?php echo $_POST['email'] ?? ""  ?>">
						<span class="error"><?php echo $errors[1] ?? "" ?></span>
					</div>
					<div class="inputContainer">
						<input type="password" name="password" placeholder="Password">
						<span class="error"><?php echo $errors[2] ?? "" ?></span>
					</div>
					<div class="inputContainer">
						<input type="password" name="confirmPassword" placeholder="Confirm Password">
						<span class="error"><?php echo $errors[3] ?? "" ?></span>
					</div>
					<div class="inputContainer">
						<input type="text" name="address" placeholder="Address" value="<?php echo $_POST['address'] ?? ""  ?>">
						<span class="error"><?php echo $errors[5] ?? "" ?></span>
					</div>
					<div class="inputContainer">
						<input type="text" name="phone" placeholder="phone" value="<?php echo $_POST['phone'] ?? ""  ?>">
						<span class="error"><?php echo $errors[6] ?? "" ?></span>
					</div>
					<div class="inputContainer">
						<input class="form-control" type="file" name="image" id="formFile">
					</div>
					<button type="submit" name="signupSubmit">Sign up</button>
				</form>
			</div>
				
			<div class="login">
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
					<label for="chk" aria-hidden="true">Login</label>
					<div class="inputContainer">
						<input type="text" name="email" placeholder="Email">
					</div>
					<div class="inputContainer">
						<input type="password" name="password" placeholder="Password">
						<span class="error"><?php echo $errors[4] ?? "" ?></span>
					</div>
					<button type="submit" name="loginSubmit">Login</button>
				</form>
			</div>
			<!-- <img src="./97.png"> -->
		</div>
		
	</section>
	

</body>

</html>
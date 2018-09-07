<?php 
    $filepath = realpath(dirname(__FILE__)); 
    include '$filepath./../../lib/Session.php';
    Session::checkLogin();
?>
<?php 
    $filepath = realpath(dirname(__FILE__)); 
    include '$filepath./../../config/config.php';
    include '$filepath./../../lib/Database.php';
    include '$filepath./../../helpers/Format.php';
?>
<?php 
	$db = new Database();
	$format = new Format();
 ?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
<?php 

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name = $format->validation($_POST['name']);
		$password = $format->validation(md5($_POST['password']));

		$name = mysqli_real_escape_string($db->link, $name);
		$password = mysqli_real_escape_string($db->link, $password);

		$query = "select * from tbl_user where name = '$name' and password = '$password'";
		$result = $db->select($query);

		if ($result != false) {
				//$value = mysqli_fetch_array($result);
				$value = $result->fetch_assoc();
					Session::set("login", true);
					Session::set("Name", $value['name']);
					Session::set("username", $value['username']);
					Session::set("userId", $value['id']);
					Session::set("userRole", $value['role']);
					header("Location: index.php");
		}else{
			echo "<span style='color:red;'>Name or Password Does not mached!! </span>";
		}
	}
?>
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Enter Your Name" name="name"/>
			</div>
			<div>
				<input type="password" placeholder="Password" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="recoverpass.php">Forgot Password!</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Blog Website</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
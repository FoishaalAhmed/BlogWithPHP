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
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
<?php 

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$email = $format->validation($_POST['email']);
		$email = mysqli_real_escape_string($db->link, $email);

		if ($email == "") {
			echo "<span style='color:red; font-size: 18px;'>Field Must Not Be Empty!!</span>";
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "<span style='color:red; font-size: 18px;'>Email Address not Valid!!</span>";
            } else{
	            $query = "select * from tbl_user where email = '$email' limit 1";
	            $mailcheck = $db->select($query);
	            if ($mailcheck == true) {
	            	while ($value = $mailcheck->fetch_assoc()) {
	            		$userid   = $value['id'];
	            		$name     = $value['name'];
	            	}
		            $text        = substr($email, 0, 3);
		            $rand 		 = rand(1000, 9999);
		            $newpassword = "$text$rand";
		            $password    = md5($newpassword);
		            $query = "update tbl_user set password = '$password' where id = '$userid'";
	            	$update_password = $db->update($query);

	            	$to = '$email';
	            	$from = 'foisal@gmail.com';
	            	$headers = 'From: $from\n';
	            	$headers .= 'MINE-Versions: 1.0' . "\r\n";
	            	$headers .= 'Content-type: text/html; charset= iso-8859-1' . "\r\n";
	            	$subject = 'Your Password';
	            	$message = 'Your Nmae '.$name.'and Your Password '.$newpassword.'Please Visit Website';

	            	$sendmail = mail($to, $subject, $message, $headers);
	            	if ($sendmail) {
	            		echo "<span style='color:red; font-size: 18px;'>Email Send!!</span>";
	            	} else {
	            		echo "<span style='color:red; font-size: 18px;'>Email Does Not Send!!</span>";
	            	}
	            } else{
	            	echo "<span style='color:red; font-size: 18px;'>Email Does not exist!!</span>";
				}
			}
		}
?>
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Your Email" name="email"/>
			</div>
			<div>
				<input type="submit" value="Send" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Log In!</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
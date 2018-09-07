<?php include 'inc/header.php';?>


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php 
					if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						$name = $format->validation($_POST['name']);
						$email = $format->validation($_POST['email']);
						$body = $format->validation($_POST['body']);

						$name = mysqli_real_escape_string($db->link, $name);
						$email = mysqli_real_escape_string($db->link, $email);
						$body = mysqli_real_escape_string($db->link, $body);

						if($name == "" || $email == "" || $body == ""){
				            echo "<span style='color:red'>Field must not be empty!!</span>";
				        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				        	 echo "<span style='color:red'>Email Address not Valid!!</span>";
				        }else{
				        	$query = "INSERT INTO tbl_contact(name, email, body)  VALUES('$name', '$email', '$body')";
					        $inserted_rows = $db->insert($query);
					        if ($inserted_rows) {
					        echo "<span style='color:green'>Email Send Successfully!!</span>";
					        }else {
					        echo "<span style='color:red'>Email not Send!!</span>";
					            }
        					}
				        }
				?>
				<form action="" method="post">
					<table>
					<tr>
						<td>Your Name:</td>
						<td>
						<input type="text" name="name" placeholder="Enter name"/>
						</td>
					</tr>
					
					<tr>
						<td>Your Email Address:</td>
						<td>
						<input type="text" name="email" placeholder="Enter Email Address"/>
						</td>
					</tr>

					<tr>
						<td>Your Message:</td>
						<td>
						<textarea name="body"></textarea>
						</td>
					</tr>

					<tr>
						<td></td>
						<td>
						<input type="submit" name="submit" value="Submit"/>
						</td>
					</tr>
					</table>
				</form>				
 		</div>

	</div>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>
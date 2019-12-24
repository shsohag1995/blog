<?php
	include "../lib/Session.php";
	include "../config/config.php"; 
	include "../lib/Database.php";  
	include "../helpers/Format.php"; 
	Session::init();
 	Session::checkLogin();
	$db = new Database();
	$fm = new Format();
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
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				$email = $fm->validation($_POST['email']);
				$email = mysqli_real_escape_string($db->link,$email);
				if( !filter_var($email,FILTER_VALIDATE_EMAIL)) {
					echo "<span style='color:red'>Please enter a valid email</span>";
				} elseif($email == '') {
					echo "<span style='color:red'>Please enter a valid email</span>";
				} else {
					$sql = "SELECT * FROM tbl_user WHERE `email` = '$email'";
					$query = $db->select($sql);
					if($query) {
						$result = $query->fetch_assoc();
						$id = $result['id'];
						$username = $result['username'];
						$text = substr($email,0,3);
						$randomNum = rand(9999,99999);
						$newPass = $text.$randomNum;
						$password = md5($newPass);

						$update_sql = "UPDATE tbl_user SET `password` = '$password' WHERE `id` = '$id'";
						$update_query = $db->update($update_sql);
						if($update_query) {
							$to = $email;
							$from = "websiteMailAddress@domain-name.com";
							$subject = "Password Recovered!";
							$message = "Your username is: ".$username." and your new password is : ".$newPass;
							$header = "From: ".$from;
							$sendmail = mail($to, $subject, $message,$header);
							if( $sendmail) {
								echo "<span>Password is recovered.Please check ".$email." to get new password</span>";
							} else {
								echo "<span style='color:red'>Something went wrong.Plese try again!</span>";
							}
						} else {
							echo "<span style='color:red'>Could not recover Password.Please contact our <a href='support.php'>support panel</a></span>";
						}
					} else {
						echo "<span style='color:red'>Email Does not exists!</span>";
					}
				}

			}
		?>
		<form action="" method="post">
			<h1>Recover Password</h1>
			<div>
				<input type="text" placeholder="Enter valid email" required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Send" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login!</a>
		</div><!-- button -->
		<div class="button">
			<a href="">Login with social account.</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
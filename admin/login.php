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
				$username = $fm->validation($_POST['email']);
				//$password = $fm->validation(md5($_POST['password']));
                $password = $fm->validation($_POST['password']);
				$username = mysqli_real_escape_string($db->link,$username);
				$password = mysqli_real_escape_string($db->link,$password);

				$sql = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";
				$query = $db->select($sql);
				if($query) {
					$result = mysqli_fetch_array($query);
					Session::set("login", true);
					Session::set("username",$result['username']);
					Session::set("name",$result['name']);
					Session::set("userId",$result['id']);
					Session::set("userRole",$result['role']);
					header("Location: index.php");
				} else {
					echo "<span style='color: red;'>Invalid username or password</span>";
				}

			}
		?>
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="recoverpass.php">Forgot Password!</a>
		</div><!-- button -->
		<div class="button">
			<a href="">Login with social account.</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
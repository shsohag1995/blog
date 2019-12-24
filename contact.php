<?php include "inc/header.php"; ?>
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$firstname = $fm->validation($_POST['firstname']);
	$lastname = $fm->validation($_POST['lastname']);
	$email = $fm->validation($_POST['email']);
	$msg = $fm->validation($_POST['msg']);

	$firstname = mysqli_real_escape_string($db->link,$firstname);
	$lastname = mysqli_real_escape_string($db->link,$lastname);
	$email = mysqli_real_escape_string($db->link,$email);
	$msg = mysqli_real_escape_string($db->link,$msg);
	$error = '';
	$success_msg = '';
	if( empty($firstname) || empty($lastname) || empty($email) || empty($msg) )	{
		$error = "Fill each field.";
	} elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = "Invalid Email address";
	} else {
		$sql = "INSERT INTO tbl_msg(firstname,lastname,email,msg) VALUES('$firstname','$lastname','$email','$msg')";
		$query = $db->insert($sql);
		if($query) {
			$success_msg = "Message sent successfully.";
		} else {
			$error = 'Failed to send message. Please try again.';
		}
	}
}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
			<?php 
				if( isset($error) ) {
					echo "<span style='color: red; font-size: 18px;'>".$error."</span>";
				}
				if( isset($success_msg) ) {
					echo "<span style='color: green;font-size: 18px;'>".$success_msg."</span>";
				}
			?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name" required="1"/>
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name" required="1"/>
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="email" name="email" placeholder="Enter Email Address" required="1"/>
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="msg"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

		</div>
<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>

<?php //require 'registrationPage2.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="responsive.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body id="bodyId">
	<div id="headerId"><h2>Registration Page</h2></div>
	<!--The following part needs to be loaded before the form section to use the variables declared and assigned in the file-->
	<?php 
		//Declaring necessary variables with certain messages to show the user about the different characteristics that the input password should have::[default color of the messages is blue]
	    $pass_size = "*Password should be atleast 8 characters!";
	    $pass_char_lower = "*Password should contain atleast one lowercase character!";
	    $pass_char_upper = "*Password should contain atleast one uppercase character!";
	    $pass_char_num = "*Password should contain atleast one number!";
	    $pass_char_spe = "*No special character is permitted except (_)!";
	?>
	<!--'POST' method prevents data from exposing on the url bar-->
	<!--Don't use $_SERVER['PHP_SELF'] as it is vulnerable to Cross-Site Scripting(XSS)-->
	<!--If you have to use $_SERVER['PHP_SELF'], then use it as htmlspecialchars($_SERVER['PHP_SELF'])-->
	<form id="form" method="POST" action="" ><!--action="" refers to the self submission of this form-->
		<div id="tableId">
			<div id="td1">First Name: 
				<div id="td2">
					<input id="inputId" type="text" name="firstName" value="<?php //echo $fName; ?>" required autofocus><!--First name input area-->
					<span id="error">* <?php //echo $fNameErr; ?></span><!--Error messages related to first name-->
				</div>
			</div><br>
			<div id="td1">Last Name: 
				<div id="td2">
					<input id="inputId" type="text" name="lastName" value="<?php //echo $lName; ?>" required><!--Last name input area-->
					<span id="error">* <?php //echo $lNameErr; ?></span><!--Error messages related to last name-->
				</div>
			</div><br>
			<div id="td1">E-mail:
				<div id="td2">
					<input id="inputId" type="E-mail" name="email" value="<?php //echo $eMail; ?>" required><!--Email input area-->
					<span id="error">* <?php //echo $eMailErr; ?></span><!--Error messages related to email-->
				</div>
			</div><br>
			<div id="td1">Username:
				<div id="td2">
					<input id="inputId" type="text" name="userName" value="<?php //echo $uName; ?>" required><!--Username input area-->
					<span id="error">* <?php //echo $uNameErr; ?></span><!--Error messages related to username-->
				</div>
			</div><br>
			<div id="td1">Password:
				<div id="td2">
					<input id="inputId" type="password" name="password" required><!--Password input area-->
					<span id="error">*</span>
				</div>
			</div>
			<div id="td1">
				<div id="td2">
					<span id="pass_message"><?php echo $pass_size; ?></span><br>
	                <span id="pass_message"><?php echo $pass_char_lower; ?></span><br>
	                <span id="pass_message"><?php echo $pass_char_upper; ?></span><br>
	                <span id="pass_message"><?php echo $pass_char_num; ?></span><br>
	                <span id="pass_message"><?php echo $pass_char_spe; ?></span><br>
				</div>
			</div><br>
			<div id="td1">Confirm Password:
				<div id="td2">
					<input id="inputId" type="password" name="conPassword" required><!--Confirmation password input area-->
					<span id="error">* <?php //echo $conPasswordErr; ?></span><!--Error messages related to confirmation password-->
				</div>
			</div><br>
			<div id="td1">Gender:
				<span id="error">* </span>
			</div><br>
			<div id="td1" style="padding-left: 15%;">
				<input type="radio" name="gender" value="male" required>Male <!--Gender input area [if male]-->
			</div><br>
			<div id="td1" style="padding-left: 15%;">
				<input type="radio" name="gender" value="female">Female <!--Gender input area [if female]-->
			</div><br>
			<div id="td1"><img src="/captcha.php/"><!--Captcha image area-->
				<div id="td2"> <span id="error"><?php //echo $captchaErr; ?></span></div><!--Error messages related to captcha code-->
			</div><br>
			<div id="td1">Enter captcha:
				<div id="td2"><input id="inputId" type="text" name="vercode" required/><!--Captcha code input area-->
				<span id="error">* <?php //echo ""; ?></span>
				</div>
			</div><br>
			<div id="td1">	
				<input id="submitId" type="submit" value="Submit"><!--Submit button-->					
				<br><div id="td2">
					<h6 style="color: red">*Required field</h6>
				</div>
			</div>
		</div>
		<footer id="footerId">Already have an account? Login <a href="loginPage.php"><strong>here</strong></a></footer><!--Link to the login page-->	
	</form>
</body>
</html>
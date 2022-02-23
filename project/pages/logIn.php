<?php
    session_start();
	
	if(isset($_SESSION["user"])) {
        header("Location: ../index.php");
		die();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Log In - Mobile-Shop</title>  
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
		<link rel="stylesheet" href="../styles/general.css"> 
		<link rel="stylesheet" href="../styles/signUp_LogIn.css"> 
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
	</head>
	<body>
		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <div class="container-fluid">
			  <a class="navbar-brand" href="../index.php">
				<img src="../images/logo.png" id="logo" width="33" height="33" alt="Logo">
			  </a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			  <ul class="navbar-nav mb-2 mb-lg-0" id="headerLeft">
				<li class="nav-item">
				  <a class="nav-link" href="../index.php">Home</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="phones.php">Phones</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="contactUs.php">Contact Us</a>
				</li>
			  </ul>
			  <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="headerRight">
				<li class="nav-item">
				  <a class="nav-link active" aria-current="page" href="logIn.php">Log In</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="signUp.php">Register</a>
				</li>
			  </ul>
			</div>
		  </div>
		</nav>
		<!-- Form -->
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<form name="form1" action="../scripts/do_LogIn.php" method="POST"> 
					  <div class="form-group">
						<h2>Mobile-Shop</h2>
						<hr>
						<label for="email"><b>Email</b></label>
						<input type="text" placeholder="Email" name="email" onfocusout="" required>

						<label for="psw"><b>Password</b></label>
						<input type="password" placeholder="Κωδικός" name="psw" onfocusout="" required>
						<br><br><br>

						<button type="submit" id="submitButton">Submit</button>
						
						<?php
							if (isset($_SESSION["error"])) {
								echo "<p id='error'>{$_SESSION["error"]}</p>";
								unset($_SESSION["error"]); 
							}
						?>
						
					  </div>
					</form>				
				</div>
				<div class="col-lg-3"></div>
			</div>
		</div>
		<!-- Footer -->
		<footer class="page-footer">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-12">
						<h6 class="text-uppercase font-weight-bold">About</h6>
						<p>Here in Mobile-Shop, we pride ourselves in our ability to provide our customers the best service available on the market. We provide a 
						   vast selection of devices at any given moment for purchase, from all the major brands of smartphone manufacturers, at the lowest price! </p>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
						<h6 class="text-uppercase font-weight-bold">Contact Info</h6>
						<p> Address: Random Street, 71410 Heraklion
						<br/>Email: exampleEmail@gmail.com
						<br/>Phone +30694357896</p>
					</div>
				<div>
			<div class="footer-copyright text-center">© 2021 All Rights Reserved</div>
		</footer>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</body>
</html>

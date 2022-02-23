<?php
    session_start();
	
	if(!isset($_SESSION["user"])) {
		$_SESSION["id"] = 0;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Phones - Mobile-Shop</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
	    <link rel="stylesheet" href="../styles/general.css"> 
	    <link rel="stylesheet" href="../styles/phones.css"> 
	    <link rel="preconnect" href="https://fonts.gstatic.com">
	    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
	</head>
	<body>
		<!-- Navbar -->
		<?php
		if(isset($_SESSION["user"])) {
				
			  echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
							  <a class="nav-link active" aria-current="page" href="phones.php">Phones</a>
							</li>
							<li class="nav-item">
							  <a class="nav-link" href="contactUs.php">Contact Us</a>
							</li>
						  </ul>
						  <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="headerRight">
							<li class="nav-item dropdown">
							  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								'. htmlspecialchars($_SESSION["user"]) .'
							  </a>
							  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="orders.php">My Orders</a></li>
								<li><a class="dropdown-item" href="../scripts/logout.php">Log Out</a></li>
							  </ul>
							  <li class="nav-item">
								  <a class="nav-link" href="../scripts/logout.php">Log Out</a>
							   </li>
							</li>
						  </ul>
						</div>
					  </div>
					</nav>';
			
			}else {
				echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
								  <a class="nav-link active" aria-current="page" href="phones.php">Phones</a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" href="contactUs.php">Contact Us</a>
								</li>
							  </ul>
							  <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="headerRight">
								<li class="nav-item">
								  <a class="nav-link" href="logIn.php">Log In</a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" href="signUp.php">Register</a>
								</li>
							  </ul>
							</div>
						  </div>
						</nav>';
				}
		?>
		<!-- Body -->
		<div class="container" id ="body">
			<table class="table table-secondary" id="our-table">
				<tbody id="table-body">

				</tbody>
			</table>
		</div>
		<div class="container justify-content-center">
			<ul class="pagination justify-content-center">
				<div id="pagination-wrapper"></div>
			</ul>
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

		<script src="../js/loadPhones.js"></script>
		<script>
			let flag = false;
			let uid ='<?php echo $_SESSION["id"];?>'
			console.log(uid)
			function checkAvailability(pid) {
				if(uid!='0'){
					$.getJSON(`http://localhost:8080/api/v1/products/${pid}`,
						function (data) {
							if (data.quantity > 0) {
								updateAvailability(pid, data)
								makeOrder(pid)
								myvar = `error${pid}`
								var error = document.getElementById(myvar);
								error.textContent = "Thank you for your purchase!"
								error.style.color = "green"
							} else {
								flag = false;
								myvar = `error${pid}`
								var error = document.getElementById(myvar);
								error.textContent = "No stock available."
								error.style.color = "red"
							}

						})
						.done(function () {
							console.log("second success");
						})
						.fail(function (e) {
							console.log("error");
						})
						.always(function () {
							console.log("complete");
						});
				}
				else{
					myvar = `error${pid}`
					var error = document.getElementById(myvar);
					error.textContent = "You have to login first to make an order."
					error.style.color = "red"
				}

			}

			function updateAvailability(pid, object) {
				fetch(`http://localhost:8080/api/v1/products/${pid}`, {
					method: 'PUT',
					headers: {
						'Content-Type': 'application/json'
					},
					body: JSON.stringify({
						"model": object.model,
						"photoURL": object.photoURL,
						"screenSize": object.screenSize,
						"cpu": object.cpu,
						"ram": object.ram,
						"camera": object.camera,
						"battery": object.battery,
						"sar": object.sar,
						"price": object.price,
						"quantity": object.quantity - 1
					})

				})

			}

			function makeOrder(pid) {
				const date = new Date().toJSON().slice(0, 10)
				fetch(`http://localhost:8080/api/v1/orders/`, {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json'
					},
					body: JSON.stringify({
						"pid": pid,
						"uid": uid,
						"date": date
					})
				})	
			}
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</body>
</html>


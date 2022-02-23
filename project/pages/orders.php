<?php
    session_start();
	
	if(!isset($_SESSION["user"])) {
        header("Location: ../index.php");
		die();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>My Orders - Mobile-Shop</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
	    <link rel="stylesheet" href="../styles/general.css"> 
	    <link rel="stylesheet" href="../styles/orders.css"> 
	    <link rel="preconnect" href="https://fonts.gstatic.com">
	    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
	</head>
	<body>
		<!-- Navbar -->		
		<?php echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
				<li class="nav-item dropdown">
				  <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
		</nav>';?>
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

		<script>
			$.getJSON("http://localhost:8080/api/v1/myOrders/" + '<?php echo $_SESSION["id"];?>',
			function (data) {
			var state = {
				'querySet': data,
				'page': 1,
				'rows': 5,
				'window': 5,
			}
			buildTable()

			function pagination(querySet, page, rows) {

				var trimStart = (page - 1) * rows
				var trimEnd = trimStart + rows

				var trimmedData = querySet.slice(trimStart, trimEnd)

				var pages = Math.round(querySet.length / rows);

				return {
					'querySet': trimmedData,
					'pages': pages,
				}
			}

			function pageButtons(pages) {
				var wrapper = document.getElementById('pagination-wrapper')

				wrapper.innerHTML = ``
				console.log('Pages:', pages)

				var maxLeft = (state.page - Math.floor(state.window / 2))
				var maxRight = (state.page + Math.floor(state.window / 2))

				if (maxLeft < 1) {
					maxLeft = 1
					maxRight = state.window
				}

				if (maxRight > pages) {
					maxLeft = pages - (state.window - 1)

					if (maxLeft < 1) {
						maxLeft = 1
					}
					maxRight = pages
				}



				for (var page = maxLeft; page <= maxRight; page++) {
					if (state.page == page) {
						wrapper.innerHTML += `<button value=${page} class="page-active btn btn-sm btn-primary">${page}</button>`
					} else {
						wrapper.innerHTML += `<button value=${page} class="page btn btn-sm btn-primary">${page}</button>`
					}

				}

				wrapper.innerHTML = `<button value=${1} class="page btn btn-sm btn-primary">&#171; First</button>` + wrapper.innerHTML

				wrapper.innerHTML += `<button value=${pages} class="page btn btn-sm btn-primary">Last &#187;</button>`




				$('.page').on('click', function () {
					$('#table-body').empty()
					state.page = Number($(this).val())

					buildTable()
				})

			}


			function buildTable() {
				var table = $('#table-body')

				var data = pagination(state.querySet, state.page, state.rows)
				var myList = data.querySet
				for (var i = 1 in myList) {
					var row = `<div class="card-body">
								<div class="row">
									<div class="col-auto">
										<img src="${myList[i][0].photoURL}" width="70" class="img-fluid" alt="phonesimage">
									</div>
									<div class="col">
										<div class="card-block px-2">
											<h4 class="card-title">${myList[i][0].model}</h4>
											<p class="card-text"><b>Size</b>: ${myList[i][0].screenSize}″ <b>CPU</b>: ${myList[i][0].cpu} <b>RAM</b>: ${myList[i][0].ram} <b>Camera</b>: ${myList[i][0].camera} <b>Battery</b>: ${myList[i][0].battery} <b>SAR</b>: ${myList[i][0].sar}W/kg <b>Price</b>: ${myList[i][0].price}€</p>
											<p class="card-text"><b>Date of purchase</b>: ${myList[i][1].date} </p>				
											<span id="error${myList[i][0].pid}"></span>
										</div>
									</div>
								</div>
							</div>`
					table.append(row)
				}

				pageButtons(data.pages)
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

		</script>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</body>
</html>


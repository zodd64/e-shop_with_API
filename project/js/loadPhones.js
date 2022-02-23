$.getJSON("http://localhost:8080/api/v1/products/",
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
									<img src="${myList[i].photoURL}" width="70" class="img-fluid" alt="phonesimage">
								</div>
								<div class="col">
									<div class="card-block px-2">
										<h4 class="card-title">${myList[i].model}</h4>
										<p class="card-text"><b>Size</b>: ${myList[i].screenSize}″ <b>CPU</b>: ${myList[i].cpu} <b>RAM</b>: ${myList[i].ram} <b>Camera</b>: ${myList[i].camera} <b>Battery</b>: ${myList[i].battery} <b>SAR</b>: ${myList[i].sar}W/kg </p>
										<p class="card-text"><b>Price</b>: ${myList[i].price}€ </p>				
										<button class="btn btn-primary" onclick="checkAvailability(${myList[i].pid})">Buy</button>
										<span id="error${myList[i].pid}"></span>
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


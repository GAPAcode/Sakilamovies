;
((c , doc , ajax) => {
	const showRedirect = () => {
		const icon = doc.querySelector('#redirect')
		icon.style = 'display:block;'
	}
	
	const fadeOutAtLogin = (obj) => {
		obj.className = 'modal fade hide'
		showRedirect()
	}

	
	const searchFilm = (search) => {
		doc.location.href = `http://localhost/sakila/search/${search}`
	}
	
	const checkEmptyAndSearch = (e,obj) => {
		e.preventDefault()
		if(obj.value === '' || obj.value === null){
			alert('Your search is empty')
		}else{
			showRedirect();
			searchFilm(obj.value);
		}
	}

	const refreshTotal = () => {
		const totalAmount = doc.querySelector('#cart-total')
		const itemPrices =  doc.querySelectorAll('.item-price')

		let total = 0;

		itemPrices.forEach(item => {
			total += parseFloat(item.textContent)
		})

		totalAmount.textContent = `$${total}`
	}
	
	const getCity = (e,city,inputCity) => {

		fetch(`/sakila/app/functions/?country=${e.target.value}&city=${inputCity.value}`)
		.then(response => response.text())
		.then(text => {
			if(e.target.name === 'st_country')
				city.innerHTML = text
		})
		.catch( err => c(`Error: ${err.message}`) )

	}

	const addToCart = (filmId,title,price) => {
		const film = {
			'filmId' : filmId,
			'title' : title,
			'price' : price
		}

		fetch(`/sakila/app/functions/?addToCart=${JSON.stringify(film)}`)
		.then(response => response.text())
		.then(text => alert(text))
		.catch(err => c(`Error: ${err.message}`))
		
	}

	const deleteCartItem = (filmId) => {
		const itemRow = doc.querySelector(`#item-${parseInt(filmId)}`)

		fetch(`/sakila/app/functions/?deleteItem=${filmId}`)
		.then(response => response.text())
		.then(text => {
			if (text.includes('the cart is empty')) {
				showEmptyCart()
			}else{
				itemRow.remove()
				refreshTotal()
			}
		})
		.catch(err => c(`Error: ${err.message}`))

	}

	const showEmptyCart = () => {
		const cartContainer = doc.querySelector('#cart-container')

		cartContainer.innerHTML = `
		<div class="card w-50 mx-auto mt-5">
		<div class="card-header">
			<h3 class="text-center">The cart is empty!</h3>
		</div> 

		<div class="card-body">
			<div class="text-center">
				<i class="fa fa-shopping-cart fa-5x"></i>
			</div>

			<div class="text-center font-weight-bold mt-3">
				<p>Add some movies and come back to rent him!</p>
			</div>
		</div>

		<div class="card-footer">
			<a href="index" class="btn btn-success w-100 font-weight-bold"> 
				Back to Film Index
			</a>
		</div>
	</div>`
	}

	const renderSalesByCategoryChart = (data) => {
		const salesByCategory = doc.getElementById('salesByCategory')

		let chart = new Chart(salesByCategory, {
			type: 'bar',
			data: {
				labels: data.labels,
				datasets: [{
					label: 'Total Sales',
					data: data.sales,
					backgroundColor: [
						'rgba(255, 99, 132, 0.6)',
						'rgba(54, 162, 235, 0.6)',
						'rgba(255, 206, 86, 0.6)',
						'rgba(75, 192, 192, 0.6)',
						'rgba(153, 102, 255, 0.6)',
						'rgba(255, 159, 64, 0.6)',
						'rgba(255, 99, 132, 0.6)',
						'rgba(54, 162, 235, 0.6)',
						'rgba(255, 206, 86, 0.6)',
						'rgba(75, 192, 192, 0.6)',
						'rgba(153, 102, 255, 0.6)',
						'rgba(255, 159, 64, 0.6)',
						'rgba(255, 99, 132, 0.6)',
						'rgba(54, 162, 235, 0.6)',
						'rgba(255, 206, 86, 0.6)',
						'rgba(75, 192, 192, 0.6)',
						'rgba(153, 102, 255, 0.6)',
						'rgba(255, 159, 64, 0.6)',
					],
					borderWidth: "2"
				}],
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				}
			}
		})
	
	}

	function requestSalesByCategory (){
		fetch('/sakila/app/functions/?salesByCategory=get')
		.then(response => response.json())
		.then(json => renderSalesByCategoryChart(json))
		.catch(err => c(err.message))
	}

	const renderSalesByDateChart = (data) => {
		const salesByCategory = doc.getElementById('dailySalesChart')

		let chart = new Chart(salesByCategory, {
			type: 'line',
			data: {
				labels: data.labels,
				datasets: [{
					label: 'Sales by Date',
					data: data.sales,
					filled:true,
					backgroundColor: 'rgba(23, 162, 184,0.6)'
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				}
			}
		})
	}

	function requestSalesByDate (){
		fetch('/sakila/app/functions/?salesByDate=get')
		.then(response => response.json())
		.then(json => renderSalesByDateChart(json))
		.catch(err => c(err.message))

	}



	//general
	doc.addEventListener('DOMContentLoaded',() => {
		const body = doc.querySelector('body'),
		footer = doc.querySelector('footer'),
		navbarbtns = doc.querySelectorAll('.nav-item, .nav-item, .dropdown-item, .page-item, .film-btn')
		
		navbarbtns.forEach((btn) => {
			if(!btn.querySelector('[data-toggle] '))			
				btn.addEventListener( 'click' , () => showRedirect() )
		})
		if(body.offsetHeight < 700)
		footer.classList += ' footer-fixed'

	})
	
	// Indice
	if (doc.location.pathname == '/sakila/' || doc.location.pathname == '/sakila/index' || 
		doc.location.pathname.includes('/search')) {
			
		const loginModal = doc.querySelector('#login'),
		search = doc.querySelector('#film_search'),
		searchInput = doc.querySelector('#s_input'),
		error = doc.querySelector('#error')
		

		if(error){
			const errorBtns = error.querySelectorAll('[data-dismiss="modal"]')

			error.style = 'display:block;'
			error.className = 'modal fade opaque'
			setTimeout(() => error.className = 'modal fade show', 50)
			
			errorBtns.forEach( btn => {
				btn.addEventListener('click',() => {
					error.className = 'modal fade hide'
					setTimeout(() => error.style = 'display:none', 150)
				})
			})
		}
		
		search.addEventListener( 'submit', (e) => {
			checkEmptyAndSearch(e,searchInput)
		})
		
		loginModal.addEventListener( 'submit', () => fadeOutAtLogin(loginModal) )
	
	
	
	}
	
	// settings
	if(doc.location.pathname == "/sakila/settings"){
		form = doc.querySelector('#settings')
		city = doc.querySelector('#city')
		inputCity = doc.querySelector('#select_city')
		
		form.addEventListener('click',(e) => getCity(e,city,inputCity))
	}

	// Film
	if(doc.location.pathname.includes('/sakila/film/')){
		const addFilmBtn = doc.querySelector('#rent-btn'),
		title = doc.querySelector('#film-title'),
		price = doc.querySelector('#film-price')
		addFilmBtn.addEventListener('click', (e) => addToCart(addFilmBtn.value,
															title.textContent,
															price.textContent ))
	}

	//cart
	if(doc.location.pathname == '/sakila/cart'){
		const deleteCartItemBtns = doc.querySelectorAll('.cart-delete')

		deleteCartItemBtns.forEach((btn) => {
			btn.addEventListener('click', (e) => deleteCartItem(e.target.dataset.item))
		})
	}

	//management
	if(doc.location.pathname == '/sakila/management'){
		requestSalesByCategory()
		requestSalesByDate()
	}

})(console.log, document, new XMLHttpRequest)
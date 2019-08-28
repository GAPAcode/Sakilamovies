;
((c , doc , ajax) => {
	const OK = 200,
	NOT_FOUND = 404

	const showRedirect = () => {
		const icon = doc.querySelector('#redirect')
		icon.style = 'display:block;'
	}
	
	const fadeOutAtLogin = (obj) => {
		obj.className = 'modal fade hide'
		showRedirect()
	}

	const checkEmptyAndSearch = (e,obj) => {
		e.preventDefault()
		if(obj.value === '' || obj.value === null){
			alert('Your search is empty')
		}else{
			showRedirect();
			searchRedirect(obj.value);
		}
	}
	
	const searchRedirect = (search) => {
		doc.location.href = `http://localhost/sakila/search/${search}`
	}
	
	const getCity = (e,city,inputCity) => {
		if(e.target.name == "st_country"){
			ajax.open('POST','./app/functions.php',true)
			ajax.addEventListener('readystatechange', () => {
				if(ajax.status >= OK && ajax.status < 400){
					city.innerHTML = ajax.response
				}else if (ajax.status === NOT_FOUND){
					city.innerHTML = `Error ${ajax.status}, ${ajax.statusText}`
				}
			})
			ajax.setRequestHeader('content-type', 'application/x-www-form-urlencoded')
			ajax.send( encodeURI(`country=${e.target.value}&city=${inputCity.value}`) )
		}
	}

	const addToCart = (filmId,title,price) => {
		const film = {
			'filmId' : filmId,
			'title' : title,
			'price' : price
		}

		ajax.open('POST','/sakila/app/functions/',true)
		ajax.addEventListener('load', () => {
			if(ajax.status >= OK && ajax.status < 400){

				if(!ajax.response.includes('The film is on the cart')){
					alert(`Film added correctly to the Cart`)
				}
				else {
					alert(`This film is already in the cart`)
				}

			}else if (ajax.status === NOT_FOUND){
				alert(`Error ${ajax.status}, ${ajax.statusText}`)
			}
		})
		ajax.setRequestHeader('content-type', 'application/x-www-form-urlencoded')
		ajax.send( encodeURI(`filmjson=${JSON.stringify(film)}`) )
		
	}

	const deleteCartItem = (filmId) => {
		const itemRow = doc.querySelector(`#item-${parseInt(filmId)}`)
		
		ajax.open('POST','./app/functions.php',true)
		ajax.addEventListener('load', () => {
			if(ajax.status >= OK && ajax.status < 400){
				if(ajax.response.includes('the cart is empty')){
					showEmptyCart()
				}
				itemRow.innerHTML = ''
				refreshTotal()
			}else if (ajax.status === NOT_FOUND){
				alert(`Error ${ajax.status}, ${ajax.statusText}`)
			}
		})
		ajax.setRequestHeader('content-type', 'application/x-www-form-urlencoded')
		ajax.send( encodeURI(`deleteItem=${filmId}`) )
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
	
	const refreshTotal = () => {
		const totalAmount = doc.querySelector('#cart-total')
		const itemPrices =  doc.querySelectorAll('.item-price')

		let total = 0;

		itemPrices.forEach(item => {
			total += parseFloat(item.textContent)
		})

		totalAmount.textContent = `$${total}`
	}

	//general
	doc.addEventListener('DOMContentLoaded',() => {
		const navbarbtns = doc.querySelectorAll('.nav-item, .nav-item, .dropdown-item, .page-item, .film-btn')
		
		navbarbtns.forEach((btn) => {
			if(!btn.querySelector('[data-toggle] ')){			
				btn.addEventListener( 'click' , () => showRedirect() )
			}
		})

	})
	
	// Indice
	if (doc.location.pathname == '/sakila/' || doc.location.pathname == '/sakila/index') {
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
		
		addFilmBtn.addEventListener('click', (e) => addToCart(e.target.value,
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

})(console.log, document, new XMLHttpRequest)
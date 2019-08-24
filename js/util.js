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

	const checkEmpty = (e,obj) => {
		if(obj.value === '' || obj.value === null){
			e.preventDefault()
			alert('No has ingresado nada a la busqueda')
		}else{
			const icon = doc.querySelector('#redirect')
			icon.style = 'display:block'
		}
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

		ajax.open('POST','./app/functions.php',true)
		ajax.addEventListener('load', () => {
			if(ajax.status >= OK && ajax.status < 400){

				if( ajax.response != 'The film is on the cart'){
					alert(`Film added correctly to the Cart ${ajax.responseText}`)
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

	const refreshTotal = () => {
		const totalAmount = doc.querySelector('#cart-total')
		const itemPrices =  doc.querySelectorAll('.item-price')

		let total = 0;

		itemPrices.forEach(item => {
			total += parseFloat(item.textContent)
		})

		totalAmount.textContent = `$${total}`
	}

	const deleteCartItem = (filmId) => {
		const itemRow = doc.querySelector(`#item-${parseInt(filmId)}`)

		ajax.open('POST','./app/functions.php',true)
		ajax.addEventListener('load', () => {
			if(ajax.status >= OK && ajax.status < 400){
				itemRow.innerHTML = ''
				refreshTotal()
			}else if (ajax.status === NOT_FOUND){
				alert(`Error ${ajax.status}, ${ajax.statusText}`)
			}
		})
		ajax.setRequestHeader('content-type', 'application/x-www-form-urlencoded')
		ajax.send( encodeURI(`deleteItem=${filmId}`) )
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
		
		search.addEventListener( 'submit', (e) => checkEmpty(e,searchInput))
		
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
	if(doc.location.pathname == '/sakila/film'){
		const addFilmBtn = doc.querySelector('#rent-btn'),
		title = doc.querySelector('#film-title'),
		price = doc.querySelector('#film-price')
		
		c()

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
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
	
	const getCity = (e) => {
		if(e.target.name == "st_country"){
			ajax.open('POST','./view/settings_paises_view.php',true)
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
	//general
	doc.addEventListener('DOMContentLoaded',() => {
		const navbarbtns = doc.querySelectorAll('.navbar .nav-item')
		
		navbarbtns.forEach((btn) => {
			if(!btn.querySelector('[data-toggle="modal"]')){			
				btn.addEventListener( 'click' , () => showRedirect() )
			}
		})

	})
	
	// Indice
	if (doc.location.pathname == '/sakila/' || doc.location.pathname == '/sakila/index.php') {
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
	if(doc.location.pathname == "/sakila/settings.php"){
		form = doc.querySelector('#settings')
		city = doc.querySelector('#city')
		inputCity = doc.querySelector('#select_city')
		
		form.addEventListener('click', getCity)
	}

})(console.log, document, new XMLHttpRequest)
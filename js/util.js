;
((c , doc , ajax) => {
	const OK = 200,
	NOT_FOUND = 404

	const fadeOutAtLogin = (obj) => {
		obj.className = 'modal fade hide'
		const icon = doc.querySelector('#redirect')
		icon.style = 'display:block;'
	}
	
	if(doc.location.pathname == "/sakila/settings.php"){
		form = doc.querySelector('#settings')
		city = doc.querySelector('#city')
		inputCity = doc.querySelector('#select_city')
		function get_city(e) {
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
		form.addEventListener('click', get_city)
	}

	if (doc.location.pathname == '/sakila/' || doc.location.pathname == '/sakila/index.php') {
		const loginModal = doc.querySelector('#login'),
		error = doc.querySelector('#error')

		if(error){
			error.style = 'display:block;'
			error.className = 'modal fade opaque'
			setTimeout(() => error.className = 'modal fade show', 50)

			const errorBtns = error.querySelectorAll('[data-dismiss="modal"]')

			errorBtns.forEach(btn => {
				btn.addEventListener('click',() => {
					error.className = 'modal fade hide'
					//error.style = 'display:none'
					setTimeout(() => error.style = 'display:none', 150)
				})
			})
		}
		
		login.addEventListener( 'submit',() => fadeOutAtLogin(loginModal) )
	}
	

})(console.log, document, new XMLHttpRequest)
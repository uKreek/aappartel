class Carousel {
	constructor () {
		this.popups = document.getElementsByClassName('service-popup')

		this.popups_list = Array.from(this.popups)
		for (let i = 0; i < this.popups_list.length; i++){
			this.popups_list[i] = this.popups_list[i].id
		}

		this.center = null
		this.left = null
		this.right = null
		this.hidden_left = null
		this.hidden_right = null
	}

	next = () => {

	}


	prev = () => {
	
	}


	call = (id) => {
		console.log('CALLED')
		//service-popup-center
		let called_popup = document.getElementById(id); // getting called_popup
		let called_popup_index = this.popups_list.indexOf(called_popup.id); // getting called_popup index in popups_list


		if (this.center != null) {
			this.popups[this.center].classList.remove('service-popup-center')
			this.popups[this.left].classList.remove('service-popup-left')
			this.popups[this.right].classList.remove('service-popup-right')
		}

		this.center = called_popup_index
		this.popups[this.center].classList.add('service-popup-center')

		if (called_popup_index == 0) {
			this.left = this.popups.length - 1
		}
		else { this.left = called_popup_index - 1 }
		this.popups[this.left].classList.add('service-popup-left')

		if (called_popup_index == this.popups.length - 1) {
			this.right = 0
		}
		else { this.right = called_popup_index + 1 }
		this.popups[this.right].classList.add('service-popup-right')

		document.getElementById('service-popups-wrapper').style.display = 'flex';

	}

	hide = () => {
		this.popups[this.left].classList.remove('service-popup-left')
		this.popups[this.center].classList.remove('service-popup-center')
		this.popups[this.right].classList.remove('service-popup-right')
		document.getElementById('service-popups-wrapper').style.display = 'none';



		this.center = null
		this.left = null
		this.right = null
		this.hidden_left = null
		this.hidden_right = null
		this.nowId = null
	}

}


const carousel = new Carousel()

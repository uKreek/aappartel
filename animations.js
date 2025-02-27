(function () {
	var rects = document.querySelectorAll('.tittle-line');

	for (let i = 0; i < rects.length; i++){

		var observer = new IntersectionObserver(entries => {
			entries.forEach(entry => {

				if (entry.isIntersecting) {
					entry.target.style.width = '130px';
				}
			});
		});

		observer.observe(rects[i]);
	}

})();


(function () {
	var rects = document.querySelectorAll('.tittle');

	for (let i = 0; i < rects.length; i++){

		var observer = new IntersectionObserver(entries => {
			entries.forEach(entry => {

				if (entry.isIntersecting) {
					entry.target.style.scale = '1 1';
				}
			});
		});

		observer.observe(rects[i]);
	}

})();


(function () {
	var rects = document.querySelectorAll('#contact-map');

	for (let i = 0; i < rects.length; i++){

		var observer = new IntersectionObserver(entries => {
			entries.forEach(entry => {

				if (entry.isIntersecting) {
					entry.target.style.scale = '1 1';
				}
			});
		});

		observer.observe(rects[i]);
	}

})();







function ShowPopup(apartId){

	aparts = {
		"apart0": ['1.png', '2.png'],
		"apart1": ['4.png']
	}

	document.getElementById('popup-room-wrapper').style.display = '';
	images = aparts[apartId]
	console.log(apartId)

}

const parentDiv = document.getElementById('popup-room-wrapper');
const childDiv = document.getElementById('popup-room');

parentDiv.addEventListener('click', () => {
  console.log('Функция родительского div вызвана');
  HidePopup()
});

childDiv.addEventListener('click', (event) => {
  event.stopPropagation(); // Останавливаем всплытие события
  console.log('Функция дочернего div вызвана');
});

function HidePopup(){
	document.getElementById('popup-room-wrapper').style.display = 'none';

}





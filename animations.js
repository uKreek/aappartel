aparts = {
	"apart0": ["./apartments/apartment/apart0.jpg", "./apartments/apartment/apart1.jpg"],
	"apart1": [""],
	"apart2": ["./apartments/apartment-family/apart0.jpg", "./apartments/apartment-family/apart0.jpg"]
}
images = aparts[0];

// анимация для линий
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

// анимация для текста артиклей
(function () {
	var rects = document.querySelectorAll('.tittle, #contact-map');

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

// открытие просмотра картинок выбранного апартамента
function ShowPopup(apartId){
	document.getElementById('popup-room-wrapper').style.display = '';
	images = aparts[apartId];
}

// закрытие просмотра картинок
const parentDiv = document.getElementById('popup-room-wrapper');
const childDiv = document.getElementById('popup-room');
const previous = document.getElementById('previous');
const next = document.getElementById('next');

parentDiv.addEventListener('click', () => {
  console.log('Функция родительского div вызвана');
  HidePopup()
});

childDiv.addEventListener('click', (event) => {
  event.stopPropagation(); // Останавливаем всплытие события
  console.log('Функция дочернего div вызвана');
});

previous.addEventListener('click', (event) => {
	event.stopPropagation(); // Останавливаем всплытие события
	Slyde('back');
	console.log('Функция prev вызвана');
});

next.addEventListener('click', (event) => {
	event.stopPropagation(); // Останавливаем всплытие события
	Slyde("next");
	console.log('Функция next вызвана');
});

function HidePopup(){
	document.getElementById('popup-room-wrapper').style.display = 'none';

}

// перелистывание картинок
now = 0
///current = images[now]
function Slyde(type){
	var img = document.getElementById('popup-room-img');
	switch (type){
		case 'next':
			if (now+1 <= images.length)
				current = images[now+1]
		break;
		case 'back':
			if (now-1 >= 0)
				current = images[now-1]
		break;
	}
	img.style.src = current;
}
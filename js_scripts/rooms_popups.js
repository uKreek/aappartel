let aparts = apartments;                // images
let aparts_texts = apartments_texts;    // texts

document.addEventListener('DOMContentLoaded', function () {
    aparts = apartments;
    aparts_texts = apartments_texts;
})

class RoomPopup {
    constructor(aparts, aparts_texts) {
        this.wrapper = document.getElementById('popup-room-wrapper')
        this.popup_room = document.getElementById('popup-room');
        this.room_image = document.getElementById('popup-room-img')
        this.apart_id = null
        this.current = null
        this.aparts = aparts
        this.aparts_texts = aparts_texts
        this.images = this.aparts['apart0']
        this.texts = this.aparts_texts['apart0']
        this.previous = document.getElementById('popup-room-previous')
        this.next = document.getElementById('popup-room-next')
        this.now = 0

        this.title_1 = document.getElementById('room-title-1')
        this.title_2 = document.getElementById('room-title-2')
        this.title_3 = document.getElementById('room-title-3')
        this.popup_title = document.getElementById('popup-room-title')
    }

    show_popup = (apart_id) => {
        this.previous.style.opacity = '100%';
        this.previous.style.cursor = 'pointer';
        this.next.style.opacity = '100%';
        this.next.style.cursor = 'pointer';

        if (apart_id === 'apart0'){
            this.popup_title.textContent = this.title_1.textContent;
        }
        else if (apart_id === 'apart1'){
            this.popup_title.textContent = this.title_2.textContent;
        }
        else{
            this.popup_title.textContent = this.title_3.textContent;
        }

        this.now = 0;
        this.apart_id = apart_id;
        this.wrapper.style.display = 'flex';
        this.popup_room.style.display = 'flex';
        this.images = this.aparts[this.apart_id]; // getting images for selected apart_id
        this.texts = this.aparts_texts[this.apart_id]; // getting texts for selected apart_id
        this.current = this.images[this.now];
        this.room_image.setAttribute('src', this.current);
        document.body.style.overflow = 'hidden';

        // устанавливаю текст для отображающейся картинки (если текст существует)
        if (this.texts && this.texts[this.now]) {
            this.popup_title.textContent = this.texts[this.now];
        }

        if (this.now == 0 && this.now + 1 >= this.images.length) {
            this.previous.style.opacity = '50%';
            this.previous.style.cursor = 'default';
            this.next.style.opacity = '50%';
            this.next.style.cursor = 'default';
        }
        if (this.now + 1 >= this.images.length) {
            this.next.style.opacity = '50%';
            this.next.style.cursor = 'default';
        }
        if (this.now == 0) {
            this.previous.style.opacity = '50%';
            this.previous.style.cursor = 'default';
        }
    }

    show_prev = () => {
        if (this.now - 1 >= 0) {
            this.now -= 1;
        }
        if (this.now == this.images.length - 2) {
            this.next.style.opacity = '100%';
            this.next.style.cursor = 'pointer';
        }
        if (this.now == 0) {
            this.current = this.images[this.now];
            this.previous.style.opacity = '50%';
            this.previous.style.cursor = 'default';
        }
        if (this.now > 0) {
            this.current = this.images[this.now];
        }

        this.room_image.setAttribute('src', this.current);

        // Меняем текст для новой картинки (если текст существует)
        if (this.texts && this.texts[this.now]) {
            this.popup_title.textContent = this.texts[this.now];
        }
    }

    show_next = () => {
        this.now += 1;
        if (this.now == 1 && this.now != this.images.length) {
            this.previous.style.opacity = '100%';
            this.previous.style.cursor = 'pointer';
        }
        if (this.now < this.images.length) {
            this.current = this.images[this.now];
        }
        if (this.now == this.images.length - 1) {
            this.next.style.opacity = '50%';
            this.next.style.cursor = 'default';
        }
        if (this.now > this.images.length - 1) {
            this.now -= 1;
        }

        this.room_image.setAttribute('src', this.current);

        // Меняем текст для новой картинки (если текст существует)
        if (this.texts && this.texts[this.now]) {
            this.popup_title.textContent = this.texts[this.now];
        }
    }

    hide = () => {
        this.wrapper.style.display = 'none';
        this.popup_room.style.display = 'none';
        this.now = 0;
        document.body.style.overflow = 'auto';
    }
}

document.getElementById('popup-room').addEventListener('click', (event) => {
    event.stopPropagation();
});

const room_popups = new RoomPopup(aparts, aparts_texts)
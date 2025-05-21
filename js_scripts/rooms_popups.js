let aparts = apartments;

document.addEventListener('DOMContentLoaded', function () {
    aparts = apartments;
})

class RoomPopup {
    constructor(aparts) {
        this.wrapper = document.getElementById('popup-room-wrapper')
        this.popup_room = document.getElementById('popup-room');
        this.room_image = document.getElementById('popup-room-img')
        this.apart_id = null
        this.current = null
        this.aparts = aparts
        this.images = this.aparts['apart0']
        this.previous = document.getElementById('popup-room-previous')
        this.next = document.getElementById('popup-room-next')
        this.now = 0
    }

    show_popup = (apart_id) => {
        this.previous.style.opacity = '100%';
        this.previous.style.cursor = 'pointer';
        this.next.style.opacity = '100%';
        this.next.style.cursor = 'pointer';

        this.now = 0;
        this.apart_id = apart_id;
        this.wrapper.style.display = 'flex';
        this.popup_room.style.display = 'flex';
        this.images = this.aparts[this.apart_id];
        this.current = this.images[this.now];
        this.room_image.setAttribute('src', this.current);
        document.body.style.overflow = 'hidden';

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

const room_popups = new RoomPopup(aparts)
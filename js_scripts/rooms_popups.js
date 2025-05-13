let aparts = apartments;

document.addEventListener('DOMContentLoaded', function (){
    aparts = apartments;
    console.log('aparts: ', aparts);
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


        console.log(this.images);
        this.now = 0;
        console.log('now = ', this.now);
        this.apart_id = apart_id;
        console.log('apart id =', apart_id);
        this.wrapper.style.display = 'flex';
        this.popup_room.style.display = 'flex';
        this.images = this.aparts[this.apart_id];
        console.log(this.images);
        this.current = this.images[this.now];
        console.log('current:', this.current);
	    this.room_image.setAttribute('src', this.current);
	    document.body.style.overflow = 'hidden';

        console.log("images length:", this.images.length);
        if(this.now == 0 && this.now+1 >= this.images.length) {
            this.previous.style.opacity = '50%';
            this.previous.style.cursor = 'default';
            this.next.style.opacity = '50%';
	        this.next.style.cursor = 'default';
        }
        if (this.now+1 >= this.images.length) {
            this.next.style.opacity = '50%';
            this.next.style.cursor = 'default';
        } 
        if (this.now == 0) {
            this.previous.style.opacity = '50%';
            this.previous.style.cursor = 'default';
        }

        console.log("now:", room_popups.now);
    }

    show_prev = () => {
				if (this.now - 1 >= 0){
					this.now -= 1;
				}
        console.log("prev (now):", this.now);
        if (this.now == this.images.length - 2)
        {
            this.next.style.opacity = '100%';
            this.next.style.cursor = 'pointer';
        }
        if (this.now == 0)
        {
            this.current = this.images[this.now];
            this.previous.style.opacity = '50%';
            this.previous.style.cursor = 'default';
        }
        if (this.now > 0)
        {
            this.current = this.images[this.now];
        }
        
        this.room_image.setAttribute('src', this.current);
    }

    show_next = () => {
        console.log("next (now):", this.now);
				this.now += 1;
        if (this.now == 1 && this.now != this.images.length)
        {
					this.previous.style.opacity = '100%';
					this.previous.style.cursor = 'pointer';
        }
        if (this.now < this.images.length)
        {
            this.current = this.images[this.now];
        }
        if (this.now == this.images.length - 1)
        {
            this.next.style.opacity = '50%';
            this.next.style.cursor = 'default';
        }
        if (this.now > this.images.length - 1)
        {
            this.now -= 1;
            console.log("next corrected (now):", this.now);
        }

        this.room_image.setAttribute('src', this.current);
    }

    hide = () => {
        this.wrapper.style.display = 'none';
        this.popup_room.style.display = 'none';
        this.now = 0;
        document.body.style.overflow = 'auto';
        console.log("now:", room_popups.now);
    }
}

document.getElementById('popup-room').addEventListener('click', (event) => {
    event.stopPropagation();
});

const room_popups = new RoomPopup(aparts)


function ShowCarousel(name)
{
  // .service-popup-center
  let popup = document.getElementById(name);
  popup.classList.add("service-popup-center");
}





class Carousel {
  constructor () {
    this.popups = document.getElementsByClassName('service-popup')
    this.popups_len = this.popups.length
    this.center = null
    this.left = null
    this.right = null
    this.hidden_left = null
    this.hidden_right = null
    this.nowId
    console.log(this.popups)
  }

  next = () => {
    nowId += 1;
  }


  prev = () => {
  
  }


  show = (id) => {
    console.log("Я НЕ СРАБОТАЮ");
    let popup = document.getElementById(id);
    if (this.center != null && this.center.classList.contains("service-popup-center")) {
      this.center.classList.remove("service-popup-center")
    }
    popup.classList.add("service-popup-center");
    this.center = popup

    if (this.right != null && this.right.classList.contains("service-popup-right")) {
      this.right.classList.remove("service-popup-right")
    }
    this.popups[center_index+1]


  }

}


const carousel = new Carousel()

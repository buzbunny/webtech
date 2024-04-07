const trendingSwiper = new Swiper(".trending__swiper", {
  loop: true,
  slidesPerView: "auto",
  spaceBetween: 50,
});

const testimonialSwiper = new Swiper(".testimonial__swiper", {
  loop: true,
  spaceBetween: 30,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

const trendingSwiper2 = new Swiper(".trending__swiper", {
  loop: true,
  slidesPerView: "auto",
  spaceBetween: 50,
  navigation: {
    nextEl: ".trending__header .section__nav .ri-arrow-right-s-line",
    prevEl: ".trending__header .section__nav .ri-arrow-left-s-line",
  },
});

    document.addEventListener('DOMContentLoaded', function() {
      const headerImage = document.querySelector('.header__image');
      const images = [
        'landing/assets/header-bg.jpeg',
        'landing/assets/header-bg-2.jpeg',
        'landing/assets/header-bg-3.webp',
        'landing/assets/header-bg-4.png',
        'landing/assets/header-bg-5.jpeg',
        'landing/assets/header-bg-6.webp',
        'landing/assets/header-bg-7.jpeg',
        'landing/assets/header-bg-8.jpeg'
      ];
      let currentIndex = 0;

      function changeBackgroundImage() {
        headerImage.style.backgroundImage = `url('${images[currentIndex]}')`;
        currentIndex = (currentIndex + 1) % images.length; // Loop through images
      }

      // Call changeBackgroundImage initially
      changeBackgroundImage();

      // Set interval to change background image every 5 seconds (5000 milliseconds)
      setInterval(changeBackgroundImage, 5000);
    });

    function clock(){
                
      var monthNames = [ "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December" ]; 
      var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

      var today = new Date();

      document.getElementById('Date').innerHTML = (dayNames[today.getDay()] + " " + 
      today.getDate() + ' ' + monthNames[today.getMonth()] + ' ' +today.getFullYear());

      
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      var day = h<11 ? 'AM': 'PM';

      h = h<10? '0'+h: h;
      m = m<10? '0'+m: m;
      s = s<10? '0'+s: s;               

      document.getElementById('hours').innerHTML = h;
      document.getElementById('min').innerHTML = m;
      document.getElementById('sec').innerHTML = s;

  }var inter = setInterval(clock,400);


    

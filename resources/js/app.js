import '../css/app.css';

// Vendor JS
import $ from 'jquery';
window.$ = $;
window.jQuery = $;
import moment from 'moment';
import 'moment-timezone';
import 'owl.carousel';
import '@fortawesome/fontawesome-free/js/all.min.js';

// Swiper imports (static so CSS always loads before init)
import Swiper, { Navigation, Pagination } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

let headerSwiperInstance = null;

function initHeaderSwiper() {
    // Destroy old Swiper instance if it exists
    // if (headerSwiperInstance) {
    //     headerSwiperInstance.destroy(true, true);
    // }

    headerSwiperInstance = new Swiper('.mySwiper', {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
}

// Run on first load
document.addEventListener('DOMContentLoaded', initHeaderSwiper);

// Run after Livewire navigation
document.addEventListener('livewire:navigated', initHeaderSwiper);

// Run after Livewire updates the DOM
Livewire.hook('message.processed', () => {
    initHeaderSwiper();
});


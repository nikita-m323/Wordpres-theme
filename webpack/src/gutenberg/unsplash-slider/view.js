document.addEventListener('DOMContentLoaded', function () {

    const blockClass = '.unsplash-slider'
    const blocks = document.querySelectorAll(blockClass)

    if (blocks) {
        blocks.forEach((block) => {
            const swiper = new Swiper(block.querySelector('.swiper-container'), {
                modules: [SwiperNavigation, SwiperAutoplay],
                spaceBetween: 0,
                slidesPerView: 1,
                loop: true,
                speed: 1000,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },
                navigation: {
                    nextEl: block.querySelector('.swiper-button-next'),
                    prevEl: block.querySelector('.swiper-button-prev')
                },
                centeredSlides: true,
                autoHeight: true
            });
        })
    }
})
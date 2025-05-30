import Swiper from "swiper";
import { Navigation, Pagination, Autoplay } from "swiper/modules";

if (document.querySelector(".personal-blocks")) {
  const { length: elements } = document.querySelectorAll(
    ".personal-blocks__block"
  );

  new Swiper(".personal-blocks", {
    el: ".swiper-wrapper",
    slideClass: "personal-blocks__block",
    createElements: true,
    autoplay: {
      delay: 5000,
    },
    loop: true,
    modules: [Navigation, Pagination, Autoplay],
    navigation: true,
    pagination: true,
    spaceBetween: 20,
    breakpoints: {
      768: {
        slidesPerView: elements >= 2 ? 2 : "auto",
      },
      1024: {
        slidesPerView: elements >= 3 ? 3 : elements >= 2 ? 2 : "auto",
      },
    },
  });
}

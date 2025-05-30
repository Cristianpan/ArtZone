const profileIcon = document.querySelector('.navigation__link--profile'); 
const searchButton = document.querySelector('.search__button');

profileIcon.addEventListener('click', ()=> {
    const dropdown = document.querySelector('.navigation__dropdown'); 
    dropdown.classList.toggle('navigation__dropdown--active')
});

searchButton.addEventListener('click', ()=> {
    const searchInput = document.querySelector('.search__input'); 
    searchInput.classList.toggle('search__input--active')
}); 
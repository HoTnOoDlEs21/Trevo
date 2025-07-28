const menuToggle = document.querySelector('.menu-toggle');
const navRight = document.querySelector('.nav-right');

menuToggle.addEventListener('click', () => {
    navRight.classList.toggle('active');
});

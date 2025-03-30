import '../css/app.css';
import '@fortawesome/fontawesome-free/css/all.min.css';


import.meta.glob([
    '../images/**',
]);


import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()

// Toggle mobile menu display
document.getElementById('mobile-menu-button').addEventListener('click', function() {
  var menu = document.getElementById('mobile-menu');
  menu.style.display = menu.style.display === "none" || menu.style.display === "" ? "block" : "none";
});
